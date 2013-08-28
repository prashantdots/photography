<?php
App::uses('AppModel', 'Model');
/**
 * Photographer Model
 *
 * @property User $User
 */
class Photographer extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

	var $virtualFields = array('name' => 'CONCAT(title," ",fname, " ", lname)'	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	

public function beforeSave(array $options) {
		if(isset($this->data[$this->alias]['dob_date'])) {
			$this->data[$this->alias]['dob_date'] = date('Y-m-d h:i:s',strtotime($this->data[$this->alias]['dob_date']));
		}
		return true;
	}
	
	public function afterFind($results, $primary = false) {
  
    foreach ($results as $key => $val) {
        if (isset($val['Photographer']['dob_date'])) {
            $results[$key]['Photographer']['dob_date'] = $this->dateFormatAfterFind($val['Photographer']['dob_date']);
        }
		
		

    }
    return $results;
	}

	public function dateFormatAfterFind($dateString) {
		return date('m/d/Y', strtotime($dateString));
	}	
	
}
