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
class ReplenishesController extends AppController {


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		
		/*Check group,it should be photographer*/
		if($this->Session->read('Auth.User.role')!='photographer'){
		
		$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
		
		$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
		}
		
		$this->loadModel('Job');
		
		if (!empty($this->data)) {
			
			$this->Job->set($this->request->data);
			 	
			 if($this->Job->checkReplenishCard()){
			 		
			  $this->loadModel('Photographer');
					
			  $photographerDetails=$this->Photographer->find('first',array('conditions'=>array('Photographer.id'=>$this->Session->read('Auth.User.photographer_id'))));
					
			  $replenishArr=array();
					
			  $replenishArr['Replenish']['photographer_name']=$photographerDetails['Photographer']['name'];
					
			  $replenishArr['Replenish']['card']=$this->data['Job']['card'];
					
				if($this->Replenish->save($replenishArr,false)){
					
					$subject	=   'Photography:Replenish cards request';
					
					$message	=   'Here is  details';
						
					$message	.=   '<table width="50%">';
						
					$message	.=   '<tr><td>Card Number:</td><td>'.$this->data['Job']['card'].'</td></tr>';
					
					$message	.=   '<tr><td>Photographer Name:</td><td>'.$photographerDetails['Photographer']['name'].'</td></tr>';
					
					$message	.=   '<tr><td>Address:</td><td>'.$photographerDetails['Photographer']['address1'].','.$photographerDetails['Photographer']['address2'].','.$photographerDetails['Photographer']['town'].','.$photographerDetails['Photographer']['county'].','.$photographerDetails['Photographer']['postcode'].'</td></tr>';	
					
					$message	.=   '<tr><td>Mobile:</td><td>'.$photographerDetails['Photographer']['mobile'].'</td></tr>';
					
					$message	.=   '</table>';
					
					
					
					
					
				
				$this->_mail('hollie@licklist.co.uk',$subject,$message);
				//hollie@licklist.co.uk

				$this->Session->setFlash(__('Card Request has been send'),'flash_custom_success');
				
				$this->redirect(array('action' => 'index'));
					
				}
					
					
			 }
		
		}
		
		
		
	}
	
	public function admin_log() {
		
		/*Check group,it should be admin*/
		if($this->Session->read('Auth.User.role')!='admin'){
		
		$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
		
		$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
		}
		
		$filter=array();
		if(array_key_exists('search',$this->params->query)){
		$searchBy=$this->params->query['search'];
		$this->paginate = array(
			'conditions' => array(
				'OR' => array(
					'Replenish.photographer_name LIKE' => '%'. $searchBy . '%',
					'Replenish.card LIKE' => '%'. $searchBy . '%'
					
					)
				),
			'limit' => 5	
			);
		}else{
			$this->paginate = array('limit' => 5);
		}
		
		$this->set('replenish', $this->paginate('Replenish'));
		
	
	}
	
	function admin_sendUniformRequest(){
					
					$photographerDetails=$this->Photographer->find('first',array('conditions'=>array('Photographer.id'=>$this->Session->read('Auth.User.photographer_id'))));
					
					$subject	=   'Photography:Request New Uniform';
					
					$message	=   'Here is  details';
						
					$message	.=   '<table width="50%">';
						
					$message	.=   '<tr><td>Size:</td><td>'.$this->data['Replenish']['size'].'</td></tr>';
					
					$message	.=   '<tr><td>Photographer Name:</td><td>'.$photographerDetails['Photographer']['name'].'</td></tr>';
					
					$message	.=   '<tr><td>Address:</td><td>'.$photographerDetails['Photographer']['address1'].','.$photographerDetails['Photographer']['address2'].','.$photographerDetails['Photographer']['town'].','.$photographerDetails['Photographer']['county'].','.$photographerDetails['Photographer']['postcode'].'</td></tr>';	
					
					$message	.=   '<tr><td>Mobile:</td><td>'.$photographerDetails['Photographer']['mobile'].'</td></tr>';
					
					$message	.=   '</table>';
					
					
					
					
					
				
				$this->_mail('hollie@licklist.co.uk',$subject,$message);

				$this->Session->setFlash(__('Request For New Uniform has been send'),'flash_custom_success');
				
				$this->redirect(array('action' => 'index'));
					
				
	
	}
	
	function admin_sendNewIDCardRequest(){
					
					$photographerDetails=$this->Photographer->find('first',array('conditions'=>array('Photographer.id'=>$this->Session->read('Auth.User.photographer_id'))));
					
					$subject	=   'Photography:Request For New Id Card';
					
					$message	=   'Request For New Id Card';
						
					$message	.=   '<table width="50%">';
						
					
					$message	.=   '<tr><td>Photographer Name:</td><td>'.$photographerDetails['Photographer']['name'].'</td></tr>';
					
					$message	.=   '<tr><td>Address:</td><td>'.$photographerDetails['Photographer']['address1'].','.$photographerDetails['Photographer']['address2'].','.$photographerDetails['Photographer']['town'].','.$photographerDetails['Photographer']['county'].','.$photographerDetails['Photographer']['postcode'].'</td></tr>';	
					
					$message	.=   '<tr><td>Mobile:</td><td>'.$photographerDetails['Photographer']['mobile'].'</td></tr>';
					
					$message	.=   '</table>';
					
					
					
					
					
				
				$this->_mail('hollie@licklist.co.uk',$subject,$message);

				$this->Session->setFlash(__('Request For New Id Card has been send'),'flash_custom_success');
				
				$this->redirect(array('action' => 'index'));
					
				
	
	}
	
	function admin_requestFeedbackLatShoot(){
					
					$photographerDetails=$this->Photographer->find('first',array('conditions'=>array('Photographer.id'=>$this->Session->read('Auth.User.photographer_id'))));
					
					$subject	=   'Photography:Request feedback on last shoot';
					
					$message	=   'Request feedback on last shoot';
						
					$message	.=   '<table width="50%">';
						
					
					$message	.=   '<tr><td>Photographer Name:</td><td>'.$photographerDetails['Photographer']['name'].'</td></tr>';
					
					$message	.=   '<tr><td>Address:</td><td>'.$photographerDetails['Photographer']['address1'].','.$photographerDetails['Photographer']['address2'].','.$photographerDetails['Photographer']['town'].','.$photographerDetails['Photographer']['county'].','.$photographerDetails['Photographer']['postcode'].'</td></tr>';	
					
					$message	.=   '<tr><td>Mobile:</td><td>'.$photographerDetails['Photographer']['mobile'].'</td></tr>';
					
					$message	.=   '</table>';
					
					
					
					
					
				
				$this->_mail('ben@licklist.co.uk',$subject,$message);

				$this->Session->setFlash(__('Request feedback on last shoot has been send'),'flash_custom_success');
				
				$this->redirect(array('action' => 'index'));
					
				
	
	}
	
	function admin_sendMakeSuggestionRequest(){
					
				if($this->data['Replenish']['suggestion']==''):
				
				$this->Session->setFlash(__('Make a suggestion is required'),'flash_custom_error');
				
				$this->redirect(array('action' => 'index'));
				
				endif;
				
				$photographerDetails=$this->Photographer->find('first',array('conditions'=>array('Photographer.id'=>$this->Session->read('Auth.User.photographer_id'))));
				
				
					
					$subject	=   'Photography:Make a suggestion';
					
					$message	=   'Make a suggestion';
						
					$message	.=   '<table width="50%">';
						
					
					$message	.=   '<tr><td>Photographer Name:</td><td>'.$photographerDetails['Photographer']['name'].'</td></tr>';
					
					$message	.=   '<tr><td>Address:</td><td>'.$photographerDetails['Photographer']['address1'].','.$photographerDetails['Photographer']['address2'].','.$photographerDetails['Photographer']['town'].','.$photographerDetails['Photographer']['county'].','.$photographerDetails['Photographer']['postcode'].'</td></tr>';	
					
					$message	.=   '<tr><td>Mobile:</td><td>'.$photographerDetails['Photographer']['mobile'].'</td></tr>';
					
					$message	.=   '<tr><td>Suggestion:</td><td>'.$this->data['Replenish']['suggestion'].'</td></tr>';
					
					$message	.=   '</table>';
					
					
					
					
					
				
				$this->_mail('ben@licklist.co.uk',$subject,$message);

				$this->Session->setFlash(__('Request for make a suggestion has been send'),'flash_custom_success');
				
				$this->redirect(array('action' => 'index'));
					
				
	
	}
	

}
