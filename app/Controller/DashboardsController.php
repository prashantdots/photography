<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class DashboardsController extends AppController {

 // $uses is where you specify which models this controller uses
   var $uses = array('Job', 'Photographer', 'Venue');



/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		if($this->Session->read('Auth.User.role')=='admin'){
				$this->Job->recursive = 0;
				
				$this->paginate = array(
					 'fields' => array('Job.id', 'Job.job_no', 'Venue.id', 'Venue.name', 'Photographer.id', 'Photographer.fname', 'Photographer.lname'),
					 'limit' => 5
				);
				$job = $this->paginate('Job');
				
				
				$this->Photographer->recursive = 0;
				$this->paginate = array(
					 'limit' => 5
				);
				$photographer = $this->paginate('Photographer');
				
				$this->Venue->recursive = 0;
				$this->paginate = array(
					 'limit' => 5
				);
				$venue = $this->paginate('Venue');
				//pr($venue);die;
				$this->set(compact('job','photographer','venue'));
		
		}else if($this->Session->read('Auth.User.role')=='photographer'){
			
			$this->Job->recursive = 0;
			
			$filter=array();
			
			if(array_key_exists('search',$this->params->query)){
			
			$searchBy=$this->params->query['search'];
			
			$this->paginate = array(
				'conditions' => array(
					'Photographer.user_id'=>$this->Session->read('Auth.User.id'),
					'OR' => array(
						'Job.job_no LIKE' => '%'. $searchBy . '%',
						'Job.venue_contact_person LIKE' => '%'. $searchBy . '%',
						'Job.ordered_by LIKE' => '%'. $searchBy . '%',
						'Job.photographer_name LIKE' => '%'. $searchBy . '%'
						)
					),
				'limit' => 5	
				);
			
			}else{
			
				$this->paginate = array('conditions'=>array('Photographer.user_id'=>$this->Session->read('Auth.User.id')),'limit' => 5);
			
			}
		
		//pr($this->paginate('Job'));die;
		
			$this->set('jobs', $this->paginate('Job'));
			$this->render('dashboard_photographer');
		
		}else if($this->Session->read('Auth.User.role')=='venue'){
			
			$this->Job->recursive = 0;
			
			$filter=array();
			
			if(array_key_exists('search',$this->params->query)){
			
			$searchBy=$this->params->query['search'];
			
			$this->paginate = array(
				'conditions' => array(
					'Venue.user_id'=>$this->Session->read('Auth.User.id'),
					'OR' => array(
						'Job.job_no LIKE' => '%'. $searchBy . '%',
						'Job.venue_contact_person LIKE' => '%'. $searchBy . '%',
						'Job.ordered_by LIKE' => '%'. $searchBy . '%',
						'Job.photographer_name LIKE' => '%'. $searchBy . '%'
						)
					),
				'limit' => 5	
				);
			
			}else{
			
				$this->paginate = array('conditions'=>array('Venue.user_id'=>$this->Session->read('Auth.User.id')),'limit' => 5);
			
			}
		
		
			$this->set('jobs', $this->paginate('Job'));
			$this->render('dashboard_photographer');
		
		}
	
		
	}


}
