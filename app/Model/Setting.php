<?php
App::uses('AppModel', 'Model');

/**
 * Setting Model
 *
 */
class Setting extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'rule' => 'notEmpty',
		)
	);

/**
 * Returns the setting value
 * @param  string $name
 * @return string
 */
	public function get($name = null) {
		if (!$name) {
			throw new NotFoundException('No setting found');
		}

		$name = Inflector::underscore($name);

		$this->contain();
		$setting = $this->findByName($name);

		if (!$setting) {
			throw new NotFoundException('No setting found');
		}

		if ($name == 'site_emails_cc') {
			return $this->explodeAndTrim($setting['Setting']['value'], ',');
		}

		return $setting['Setting']['value'];
	}

/**
 * Explodes an array by a separator and trims each value
 * @param  string $value
 * @param  string $separator
 * @return array()
 */
	public function explodeAndTrim($value = null, $separator = null) {
		if (!$value) {
			return array();
		}

		if (!$separator) {
			throw new NotFoundException(__('Invalid separator'));
		}

		$rows = explode($separator, $value);

		foreach ($rows as $key => $row) {
			$rows[$key] = trim($row);
		}

		return $rows;
	}

/**
 * Validates the Setting data for the installation
 * @param  array  $data
 * @return boolean
 */
	public function validateInstall($data = array()) {
		if (!$data) {
			throw new NotFoundException(__('Invalid Data'));
		}

		// because these fields are only used here, lets use custom rules for their validation
		$this->validator()
	    ->add('site_name', 'required', array(
	        'rule' => 'notEmpty',
	        'message' => __('Site name is required.')
	    ))
	    ->add('site_email', 'required', array(
	        'rule' => 'notEmpty',
	        'message' => __('Site email is required.')
	    ))
	    ->add('site_email', 'email', array(
	        'rule' => 'email',
	        'message' => __('Site email is invalid.')
	    ));

	    return $this->validate($data);
	}

/**
 * Updates multiple settings at a time
 * @param  array  $data
 * @return boolean
 */
	public function updateSettings($data = array()) {
		if (!$data || empty($data['Setting'])) {
			throw new LogicException(__('Invalid Data'));
		}

		foreach ($data['Setting'] as $name => $value) {
			$this->updateSetting($name, $value);
		}

		return true;
	}

/**
 * Updates a setting using a name, value pair of parameters
 * @param  string $name
 * @param  string $value
 * @return boolean
 */
	public function updateSetting($name = null, $value = null) {
		if (!$name) {
			throw new NotFoundException(__('Invalid Setting Name'));
		}

		$this->contain();
		$setting = $this->findByName($name, 'id');

		if (!$setting) {
			// this might get updated at some point to add a setting if none exist
			throw new NotFoundException(__('Invalid Setting Name'));
		}

		$this->id = $setting['Setting']['id'];
		if (!$this->saveField('value', $value)) {
			throw new LogicException(__('There was a problem saving the setting.'));
		}

		return true;
	}
}