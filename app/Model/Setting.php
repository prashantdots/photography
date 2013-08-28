<?php
App::uses('AppModel', 'Model');
/**
 * Photographer Model
 *
 * @property User $User
 */
class Setting extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	


function AddSettingValidate(){
	$validate1 = array(
		'email' => array(
			'email' => array(
			'rule' => array('email'),
			'message' => 'Please enter valid email',
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique'=>array(
            'rule'=>array('isUnique', 'email'),
            'message' => 'This Email has already been taken.'
                        ) 
       
		),'mobile' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Postcode is required.',
				)
			),
			'watermark_image' => array (
								'notempty'		=>	array (
								'rule' 		=>	'checkImage',
								'required' 	=>	false,
								'message' 	=>	'Please upload image.',
								),'ValidateImage'  => array(
								'rule' 		=>	'ValidateImage',
								'required' 	=>	false,
								'message' 	=>	'Please upload only  png images.',
							  )
			),
		); 
		$this->validate = array_merge($this->validate,$validate1);
		return $this->validates();
	}
	
	function ValidateImage ($data) {
		
		$array_key	=	array_keys($data); 
		
		$valid_extensions = array('image/png');

		if(in_array($data[$array_key[0]]['type'],$valid_extensions) ) {
			
			return true;
		
		} else {
			
			return false ;
		
		}
		
	}

	function checkImage ($data) {
	
		$array_key	=	array_keys($data);
		
		if( $data[$array_key[0]]['name'] == '' ) {
			return false;
		} else {
			return true;
		}
	}
	
}
