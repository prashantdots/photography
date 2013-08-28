<?php
App::uses('AppModel', 'Model');
/**
 * Gallery Model
 *
 * @property JobTo $JobTo
 */
class Invoice extends AppModel {

/**
 * Display field
 *
 * @var string
 */

	public $name = 'Invoice';
	
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Job' => array(
			'className' => 'Job',
			'foreignKey' => 'job_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	

}
