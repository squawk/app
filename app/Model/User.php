<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

	public $virtualFields = array('name' => 'CONCAT(User.first_name, " ", User.last_name)');

	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'A username is required.'
			),
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'message' => 'The username can contain letters and numbers only.'
			),
			'between' => array(
				'rule' => array('between', 3, 20),
				'message' => 'Username must be between 3 and 20 characters long.'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'The username is already taken.'
			)
		),
		'old_password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please enter in your old password.'
			),
			'checkPassword' => array(
				'rule' => 'checkPassword',
				'message' => 'The password you entered is incorrect.'
			)
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Password is a required field.'
			),
			'between' => array(
				'rule' => array('between', 6, 20),
				'message' => 'Password must be between 6 and 20 characters long.'
			)
		),
		'retype_password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Retype Password is a required field.'
			),
			'matchFields' => array(
				'rule' => array('matchFields', 'password'),
				'message' => 'Password and Retype Password do not match.'
			)
		),
		'first_name' => array(
			'rule' => 'notEmpty',
			'message' => 'First name is required.'
		),
		'last_name' => array(
			'rule' => 'notEmpty',
			'message' => 'Last name is required.'

		),
		'email' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Email address is required.'
			),
			'email' => array(
				'rule' => 'email',
				'message' => 'The email address you entered is not valid.'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'The email was already used by another user.'
			)
		)
	);

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}

		return true;
	}

/**
 * Function to reset user password. User will get a new password by email.
 *
 * @param array $data Data containing user information which will be verified
 * @return mixed User and email parameter array if success, false otherwise
 */
	public function reset($data = array(), $newPasswordLength = 8) {
		if (!$data || empty($data['User'])) {
			throw new NotFoundException(__('Invalid Data'));
		}

		$this->set($data);

		$this->validator()->remove('email', 'isUnique');

		if (!$this->validates()) {
			throw new LogicException(__('There was a problem, please review the errors and try again.'));
		}

		$this->recursive = -1;
		$user = $this->findByEmail($data['User']['email']);

		if (!$user) {
			throw new NotFoundException(__('The email address you entered was not found.  Please try a different email address.'));
		}

		$this->Setting = ClassRegistry::init('Setting');
		$siteEmail = $this->Setting->get('site_email');
		$siteName  = $this->Setting->get('site_name');

		if (!$siteEmail || !$siteName) {
			throw new LogicException(__('The site name or email have not been configured.'));
		}

		// Formating the data for email sending
		// Put the reset link inside the user array
		$user['User']['password'] = $this->generateRandomPassword($newPasswordLength);

		// Save the user info
		$this->id = $user['User']['id'];
		$this->saveField('password', $user['User']['password']);

		App::uses('CakeEmail', 'Network/Email');

		$email = new CakeEmail();
		$email->from(array($siteEmail => $siteName));
		$email->to($user['User']['email']);
		$email->subject(__('Account Reset - %s', $siteName));
		$email->template('reset');
		$email->emailFormat('both');
		$email->viewVars(compact('user', 'siteName'));

		if (!$email->send()) {
			throw new LogicException(__('There was a problem sending the forgotten password email. Please try again or contact us if this problem persists.'));
		}

		return true;
	}

/**
 * Function to check the users old password is correct
 *
 * @param array $data The users data
 * @return booleen true is it matches, false otherwise
 */
	public function checkPassword($check) {
		$value = array_shift($check);

		if (strlen($value) == 0) {
			return true;
		}

		// if no userId is set
		if (empty($this->data['User']['id'])) {
			return false;
		}

		$this->contain();
		$user = $this->findById($this->data['User']['id'], 'password');

		if (!$user) {
			return false;
		}

		$passwordHasher = new BlowfishPasswordHasher();
		return $passwordHasher->check($value, $user['User']['password']);
	}

/**
 * This function generates random password for user
 *
 * @param int $length How long the new password will be
 * @param string $random_string The string to be used when generate the password
 * @return string New generated password
 */
	public function generateRandomPassword($length = 8, $randomString = null) {
		if (empty($randomString)) {
			$randomString = 'pqowieurytlaksjdhfgmznxbcv1029384756';
		}
		$newPassword = '';

		for ($i = 0; $i < $length; $i++) {
			$newPassword .= substr($randomString, mt_rand(0, strlen($randomString) - 1), 1);
		}

		return $newPassword;
	}

/**
 * Installs a new user and the website settings
 * @param  array  $data
 * @return boolean
 */
	public function install($data = array()) {
		if (!$data) {
			throw new NotFoundException(__('Invalid Data'));
		}

		// lets check if both models pass validation
		$userValiate = $this->validate($data);

		$this->Setting  = ClassRegistry::init('Setting');
		$settingValiate = $this->Setting->validateInstall($data);

		if (!$userValiate || !$settingValiate) {
			// if not, we display the errors from both models
			throw new LogicException(__('There was a problem, please review the errors below and try again.'));
		}

		if (!$this->Setting->updateSettings($data)) {
			throw new LogicException(__('There was a problem updating the settings.'));
		}

		$this->create();
		if (!$this->save($data)) {
			return false;
		}

		return true;
	}
}