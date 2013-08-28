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
class InvoicesController extends AppController {

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index(){
	
		/*Check if logged in user is photographer and venue*/
		if($this->Session->read('Auth.User.role')=='venue' || $this->Session->read('Auth.User.role')=='photographer'){
		
		$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
		
		$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
		}
		
		$this->Invoice->recursive = 0;
		$filter=array();
		if(array_key_exists('search',$this->params->query)){
		$searchBy=$this->params->query['search'];
		$this->paginate = array(
			'conditions' => array(
				'OR' => array(
					'Invoice.photographer_name LIKE' => '%'. $searchBy . '%',
					'Invoice.venue_contact_person LIKE' => '%'. $searchBy . '%',
					'Invoice.price LIKE' => '%'. $searchBy . '%'
					)
				),
			'limit' => 5	
			);
		}else{
			$this->paginate = array('limit' => 5);
		}
		
		
		$this->set('invoices', $this->paginate('Invoice'));
	
	
	}


/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		
		$this->loadModel('Job');
		
		
		if (!empty($this->data)) {
			
			$this->Job->set($this->request->data);
			 	
			 if($this->Job->checkInvoiceForm()){
			 
			$allUninvoicedArr= $this->Invoice->find('all',array('fields'=>array('Invoice.price','Invoice.venue_contact_person','Job.job_no'),'conditions'=>array('Invoice.photographer_name'=>$this->data['Job']['photographer_name'])));
			
			
			
			 	
			$invoiceExist=$this->Invoice->findByJobId($this->data['Job']['job']);
				
				if(!empty($invoiceExist)){
				
				$this->Session->setFlash(__('Invoice already created'),'flash_custom_success');
				
				$this->redirect(array('action' => 'add'));
				
				}
				
				$invoiceArr=array();
				
				$invoiceArr['Invoice']['job_id']=$this->data['Job']['job'];
				
				$invoiceArr['Invoice']['photographer_name']=$this->data['Job']['photographer_name'];
				
				$invoiceArr['Invoice']['venue_contact_person']=$this->data['Job']['venue'];
				
				$invoiceArr['Invoice']['price']=$this->data['Job']['price'];
				
				$invoiceArr['Invoice']['issue_date']=date('Y-m-d 12:00:00',strtotime($this->data['Job']['date']));
				
				if($this->Invoice->save($invoiceArr,false)){
					
					$subject	=   'Photography:Invoice Details';
					
					$message	=   'Here is invoice details';
						
					$message	.=   '<table width="50%">';
					
					if(!empty($allUninvoicedArr)){
						$message	.=   '<tr><td colspan="2">All Outstanding Payment</td></tr>';
						
						foreach($allUninvoicedArr as $outstandiingPayment){
						
						$message	.=   '<tr><td>JobNo-'.$outstandiingPayment['Job']['job_no'].'</td><td>&pound;'.$outstandiingPayment['Invoice']['price'].'</td></tr>';
						
						}
					
					
					}
						
					$message	.=   '<tr><td>Photographer name:</td><td>'.$this->data['Job']['photographer_name'].'</td></tr>';
					
					$message	.=   '<tr><td>Job number:</td><td>'.$this->data['Job']['job'].'</td></tr>';
					
					$message	.=   '<tr><td>Date:</td><td>'.$this->data['Job']['date'].'</td></tr>';	
					
					$message	.=   '<tr><td>Venue:</td><td>'.$this->data['Job']['venue'].'</td></tr>';
					
					$message	.=   '<tr><td>Price:</td><td>&pound;'.$this->data['Job']['price'].'</td></tr>';
					
					
				$this->_mail('brad@licklist.co.uk',$subject,$message);
				//brad@licklist.co.uk
				$this->Session->setFlash(__('Invoice has been send'),'flash_custom_success');
				
				$this->redirect(array('action' => 'add'));
				
				}else{
				
				$this->Session->setFlash(__('Error while saving invoice'),'flash_custom_error');
				
				$this->redirect(array('action' => 'add'));
				
				}
			 }
		
		}
		
		
		$this->Job->recursive = -1;
		
		
		$this->set('jobs', $this->Job->find('list',array('fields'=>array('job_no'),'conditions'=>array('Job.photographer_id'=>$this->Session->read('Auth.User.photographer_id')))));
	}
	


	
	public function ajaxJobDetails(){
	
		$this->loadModel('Job');
		
		
		$jobs = $this->Job->find('first',array('conditions'=>array('Job.id'=>$_POST['job_no'])));
		
			
		$jobsArr["date"]= $jobs['Job']['shoot_date'];
		
		$jobsArr["venue"]= $jobs['Job']['venue_contact_person'];
		
		$jobsArr["photographer_name"]= $jobs['Job']['photographer_name'];
		
		$jobsArr["price"]= $jobs['Job']['agreed_photographer_fee'];
	
		
		echo json_encode($jobsArr);
		
		exit;
	
	}
	
	function admin_paid($id = null) {
	
		/*Check if logged in user is photographer and venue*/
		if($this->Session->read('Auth.User.role')=='venue' || $this->Session->read('Auth.User.role')=='photographer'){
		
		$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
		
		$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
		}
		
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Invoice->id = $id;
		if (!$this->Invoice->exists()) {
			throw new NotFoundException(__('Invalid invoice'));
		}
		
		$this->Invoice->updateAll(array('Invoice.is_paid'=>"'yes'"), array('Invoice.id'=>$id));
		
		$this->Session->setFlash(__('Invoice mark as paid'),'flash_custom_success');
		$this->redirect(array('action' => 'index'));
	}



}
