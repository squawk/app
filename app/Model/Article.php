<?php
App::uses('AppModel', 'Model');
/**
 * Article Model
 *
 */
class Article extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'rule' => 'notEmpty',
		),
		'slug' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
			),
			'regex' => array(
				'rule' => '/^[a-zA-Z0-9-]+$/',
				'message' => 'The slug format must be only characters, numbers and dashes.',
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'This slug already exists.',
			)
		),
		'brief' => array(
			'rule' => 'notEmpty',
		),
		'date' => array(
			'rule' => 'date',
			'message' => 'Please enter in a valid date',
			'allowEmpty' => true
		)
	);

/**
 * Override parent before save for slug generation
 * Also handles ordering of the page
 *
 * @return boolean Always true
 */
	public function beforeSave($options = array()) {
		// Generating slug from page name
		if (!empty($this->data['Article']['title']) && empty($this->data['Article']['slug'])) {
			if (!empty($this->data['Article']['id'])) {
				// lets see if there is already a slug set
				$article = $this->findById($this->data['Article']['id'], 'slug');

				if (empty($article['Article']['slug'])) {
					$this->data['Article']['slug'] = $this->generateSlug($this->data['Article']['title'], $this->data['Article']['id']);
				}
			} else {
				$this->data['Article']['slug'] = $this->generateSlug($this->data['Article']['title']);
			}
		}

		return true;
	}
}