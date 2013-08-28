<?php
App::uses('AppController', 'Controller');
/**
 * Venues Controller
 *
 * @property Venue $Venue
 */
class VenuesController extends AppController {

public $components = array('Image');

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
		
		$this->Venue->recursive = 0;
		
		$filter=array();
		if(array_key_exists('search',$this->params->query)){
		$searchBy=$this->params->query['search'];
		$this->paginate = array(
			'conditions' => array(
				'OR' => array(
					'Venue.name LIKE' => '%'. $searchBy . '%',
					'Venue.address LIKE' => '%'. $searchBy . '%',
					'User.username LIKE' => '%'. $searchBy . '%',
					'User.email LIKE' => '%'. $searchBy . '%'
					)
				),
			'limit' => 5	
			);
		}else{
			$this->paginate = array('limit' => 5);
		}
		
		$this->set('venues', $this->paginate('Venue'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Venue->id = $id;
		if (!$this->Venue->exists()) {
			throw new NotFoundException(__('Invalid venue'));
		}
		//pr($this->Venue->read(null, $id));die;
		$this->set('venue', $this->Venue->read(null, $id));
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
		
		if ($this->User->AddVenueValidate()) {
				
				//code for creating user array for saving user data
				$userDataArr=array();
				
				$userDataArr['User']['username']=$this->data['User']['username'];
				
				$userDataArr['User']['email']=$this->data['User']['email'];
				
				$userDataArr['User']['password']=$this->data['User']['password'];
				
				$userDataArr['User']['role']='venue';
				
				$userDataArr['User']['active']='1';
				
				$this->User->create();
				
				if($this->User->save($userDataArr,false)){
					
					$user_id = $this->User->id;
					
					//code for creating photographer array for saving photographer data
					
					$venueDataArr=array();
					
					$venueDataArr['Venue']['user_id']=$user_id;
					
					$venueDataArr['Venue']['licklist_venue_id']=$this->data['User']['licklist_venue_id'];
					
					$venueDataArr['Venue']['name']=$this->data['User']['name'];
					
					$venueDataArr['Venue']['mobile']=$this->data['User']['mobile'];
					
					$venueDataArr['Venue']['address']=$this->data['User']['address'];
					
					$venueDataArr['Venue']['town']=$this->data['User']['town'];
					
					$venueDataArr['Venue']['county']=$this->data['User']['county'];
					
					$venueDataArr['Venue']['postcode']=$this->data['User']['postcode'];
					
					$venueDataArr['Venue']['watermark_image_type']=$this->data['User']['watermark_image_type'];
					
					
					
					$fileName = $this->data['User']['watermark_image']['name'];
					
	    			$tmpName  = $this->data['User']['watermark_image']['tmp_name'];
					
					$waterMarkInfo = getimagesize($tmpName);
					
	    			$waterMarkWidth = $waterMarkInfo[0];
					
	    			$waterMarkHeight = $waterMarkInfo[1];
					
					move_uploaded_file($tmpName, WWW_ROOT."/uploads/watermark-venue/venue_user_".$user_id.".png");

					$wmTarget=WWW_ROOT.'/uploads/watermark-venue/venue_user_'.$user_id.'.png';

					
					$wmTarget1=WWW_ROOT.'/uploads/watermark-venue/60x60/venue_user_'.$user_id.'.png';

					$this->Image->resize_png_image(WWW_ROOT."/uploads/watermark-venue/venue_user_".$user_id.".png",60,60,$wmTarget1);				

					$wmTarget2=WWW_ROOT.'/uploads/watermark-venue/120x120/venue_user_'.$user_id.'.png';

					$this->Image->resize_png_image(WWW_ROOT."/uploads/watermark-venue/venue_user_".$user_id.".png",120,120,$wmTarget2);
					
					
					$this->Venue->create();
					
					if($this->Venue->save($venueDataArr,false)){
					
					  //Mail to user
						$to	=	$this->data['User']['email'];
								
						$subject	=   'Venue:User registration successfully';
						
						$message	=   'Your account has been created successfully as photographer following is your details';
						
						$message	.=   '<table width="50%">';
						
						$message	.=   '<tr><td>Username:</td><td>'.$this->data['User']['username'].'</td></tr>';
						
						$message	.=   '<tr><td>Password:</td><td>'.$this->data['User']['password'].'</td></tr>';
								
						
								
						$this->_mail($to,$subject,$message);
					
					
					$this->Session->setFlash(__('The venue has been saved'),'flash_custom_success');
				
					$this->redirect(array('action' => 'index'));
					
					}else{
					
					$this->Session->setFlash(__('The venue could not be saved. Please, try again'),'flash_custom_error');
					
					}
				
				
				}else{
				
				$this->Session->setFlash(__('The venue could not be saved. Please, try again'),'flash_custom_error');
				
				}
				
				
			}else {
					
				$this->Session->setFlash(__('The venue could not be saved. Please, try again.'),'flash_custom_error');
			}
		}
		$users = $this->Venue->User->find('list');
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
		
		$this->Venue->id = $id;
		if (!$this->Venue->exists()) {
			throw new NotFoundException(__('Invalid photographer'));
		}
		$venueData = $this->Venue->read(null, $id);
		
		if(empty($this->data)){
		
		$this->request->data['User']=$venueData['User'];
		
		$this->request->data['User']['name']=$venueData['Venue']['name'];
	
		$this->request->data['User']['mobile']=$venueData['Venue']['mobile'];
		
		$this->request->data['User']['address']=$venueData['Venue']['address'];
		
		$this->request->data['User']['town']=$venueData['Venue']['town'];
		
		$this->request->data['User']['county']=$venueData['Venue']['county'];
		
		$this->request->data['User']['postcode']=$venueData['Venue']['postcode'];
		
		$this->request->data['User']['venue_id']=$venueData['Venue']['id'];
		
		$this->request->data['User']['user_id']=$venueData['Venue']['user_id'];
		
		$this->request->data['User']['watermark_image_type']=$venueData['Venue']['watermark_image_type'];
		
		
		
		}else{
		$this->loadModel('User');
			
			$isNewImage=false;
			
			
			//check if image is not uploaded ........................................
			if($this->request->data['User']['watermark_image']['name']==''){
			
			$this->request->data['User']['watermark_image']['name']='venue_user_'.$this->request->data['User']['id'].'.png';
			
			$this->request->data['User']['watermark_image']['type']='image/png';
			
			
			}else{
			
			$isNewImage=true;	
			
			
			}
			
			
			$this->User->set($this->data);
			
			if ($this->User->AddVenueValidate()) {
			
					//code for creating user array for updating user data
					$userDataArr=array();
						
					$userDataArr['User']['username']=$this->data['User']['username'];
						
					$userDataArr['User']['email']=$this->data['User']['email'];
					
					if($this->User->save($userDataArr,false)){
						
						//code for creating photographer array for updating photographer data
						$venueDataArr=array();
						
						$venueDataArr['Venue']['user_id']=$this->data['User']['id'];
						
						$venueDataArr['Venue']['id']=$this->data['User']['venue_id'];
						
						$venueDataArr['Venue']['name']=$this->data['User']['name'];
						
						$venueDataArr['Venue']['mobile']=$this->data['User']['mobile'];
						
						$venueDataArr['Venue']['address']=$this->data['User']['address'];
						
						$venueDataArr['Venue']['town']=$this->data['User']['town'];
						
						$venueDataArr['Venue']['county']=$this->data['User']['county'];
						
						$venueDataArr['Venue']['postcode']=$this->data['User']['postcode'];
						
						$venueDataArr['Venue']['watermark_image_type']=$this->data['User']['watermark_image_type'];
						
						if($isNewImage){
						
									@unlink(WWW_ROOT."/uploads/watermark-venue/venue_user_".$this->data['User']['id'].".png");
									
									@unlink(WWW_ROOT."/uploads/watermark-venue/60x60/venue_user_".$this->data['User']['id'].".png");
									
									@unlink(WWW_ROOT."/uploads/watermark-venue/120x120/venue_user_".$this->data['User']['id'].".png");
									
									$fileName = $this->data['User']['watermark_image']['name'];
					
									$tmpName  = $this->data['User']['watermark_image']['tmp_name'];
									
									$waterMarkInfo = getimagesize($tmpName);
									
									$waterMarkWidth = $waterMarkInfo[0];
									
									$waterMarkHeight = $waterMarkInfo[1];
									
									move_uploaded_file($tmpName, WWW_ROOT."/uploads/watermark-venue/venue_user_".$this->data['User']['id'].".png");
				
									$wmTarget=WWW_ROOT.'/uploads/watermark-venue/venue_user_'.$this->data['User']['id'].'.png';
				
									
									$wmTarget1=WWW_ROOT.'/uploads/watermark-venue/60x60/venue_user_'.$this->data['User']['id'].'.png';
				
									$this->Image->resize_png_image(WWW_ROOT."/uploads/watermark-venue/venue_user_".$this->data['User']['id'].".png",60,60,$wmTarget1);				
				
									$wmTarget2=WWW_ROOT.'/uploads/watermark-venue/120x120/venue_user_'.$this->data['User']['id'].'.png';
				
									$this->Image->resize_png_image(WWW_ROOT."/uploads/watermark-venue/venue_user_".$this->data['User']['id'].".png",120,120,$wmTarget2);
									
									
									
						
						}
						
						
						if($this->Venue->save($venueDataArr,false)){
						
						/*Redirect accordingly user role..............................................*/						
						if($this->Session->read('Auth.User.role')=='admin'){
						
						$this->Session->setFlash(__('The venue has been updated'),'flash_custom_success');
					
						$this->redirect(array('action' => 'index'));
						
						}else{
						
						$this->Session->setFlash(__('Your profile has been updated'),'flash_custom_success');
							
						$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
						
						}
						
						}else{
						
						$this->Session->setFlash(__('The venue could not be updated. Please, try again.'),'flash_custom_error');
						
						}
					
					
					}else{
					
					$this->Session->setFlash(__('The venue could not be updated. Please, try again.'),'flash_custom_error');
					
					}
						
					
			
			}else{
			
			$this->Session->setFlash(__('The venue could not be updated. Please, try again.'),'flash_custom_error');
			
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
		$this->Venue->id = $id;
		if (!$this->Venue->exists()) {
			throw new NotFoundException(__('Invalid venue'));
		}
		
		$this->{$this->modelClass}->recursive = -1;
		$venueData	=	$this->{$this->modelClass}->read();
		
		$this->loadModel('User');
		
		$this->User->id = $venueData['Venue']['user_id'];
		
		if ($this->User->delete() && $this->Venue->delete()) {
			$this->Session->setFlash(__('Venue deleted'),'flash_custom_success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Venue was not deleted'),'flash_custom_error');
		$this->redirect(array('action' => 'index'));
	}
	
	
	public function ajaxGetVenueList(){
			
			
			if($_REQUEST['venue']!=''){
				//$string     = file_get_contents("http://licklist.co.uk/ajax/autocomplete?&type=venues&term=".$_REQUEST['venue']);
				$string     = file_get_contents(Configure::read('AppVenueUrl').$_REQUEST['venue']);
				
				$json_array = json_decode($string,true);
				
				header("Content-Type: text/xml");

				echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><results>";
				for ($i=0;$i<count($json_array);$i++){
						echo "<rs id=\"".$json_array[$i]['id']."\" info=\"".$json_array[$i]['name']."\">".$json_array[$i]['name']."</rs>";
				}
				echo "</results>";
			}	
		
		die;
	}
	
	public function ajaxGetVenueData(){
	
			if($_POST['venue']!=''){
				$string     = file_get_contents(Configure::read('AppVenueUrl').$_POST['venue']);
				
				$json_array = json_decode($string,true);
				
				//pr($json_array);die;
				
				if(!empty($json_array)){
					
					echo json_encode($json_array[0]);
				
				}
			}	
		
		die;
	}
}
