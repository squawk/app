<?php
App::uses('AppModel', 'Model');

class Lead extends AppModel {

	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
			'message' => 'Field is required'
		),
		'email' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Field is required'
			),
			'email' => array(
				'rule' => 'email',
				'message' => 'The email address is invalid.'
			)
		),
		'phone' => array(
			'rule' => 'phone',
			'message' => 'The phone number is invalid.',
			'allowEmpty' => true
		),
		'message' => array(
			'rule' => 'notEmpty',
			'message' => 'Field is required'
		)
	);

/**
* This function is a simple function to check for a valid universal phone number - a useful extension for Cake Validation
*
* @param string|array $check Value to check
* @return boolean Success
*/
	public function phone($check) {
		if (is_array($check)) {
			$value = array_shift($check);
		} else {
			$value = $check;
		}

		if (strlen($value) == 0) {
			return true;
		}

		return preg_match('/^[0-9-+()# ]{6,12}+$/', $value);
	}

/**
 * Saves a lead into the leads table
 * @param  array  $data
 * @param  string $type The lead type - usually the page type
 * @return boolean
 */
	public function saveLead($data = array(), $type = null) {
		if (!$data || !$type) {
			throw new NotFoundException(__('Invalid data or type'));
		}

		$data['Lead']['type'] = $type;

		$this->create();
		$result = $this->save($data);
		if (!$result) {
			throw new LogicException(__('There was a problem, please review the errors below and try again.'));
		}

		$this->Setting = ClassRegistry::init('Setting');
		$siteEmail = $this->Setting->get('siteEmail');
		$siteName  = $this->Setting->get('siteName');
		$ccEmails  = $this->Setting->get('siteEmailsCc');

		if ($siteEmail) {
			App::uses('CakeEmail', 'Network/Email');

			$email = new CakeEmail();
			$email->from(array($result['Lead']['email'] => $result['Lead']['name']));
			$email->to($siteEmail);
			if ($ccEmails) {
				$email->cc($ccEmails);
			}
			$email->subject(__('%s - The %s form has been submitted', $siteName, $result['Lead']['type']));
			$email->template('newLead');
			$email->emailFormat('both');
			$email->viewVars(array('lead' => $result, 'siteName' => $siteName));
			$email->send();
		}

		return true;
	}
}