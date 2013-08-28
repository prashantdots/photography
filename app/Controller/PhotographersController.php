<?php
App::uses('AppController', 'Controller');
/**
 * Photographer Controller
 *
 * @property Photographer $Photographer
 *
 * Developed By:Vijender Singh Rana
 *
 * Date:11 July 2013
 */
class PhotographersController extends AppController {

/**
 * Helpers
 *
 * @var array
 */

 public function beforeFilter() {
 
		parent:: beforeFilter();
 
        $this->Auth->allow('signup');
		
    } 

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
	
		/*Check if logged in user is photographer and venue*/
		if($this->Session->read('Auth.User.role')=='venue' || $this->Session->read('Auth.User.role')=='photographer'){
		
			$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
			
			$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
		}
		
		$this->Photographer->recursive = 0;
		$filter=array();
		if(array_key_exists('search',$this->params->query)){
		$searchBy=$this->params->query['search'];
		$this->paginate = array(
			'conditions' => array(
				'OR' => array(
						array('AND'=>array('User.active'=>1)),
						array('AND'=>array(
										'Photographer.name LIKE' => '%'. $searchBy . '%',
										'Photographer.address1 LIKE' => '%'. $searchBy . '%',
										'Photographer.address2 LIKE' => '%'. $searchBy . '%',
										'User.username LIKE' => '%'. $searchBy . '%',
										'User.email LIKE' => '%'. $searchBy . '%')
							)
					    )			
				),
			'limit' => 5	
			);
		}else{
			$this->paginate = array('conditions' => array('User.active'=>1),'limit' => 5);
		}
		
		$this->set('photographers', $this->paginate('Photographer'));
	}

