<?php
App::uses('AppModel', 'Model');
/**
 * Job Model
 *
 * @property Venue $Venue
 * @property Photographer $Photographer
 */
class Job extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	 public $validate = array(
        'job_no' => array(
            'blank' => array(
                'rule' => array('notEmpty'),
                'message' => 'Job number is required'
            ),
			'unique'=>array(
                 'rule'=>array('isUnique', 'job_no'),
                 'message' => 'This Job number has already been taken.'
                        ) 
       ),
        'ordered_by' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Order By is required'
            )
        ),'agreed_photographer_fee' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Photographers net fee is required.',
				),
				'Numeric' => array(
                'rule'     => 'Numeric',
                'required' => true,
                'message'  => 'Photographers net fee should be numeric'
            	)
	   ),'agreed_venue_fee' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Shoot Gross Value is required.',
				),
				'Numeric' => array(
                'rule'     => 'Numeric',
                'required' => true,
                'message'  => 'Shoot Gross Value should be numeric'
            	)
	   ),'order_date' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Order Date is required.',
				)
	   ),'shoot_date' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Shoot Date is required.',
				)
	   ),'venue_id' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Please select Venue/Location.',
				)
	   ),'venue_contact_person' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Venue Contact is required.',
				)
	   ),'venue_mobile' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Mobile(Venue) number is required.',
				),
				'Numeric' => array(
                'rule'     => 'Numeric',
                'required' => true,
                'message'  => 'Mobile(Venue) number should be numeric'
            	)
	   ),'venue_postcode' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Postcode(Venue) is required.',
				)
	   ),'venue_address' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Address(Venue) is required.',
				)
	   ),'photographer_arrival_time' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Photographer Arrival Time is required.',
				)
	   ),'shoot_commences' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Shoot Commences is required.',
				)
	   ),'shoot_concludes' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Shoot Concludes is required.',
				)
	   ),'dress_code' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Dress Code is required.',
				)
	   ),'image_upload_req_by' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Image Upload By is required.',
				)
	   ),'cover_photographer' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Cover Photographer is required.',
				)
	   ),'photographer_id' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Please select photographer.',
				)
	   ),'photographer_name' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Photographer name is required.',
				)
	   ),'photographer_mobile' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Mobile(Photographer) should be numeric.',
				),
				'Numeric' => array(
                'rule'     => 'Numeric',
                'required' => true,
                'message'  => 'Mobile(Photographer) number should be numeric'
            	)
	   ),'photographer_email' =>array(
			'email' => array(
			'rule' => array('email'),
			'message' => 'Please enter valid email',
				
			)
	   ),'personal_licklist_contact' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Primary Licklist Contact is required.',
				)
	   ),'mobile1' => array (
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Mobile number is required.',
				),
				'Numeric' => array(
                'rule'     => 'Numeric',
                'required' => true,
                'message'  => 'Mobile number should be numeric'
            	)
	   ),'email1' => array(
			'email' => array(
			'rule' => array('email'),
			'message' => 'Please enter valid email',
				
			)
	   ),
    );


function checkInvoiceForm() {
	
		$validate1 = array(
		'date' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Date is required'
            )
        ),
		'job' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'job no is required'
            )
        ),
		'venue' => array(
            'required' => array(
            'rule' => array('notEmpty'),
            'message' => 'Venue is required'
            )
        ),
		'price' => array(
            'required' => array(
            'rule' => array('notEmpty'),
            'message' => 'Price is required'
            )
        ),
		); 
		$this->validate = $validate1;

		return $this->validates();
	}


function checkReplenishCard() {
	
		$validate1 = array(
		'card' => array(
				'notempty'  =>  array (
					'rule' 		=>	'notEmpty',
					'required' 	=>	false,
					'message' 	=>	'Card Number is required.',
				),
				'Numeric' => array(
                'rule'     => 'Numeric',
                'required' => true,
                'message'  => 'Card Number should be numeric'
            	)
	   		),
		); 
		$this->validate = $validate1;

		return $this->validates();
	}	
	
	
	
//The Associations below have been created with all possible keys, those that are not needed can be removed
	
/**
 * belongsTo associations
 *
 * @var array
 */
 	public $hasOne = 'Invoice';
	
	public $belongsTo = array(
		'Venue' => array(
			'className' => 'Venue',
			'foreignKey' => 'venue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Photographer' => array(
			'className' => 'Photographer',
			'foreignKey' => 'photographer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function beforeSave(array $options) {
		if (isset($this->data[$this->alias]['order_date'])) {
			$this->data[$this->alias]['order_date'] = date('Y-m-d h:i:s',strtotime($this->data[$this->alias]['order_date']));
		}
		if (isset($this->data[$this->alias]['shoot_date'])) {
			$this->data[$this->alias]['shoot_date'] = date('Y-m-d h:i:s',strtotime($this->data[$this->alias]['shoot_date']));
		}
		return true;
	}
	
	public function afterFind($results, $primary = false) {
    foreach ($results as $key => $val) {
        if (isset($val['Job']['order_date'])) {
            $results[$key]['Job']['order_date'] = $this->dateFormatAfterFind($val['Job']['order_date']);
        }
		
		if (isset($val['Job']['shoot_date'])) {
            $results[$key]['Job']['shoot_date'] = $this->dateFormatAfterFind($val['Job']['shoot_date']);
        }

    }
    return $results;
	}

	public function dateFormatAfterFind($dateString) {
		return date('m/d/Y', strtotime($dateString));
	}
}
