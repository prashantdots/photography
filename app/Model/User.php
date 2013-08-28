<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	 public $validate = array(
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
       
		),
        'username' => array(
            'blank' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            ),
			'unique'=>array(
                 'rule'=>array('isUnique', 'username'),
                 'message' => 'This username has already been taken.'
                        ) 
       ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),'cnfrm_password' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Please reenter password.',
				),
				'match_passwds' =>	array (
					'rule' 		=>	'matchPasswds',
					'required' 	=>	false,
					'message' 	=>	'New password and confirm password does not match.',
				)
			),
    );
	
	
	function AddPhotographerValidate() {
	
		$validate1 = array(
		'title' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please selected title'
            )
        ),
		'fname' => array(
            'required' => array(
            'rule' => array('notEmpty'),
            'message' => 'First Name is required'
            )
        ),
		'lname' => array(
            'required' => array(
            'rule' => array('notEmpty'),
            'message' => 'Last Name is required'
            )
        ),'image' => array (
								'notempty'		=>	array (
								'rule' 		=>	'checkImage',
								'required' 	=>	false,
								'message' 	=>	'Please upload image.',
								),
								
								'ValidateImage'  => array(
								'rule' 		=>	'ValidateImage',
								'required' 	=>	false,
								'message' 	=>	'Please upload only  jpg,jpeg,gif,png image.',
							  )
	   ),'dob_date' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please Enter date of birth'
            )
        ),
		'mobile' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Mobile number is required.',
				),
				'Numeric' => array(
                'rule'     => 'Numeric',
                'required' => true,
                'message'  => 'Mobile number is  only numbers'
            	)
			),
			'address1' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Address1 is required.',
				)
			),
			'town' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Town is required.',
				)
			),
			'county' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'County is required.',
				)
			),
			'postcode' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Postcode is required.',
				)
			),
			'distance' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Photographer Distance is required.',
				)
			),
			'experience' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Photographer Experience not selected.',
				)
			),
			'post_experience' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Photographer Postproduction Experience not selected.',
				)
			),
			'skill_score' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Skill Score is required.',
				)
			),
		); 
		$this->validate = array_merge($this->validate,$validate1);
		
		return $this->validates();
	}
	
	function AddVenueValidate(){
	$validate1 = array(
		'name' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Name is required.',
				)
			),'mobile' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Mobile number is required.',
				),
				'Numeric' => array(
                'rule'     => 'Numeric',
                'required' => true,
                'message'  => 'Mobile number is  only numbers'
            	)
			),
			'address' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Address is required.',
				)
			),
			'town' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Town is required.',
				)
			),
			'county' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'County is required.',
				)
			),
			'postcode' => array (
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
								),
								
								'ValidateImage'  => array(
								'rule' 		=>	'ValidateWatermarkImage',
								'required' 	=>	false,
								'message' 	=>	'Please upload only  png images.',
							  )
			),
		); 
		$this->validate = array_merge($this->validate,$validate1);
		return $this->validates();
	}
	
   public function beforeSave(array $options) {
    if (isset($this->data[$this->alias]['password'])) {
        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    }
	return true;
	}
	
	function matchPasswds() {
		
		$data	= 	$this->data;
		
		return $data[$this->alias]['password'] == $data[$this->alias]['cnfrm_password'];
		
	}
	
	function ValidateImage ($data) {
		
		$array_key	=	array_keys($data); 
		
		$valid_extensions = array('image/jpg','image/jpeg','image/png','image/gif');

		
		if(in_array($data[$array_key[0]]['type'],$valid_extensions) ) {
			return true;
		} else {
			return false ;
		}
		
	}
	
	function ValidateWatermarkImage ($data) {
		
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