/**
 * admin_allArchivePhotographer method
 *
 * @return void
 */
	public function admin_allArchivePhotographer() {
	
		/*Check if logged in user is photographer and venue*/
		if($this->Session->read('Auth.User.role')=='venue' || $this->Session->read('Auth.User.role')=='photographer'){
		
			$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
			
			$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
			
		}
		
		$this->Photographer->recursive = 0;
		$filter=array();
		if(array_key_exists('search',$this->params->query)){
		$searchBy=$this->params->query['search'];
		$this->paginate = array(
			'conditions' => array(
				'OR' => array(
						array('AND'=>array('User.active'=>1)),
						array('AND'=>array(
										'Photographer.name LIKE' => '%'. $searchBy . '%',
										'Photographer.address1 LIKE' => '%'. $searchBy . '%',
										'Photographer.address2 LIKE' => '%'. $searchBy . '%',
										'User.username LIKE' => '%'. $searchBy . '%',
										'User.email LIKE' => '%'. $searchBy . '%')
							)
					    )			
				),
			'limit' => 5	
			);
		}else{
			$this->paginate = array('conditions' => array('User.active'=>0),'limit' => 5);
		}
		
			$this->set('photographers', $this->paginate('Photographer'));
	}
	

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		
		$helpers = array('Common');
		
		$this->Photographer->id = $id;
	
		if (!$this->Photographer->exists()) {
			//throw new NotFoundException(__('Invalid photographer'));
			$this->Session->setFlash(__('Invalid photographer'),'flash_custom_error');
			$this->redirect(array('action' => 'index'));
		}
	
		$this->set('photographer', $this->Photographer->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
	
	/*Check if logged in user is photographer and venue*/
	if($this->Session->read('Auth.User.role')=='venue' || $this->Session->read('Auth.User.role')=='photographer'){
		
		$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
		
		$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
	}
	
	
		if ($this->request->is('post')) {
			
			$this->loadModel('User');
			
		
		$this->User->set($this->data);
		
		if ($this->User->AddPhotographerValidate()) {
				
				//code for creating user array for saving user data
				$userDataArr=array();
				
				$userDataArr['User']['username']=$this->data['User']['username'];
				
				$userDataArr['User']['email']=$this->data['User']['email'];
				
				$userDataArr['User']['password']=$this->data['User']['password'];
				
				$userDataArr['User']['role']='photographer';
				
				$userDataArr['User']['active']='1';
				
				$this->User->create();
				
				if($this->User->save($userDataArr,false)){
				
					$user_id = $this->User->id;
					
					//code for creating photographer array for saving photographer data
					
					$photographerDataArr=array();
					
					$photographerDataArr['Photographer']['user_id']=$user_id;
					
					$photographerDataArr['Photographer']['fname']=$this->data['User']['fname'];
					
					$photographerDataArr['Photographer']['lname']=$this->data['User']['lname'];	
					
					$photographerDataArr['Photographer']['mobile']=$this->data['User']['mobile'];
					
					$photographerDataArr['Photographer']['address1']=$this->data['User']['address1'];
					
					$photographerDataArr['Photographer']['address2']=$this->data['User']['address2'];
					
					$photographerDataArr['Photographer']['town']=$this->data['User']['town'];
					
					$photographerDataArr['Photographer']['county']=$this->data['User']['county'];
					
					$photographerDataArr['Photographer']['postcode']=$this->data['User']['postcode'];
					
					$photographerDataArr['Photographer']['website']=$this->data['User']['website'];
					
					$photographerDataArr['Photographer']['title']=$this->data['User']['title'];
					
					$photographerDataArr['Photographer']['dob_date']=$this->data['User']['dob_date'];
					
					$photographerDataArr['Photographer']['vehicle']=$this->data['User']['vehicle'];
					
					$photographerDataArr['Photographer']['distance']=$this->data['User']['distance'];
					
					$photographerDataArr['Photographer']['preferred_working_days']=(array_key_exists('preferred_working_days',$this->data['User']))?serialize($this->data['User']['preferred_working_days']):'';
					
					
					$photographerDataArr['Photographer']['skill_score']=$this->data['User']['skill_score'];
					
					$photographerDataArr['Photographer']['experience']=$this->data['User']['experience'];
					
					$photographerDataArr['Photographer']['post_experience']=$this->data['User']['post_experience'];
					
					$photographerDataArr['Photographer']['note']=$this->data['User']['note'];
					
					
					$this->Photographer->create();
					
					if($this->Photographer->save($photographerDataArr,false)){
					
					  //Mail to user
						$to	=	$this->data['User']['email'];
								
						$subject	=   'Photography:User registration successfully';
						
						$message	=   'Your account has been created successfully as photographer following is your details';
						
						$message	.=   '<table width="50%">';
						
						$message	.=   '<tr><td>Username:</td><td>'.$this->data['User']['username'].'</td></tr>';
						
						$message	.=   '<tr><td>Password:</td><td>'.$this->data['User']['password'].'</td></tr>';
								
						
								
						$this->_mail($to,$subject,$message);
					
					
					$this->Session->setFlash(__('The photographer has been saved'),'flash_custom_success');
				
					$this->redirect(array('action' => 'index'));
					
					}else{
					
					$this->Session->setFlash(__('Error in saving photographer'),'flash_custom_error');
					
					}
				
				
				}else{
				
				$this->Session->setFlash(__('The photographer could not be saved. Please, try again'),'flash_custom_error');
				
				}
				
				
			}else {
				//pr($this->data);die;
				//pr($this->User->validationErrors);die;
				$this->Session->setFlash(__('The photographer could not be saved. Please, try again.'),'flash_custom_error');
			}
		}
		$users = $this->Photographer->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function admin_edit($id = null) {
		
		$this->Photographer->id = $id;
		if (!$this->Photographer->exists()) {
			throw new NotFoundException(__('Invalid photographer'));
		}
		$photographerData = $this->Photographer->read(null, $id);
		
		if(empty($this->data)){
		
		$this->request->data['User']=$photographerData['User'];
		
		$this->request->data['User']['fname']=$photographerData['Photographer']['fname'];
		
		$this->request->data['User']['lname']=$photographerData['Photographer']['lname'];
		
		$this->request->data['User']['old_image']=$photographerData['Photographer']['image'];
		
		$this->request->data['User']['mobile']=$photographerData['Photographer']['mobile'];
		
		$this->request->data['User']['address1']=$photographerData['Photographer']['address1'];
		
		$this->request->data['User']['address2']=$photographerData['Photographer']['address2'];
		
		$this->request->data['User']['town']=$photographerData['Photographer']['town'];
		
		$this->request->data['User']['county']=$photographerData['Photographer']['county'];
		
		$this->request->data['User']['postcode']=$photographerData['Photographer']['postcode'];
		
		$this->request->data['User']['website']=$photographerData['Photographer']['website'];
		
		$this->request->data['User']['photographer_id']=$photographerData['Photographer']['id'];
		
		$this->request->data['User']['title']=$photographerData['Photographer']['title'];
		
		$this->request->data['User']['dob_date']=$photographerData['Photographer']['dob_date'];
		
		$this->request->data['User']['vehicle']=$photographerData['Photographer']['vehicle'];
		
		$this->request->data['User']['distance']=$photographerData['Photographer']['distance'];
		
		$this->request->data['User']['preferred_working_days']=($photographerData['Photographer']['preferred_working_days']!='')?unserialize($photographerData['Photographer']['preferred_working_days']):'';
		
		$this->request->data['User']['skill_score']=$photographerData['Photographer']['skill_score'];
		
		$this->request->data['User']['experience']=$photographerData['Photographer']['experience'];
		
		$this->request->data['User']['post_experience']=$photographerData['Photographer']['post_experience'];
		
		$this->request->data['User']['note']=$photographerData['Photographer']['note'];
		
		
		
		//pr($this->data);die;
		
		}else{
		
			$this->loadModel('User');
				
				$isNewImage=false;
				//check if image is not uploaded ........................................
				if($this->request->data['User']['image']['name']==''){
				
					$this->request->data['User']['image']['name']=$this->request->data['User']['old_image'];
					
					$this->request->data['User']['image']['type']='image/png';
				
				
				}else{
				
					$isNewImage=true;	
				
				
				}
			
			
			$this->User->set($this->data);
			
			if ($this->User->AddPhotographerValidate()) {
			
					//echo pr($this->data);die;
					
					//code for creating user array for updating user data
					$userDataArr=array();
						
					$userDataArr['User']['username']=$this->data['User']['username'];
						
					$userDataArr['User']['email']=$this->data['User']['email'];
					
					if($this->User->save($userDataArr,false)){
						
						//code for creating photographer array for updating photographer data
						$photographerDataArr=array();
						
						$photographerDataArr['Photographer']['user_id']=$this->data['User']['id'];
						
						$photographerDataArr['Photographer']['id']=$this->data['User']['photographer_id'];
						
						$photographerDataArr['Photographer']['fname']=$this->data['User']['fname'];
						
						$photographerDataArr['Photographer']['lname']=$this->data['User']['lname'];
						
						$photographerDataArr['Photographer']['mobile']=$this->data['User']['mobile'];
						
						$photographerDataArr['Photographer']['address1']=$this->data['User']['address1'];
						
						$photographerDataArr['Photographer']['address2']=$this->data['User']['address2'];
						
						$photographerDataArr['Photographer']['town']=$this->data['User']['town'];
						
						$photographerDataArr['Photographer']['county']=$this->data['User']['county'];
						
						$photographerDataArr['Photographer']['postcode']=$this->data['User']['postcode'];
						
						$photographerDataArr['Photographer']['website']=$this->data['User']['website'];
						
						$photographerDataArr['Photographer']['title']=$this->data['User']['title'];
						
						$photographerDataArr['Photographer']['dob_date']=$this->data['User']['dob_date'];
						
						$photographerDataArr['Photographer']['vehicle']=$this->data['User']['vehicle'];
						
						$photographerDataArr['Photographer']['distance']=$this->data['User']['distance'];
						
						$photographerDataArr['Photographer']['preferred_working_days']=(array_key_exists('preferred_working_days',$this->data['User']))?serialize($this->data['User']['preferred_working_days']):'';
						
						
						$photographerDataArr['Photographer']['skill_score']=$this->data['User']['skill_score'];
						
						$photographerDataArr['Photographer']['experience']=$this->data['User']['experience'];
						
						$photographerDataArr['Photographer']['post_experience']=$this->data['User']['post_experience'];
						
						$photographerDataArr['Photographer']['note']=$this->data['User']['note'];
						
				if($isNewImage){
						
						$uploaddir = WWW_ROOT.'uploads/photographer/'; 
						
						$user_image=$this->data['User']['image']['name'];
						
						$filename	=	strtolower(substr($user_image,0, (strpos($user_image,'.')-1) )).md5(time());
						
						$ext 		=	strtolower(substr($user_image, (strpos($user_image,'.')+1) ));
						
						$filename	=	str_replace(' ','_',$filename).'.'.$ext;	
						
							
						
						if(move_uploaded_file($this->data['User']['image']['tmp_name'],$uploaddir.$filename)){
								
							if($this->data['User']['old_image']!='' && file_exists(WWW_ROOT.'uploads'.DS.'photographer'.DS.$this->data['User']['old_image'])){
								
								unlink(WWW_ROOT.'uploads'.DS.'photographer'.DS.$this->data['User']['old_image']);
							}
							$photographerDataArr['Photographer']['image']=$filename;	
						
						}
						
				}	
						
					

						if($this->Photographer->save($photographerDataArr,false)){
							
						
							/*Redirect accordingly user role..............................................*/						
							if($this->Session->read('Auth.User.role')=='admin'){
							
							$this->Session->setFlash(__('The photographer has been updated'),'flash_custom_success');
							
							$this->redirect(array('action' => 'index'));
							
							}else if($this->Session->read('Auth.User.role')=='photographer'){
							
							$this->Session->setFlash(__('Your profile has been updated'),'flash_custom_success');
							
							$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
							
							}
						
						}else{
						
						$this->Session->setFlash(__('The photographer could not be updated. Please, try again.'),'flash_custom_error');
						
						}
					
					
					}else{
					
					$this->Session->setFlash(__('The photographer could not be updated. Please, try again.'),'flash_custom_error');
					
					}
						
					
			
			}else{
			
			$this->Session->setFlash(__('The photographer could not be updated. Please, try again.'),'flash_custom_error');
			
			}
		
		
		
		}
		
		//pr($this->request->data);die;
}

/**
 * admin_delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
	
		/*Check if logged in user is photographer and venue*/
		if($this->Session->read('Auth.User.role')=='venue' || $this->Session->read('Auth.User.role')=='photographer'){
		
		$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
		
		$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
		}
		
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Photographer->id = $id;
		if (!$this->Photographer->exists()) {
			throw new NotFoundException(__('Invalid photographer'));
		}
		
		
		$this->{$this->modelClass}->recursive = -1;
		$photograperData	=	$this->{$this->modelClass}->read();
		
		$this->loadModel('User');
		
		//$this->User->id = $photograperData['Photographer']['user_id'];
		
		$this->User->updateAll(array('User.active'=>"0"), array('User.id'=>$photograperData['Photographer']['user_id']));
		
		/*if ($this->User->delete() && $this->Photographer->delete()) {
			$this->Session->setFlash(__('Photographer deleted'),'flash_custom_success');
			$this->redirect(array('action' => 'index'));
		}*/
		$this->Session->setFlash(__('Photographer put into archive'),'flash_custom_error');
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * signup method
 *
 * @return void
 */
	public function signup() {
		if ($this->request->is('post')) {
			$this->loadModel('User');
			
		
		$this->User->set($this->data);
		
		if ($this->User->AddPhotographerValidate()) {
				
				//code for creating user array for saving user data
				$userDataArr=array();
				
				$userDataArr['User']['username']=$this->data['User']['username'];
				
				$userDataArr['User']['email']=$this->data['User']['email'];
				
				$userDataArr['User']['password']=$this->data['User']['password'];
				
				$userDataArr['User']['role']='photographer';
				
				$userDataArr['User']['active']='1';
				
				$this->User->create();
				
				if($this->User->save($userDataArr,false)){
				
					$user_id = $this->User->id;
					
					//code for creating photographer array for saving photographer data
					
					$photographerDataArr=array();
					
					$photographerDataArr['Photographer']['user_id']=$user_id;
					
					$photographerDataArr['Photographer']['fname']=$this->data['User']['fname'];
					
					$photographerDataArr['Photographer']['lname']=$this->data['User']['lname'];	
					
					$photographerDataArr['Photographer']['mobile']=$this->data['User']['mobile'];
					
					$photographerDataArr['Photographer']['address1']=$this->data['User']['address1'];
					
					$photographerDataArr['Photographer']['address2']=$this->data['User']['address2'];
					
					$photographerDataArr['Photographer']['town']=$this->data['User']['town'];
					
					$photographerDataArr['Photographer']['county']=$this->data['User']['county'];
					
					$photographerDataArr['Photographer']['postcode']=$this->data['User']['postcode'];
					
					$photographerDataArr['Photographer']['website']=$this->data['User']['website'];
					
					$photographerDataArr['Photographer']['title']=$this->data['User']['title'];
					
					$photographerDataArr['Photographer']['dob_date']=$this->data['User']['dob_date'];
					
					$photographerDataArr['Photographer']['vehicle']=$this->data['User']['vehicle'];
					
					$photographerDataArr['Photographer']['distance']=$this->data['User']['distance'];
					
					$photographerDataArr['Photographer']['preferred_working_days']=(array_key_exists('preferred_working_days',$this->data['User']))?implode(',',$this->data['User']['preferred_working_days']):'';
					
					
					$photographerDataArr['Photographer']['skill_score']=$this->data['User']['skill_score'];
					
					$photographerDataArr['Photographer']['experience']=$this->data['User']['experience'];
					
					$photographerDataArr['Photographer']['post_experience']=$this->data['User']['post_experience'];
					
					
					$this->Photographer->create();
					
					if($this->Photographer->save($photographerDataArr,false)){
					
					  //Mail to user
						$to	=	$this->data['User']['email'];
								
						$subject	=   'Photography:User registration successfully';
						
						$message	=   'Your account has been created successfully as photographer following is your details';
						
						$message	.=   '<table width="50%">';
						
						$message	.=   '<tr><td>Username:</td><td>'.$this->data['User']['username'].'</td></tr>';
						
						$message	.=   '<tr><td>Password:</td><td>'.$this->data['User']['password'].'</td></tr>';
								
						
								
						$this->_mail($to,$subject,$message);
					
					
					$this->Session->setFlash(__('You are register succefully'),'flash_custom_success');
				
					$this->redirect(array('admin'=>true,'controller'=>'users','action' => 'login'));
					
					}else{
					
					$this->Session->setFlash(__('Error in registration. Please, try again.'),'flash_custom_error');
					
					}
				
				
				}else{
				
				$this->Session->setFlash(__('Error in registration. Please, try again.'),'flash_custom_error');
				
				}
				
				
			}else {
				//pr($this->User->validationErrors);die;
				$this->Session->setFlash(__('Error in registration. Please, try again.'),'flash_custom_error');
			}
		}
		$users = $this->Photographer->User->find('list');
		$this->set(compact('users'));
	}
	
	public function admin_viewMap(){
		
		/*Check if logged in user is photographer and venue*/
		if($this->Session->read('Auth.User.role')=='venue' || $this->Session->read('Auth.User.role')=='photographer'){
		
		$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
		
		$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
		}
		
		$this->loadModel('Photographer');
		
		$this->Photographer->recursive=-1;
		
		$details=$this->Photographer->find('all',array('fields'=>array('Photographer.address1','Photographer.address2','Photographer.town','Photographer.county','Photographer.postcode','Photographer.mobile','Photographer.website')));
		
		$photographerArr=array();
		$i=0;
		foreach($details as $photographer):
		
		$address=$photographer['Photographer']['address1'].' '.$photographer['Photographer']['address2'].' '.$photographer['Photographer']['town'].' '.$photographer['Photographer']['county'].' '.$photographer['Photographer']['postcode'];
		
		$prepAddr = str_replace(' ','+',$address);
 	
		
		
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
		 
		
		 
		$output= json_decode($geocode);
		
		

		$photographerArr[$i]['address']=$photographer['Photographer']['address1'].' '.$photographer['Photographer']['address2'];
		
		$photographerArr[$i]['town']=$photographer['Photographer']['town'];
		
		$photographerArr[$i]['county']=$photographer['Photographer']['county'];
		
		$photographerArr[$i]['postcode']=$photographer['Photographer']['postcode'];
		
		$photographerArr[$i]['mobile']=$photographer['Photographer']['mobile'];
		
		$photographerArr[$i]['website']=$photographer['Photographer']['website'];
		
		$photographerArr[$i]['lat']=$output->results[0]->geometry->location->lat;
		
		$photographerArr[$i]['long']=$output->results[0]->geometry->location->lng;
		
		$i++;
		endforeach;
		
		
		$this->set('photographers',$photographerArr);
	
	}	
	
	public function admin_calendar($id = null) {
	
	/*Check if logged in user is photographer and venue*/
	if($this->Session->read('Auth.User.role')=='venue' || $this->Session->read('Auth.User.role')=='photographer'){
		
		$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
		
		$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
	}
	
	$this->Photographer->id = $id;
		if (!$this->Photographer->exists()) {
			throw new NotFoundException(__('Invalid photographer'));
	}
	
	$this->set('photogrpaher_id',$id);	
	
	}
	
	function admin_getAvailability($photogrpaher_id){
	
		$this->loadModel('Job');
	
		$this->Job->recursive=-1;
	
		$jobDetails=$this->Job->find('all',array('fields'=>array('id','job_no','shoot_date','photographer_website'),'conditions'=>array('photographer_id'=>$photogrpaher_id)));
	
		$jobArr=array();
		$i=0;
		foreach($jobDetails as $details){
	
		$jobArr[$i]['id']=$details['Job']['id'];
	
		$jobArr[$i]['title']=$details['Job']['job_no'];
	
		$jobArr[$i]['start']=date('Y-m-d',strtotime($details['Job']['shoot_date']));
	
		$jobArr[$i]['url']=Router::url('/', true).'admin/jobs/view/'.$details['Job']['id'];
		
		$i++;
		}
		
		$this->loadModel('BookingReason');
		
		$bookingDetails=$this->BookingReason->find('all',array('conditions'=>array('photographer_id'=>$photogrpaher_id)));
		
		foreach($bookingDetails as $booking){
	
		$jobArr[$i]['id']=$booking['BookingReason']['id'];
	
		$jobArr[$i]['title']=$booking['BookingReason']['reason'];
	
		$jobArr[$i]['start']=date('Y-m-d',strtotime($booking['BookingReason']['shoot_date']));
	
		$jobArr[$i]['url']='javascript:void(0)';
		
		$i++;
		}
		
		
		
		echo json_encode($jobArr);	
	
	
	
		die();
	
	}
}
