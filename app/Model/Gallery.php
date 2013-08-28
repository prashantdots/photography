<?php
App::uses('AppModel', 'Model');
/**
 * Gallery Model
 *
 * @property JobTo $JobTo
 */
class Gallery extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

	public $name = 'Gallery';
	
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
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	/**
 * Validation parameters
 *
 * @var array
 */
 function galleryValidation(){
	  
		$validate1 = array(
			'title' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Please enter title.',
				)
			)
		); 
		
		
		
		$this->validate = $validate1;
		
		$imageValidation=array();
		if(array_key_exists('filename',$this->data['Gallery'])){

			$i=0;
			foreach($this->data['Gallery']['filename']  as $keyPhoto=>$valuePhoto){
			
				if($this->checkImage($valuePhoto['name'])){
				
				$imageValidation['filename']='please upload image';
				
				}elseif($this->ValidateImage($valuePhoto)){
				
				$imageValidation['filename']='File '.$i.' should be  jpg,png,gif,jpeg image';
				
				}
			
			$i++;
			}
		
		}
		
		if(!empty($imageValidation)){
		
		$this->validationErrors =$imageValidation;
		
		}
		
		return $this->validates();
		
				
	}
	
	
	function checkImage ($image_name) {
	
		if($image_name==''){
		
			return true;
		}
	
	}	

	function ValidateImage ($data) {

		$valid_extensions = array('image/jpg','image/jpeg','image/png','image/gif');
		
		if(in_array($data['type'],$valid_extensions) ) {
			
			return false;
		
		} else {
		
			return true ;
		
		}
		
		
		
	
	}

	
	

}
