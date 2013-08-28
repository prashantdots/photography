<?php
App::uses('AppController', 'Controller');
/**
* Jobs Controller
*
* @property Job $Job
*/
class JobsController extends AppController {


	/**
	* admin_index method
	*
	* @return void
	*/
	public $components = array('Mpdf');
	
	public function admin_index($keyword='') {
	
		/*Check if logged in user is photographer and venue*/
		if($this->Session->read('Auth.User.role')=='venue' || $this->Session->read('Auth.User.role')=='photographer'){
			
			$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
			
			$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
		}
		
		$this->Job->recursive = 0;
		$filter=array();
		if(array_key_exists('search',$this->params->query)){
			$searchBy=$this->params->query['search'];
			$this->paginate = array(
				'conditions' => array(
					'OR' => array(
							array('AND'=>array('Job.is_live'=>'yes')),
							array('AND'=>array(
								'Job.job_no LIKE' => '%'. $searchBy . '%',
								'Job.venue_contact_person LIKE' => '%'. $searchBy . '%',
								'Job.ordered_by LIKE' => '%'. $searchBy . '%',
								'Job.photographer_name LIKE' => '%'. $searchBy . '%'
							)
						)
					) 
				
				),
				'limit' => 5	
			);
		}else{
			$this->paginate = array('conditions' => array('Job.is_live'=>'yes'),'limit' => 5);
		}
		
		
		$this->set('jobs', $this->paginate('Job'));
	}
	
	/**
	* admin_index method
	*
	* @return void
	*/
	
	public function admin_optionedJob($keyword='') {
		
		/*Check if logged in user is photographer and venue*/
		if($this->Session->read('Auth.User.role')=='venue' || $this->Session->read('Auth.User.role')=='photographer'){
		
			$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
			
			$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
		}
		
		$this->Job->recursive = 0;
		$filter=array();
		if(array_key_exists('search',$this->params->query)){
			$searchBy=$this->params->query['search'];
			$this->paginate = array(
				'conditions' => array(
					'OR' => array(
					array('AND'=>array('Job.is_live'=>'new')),
					array('AND'=>array(
							'Job.job_no LIKE' => '%'. $searchBy . '%',
							'Job.venue_contact_person LIKE' => '%'. $searchBy . '%',
							'Job.ordered_by LIKE' => '%'. $searchBy . '%',
							'Job.photographer_name LIKE' => '%'. $searchBy . '%'
							)
						)
					) 
				
				),
				'limit' => 5	
			);
		}else{
			$this->paginate = array('conditions' => array('Job.is_live'=>'no'),'limit' => 5);
		}
		
		
		$this->set('jobs', $this->paginate('Job'));
	}	
	
	/**
	* admin_view method
	*
	* @throws NotFoundException
	* @param string $id
	* @return void
	*/
	public function admin_view($id = null) {
		$this->Job->id = $id;
		if (!$this->Job->exists()) {
			throw new NotFoundException(__('Invalid job'));
		}
		$this->set('job', $this->Job->read(null, $id));
	}
	
	/**
	* admin_add method
	*
	* @return void
	*/
	public function admin_add($type='') {
		/*Check if logged in user is photographer and venue*/
		if($this->Session->read('Auth.User.role')=='venue' || $this->Session->read('Auth.User.role')=='photographer'){
		
			$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
			
			$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
		}
		
		/*Check if job is lived or optioned*/
		if(isset($_GET['jobtype']) && $_GET['jobtype']!=''){
		
			$this->Session->write('jobType',$_GET['jobtype']);
		
		}
		
		
		if ($this->request->is('post')) {
		
			/*It shows call sheet preview*/	
			if($type=='preview'){
			
				$this->Job->set( $this->data);
				
				if ($this->Job->validates()) {
					$this->loadModel('Photographer');
					$this->loadModel('Venue');
				
					$photographer=$this->Photographer->find('first',array('condition'=>array('Photographer.id'=>$this->data['Job']['photographer_id'])));
					
					$venue=$this->Venue->find('first',array('condition'=>array('Venue.id'=>$this->data['Job']['venue_id'])));
				
					$job=$this->data;
					
					$this->set(compact('photographer','job','venue'));
					$this->layout='preview';
				
				
				}else{
				
					$this->Session->setFlash(__('The job could not preview. Please, try again.'),'flash_custom_error');
				
				}
			
			}else{
				if($this->Session->read('jobType')=='optionPhotographer')
				$this->request->data['Job']['is_live']='no';
				else
				$this->request->data['Job']['is_live']='yes';
				
				$this->Job->create();
				
				//pr($this->request->data);die;
				
				if ($this->Job->save($this->request->data)) {
				
				$insertedUserId = $this->Job->id;
				
				$pdfUserdata = $this->Job->read(null, $insertedUserId);
				
				$fileUrl='';
				if($this->Session->read('jobType')=='live'){
				
					$this->helpers[] = 'Pdf';
					App::import('Helper', 'Pdf');					
					$this->Pdf = new PdfHelper(new View(null));					
					$html = $this->Pdf->pdfTemplate($pdfUserdata);
					$this->Mpdf->init();					
					$mpdf = new mPDF();					
					$mpdf->WriteHTML($html);
					
					//$from_name 		= $pdfUserdata['Job']['photographer_name'];
					$newName 		= strtolower($pdfUserdata['Job']['photographer_name']);
					$mName 			= preg_replace('/\s+/', '',$newName);
					$filename 		= time()."_".$mName.".pdf";
					$mpdf->Output("pdf/".$filename,'F');
					$fileUrl=WWW_ROOT."pdf/" .$filename;
				
				}
				
				$to 	= $pdfUserdata['Job']['photographer_email'];
				
				
				$subject	=   'Job created:Job created  successfully';
				
				$message = '';
				
				if($this->Session->read('jobType')=='optionPhotographer')
				$message	.=   '<strong>This is not a live job. You must only attend this job if it becomes live</strong><br/>';
				
				$message	.=   'Job has been created successfully  following is venue details';
				$message	.=   '<table width="50%">';
				$message	.=   '<tr><td>Contact Person:</td><td>'.$this->data['Job']['venue_contact_person'].'</td></tr>';
				$message	.=   '<tr><td>Mobile:</td><td>'.$this->data['Job']['venue_mobile'].'</td></tr>';	
				$message	.=   '<tr><td>Address:</td><td>'.$this->data['Job']['venue_address'].'</td></tr>';
				$message	.=   '<tr><td>Shoot Date:</td><td>'.$this->data['Job']['shoot_date'].'</td></tr>';
				
				
				
				$this->_mail($to,$subject,$message,$fileUrl);
				
				$this->loadModel('Setting');
				$settingDetails=$this->Setting->find('first');
				$this->_mail($settingDetails['Setting']['email'],$subject,$message);
				$this->_mail($settingDetails['Setting']['email1'],$subject,$message);
				$this->_mail($settingDetails['Setting']['emai2'],$subject,$message);
				
				
				$this->Session->setFlash(__('The job has been saved'),'flash_custom_success');
				$this->redirect(array('action' => 'index'));
				
				} else {
				$this->Session->setFlash(__('The job could not be saved. Please, try again.'),'flash_custom_error');
				}
			
			}
			
		
		}
		$venues = $this->Job->Venue->find('list');
		$photographers = $this->Job->Photographer->find('list');
		$this->set(compact('venues', 'photographers'));
	}
	
	/**
	* admin_edit method
	*
	* @throws NotFoundException
	* @param string $id
	* @return void
	*/
	
	public function admin_edit($id = null) {
		/*Check if logged in user is photographer and venue*/
		if($this->Session->read('Auth.User.role')=='venue' || $this->Session->read('Auth.User.role')=='photographer'){
		
			$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
			
			$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
		}
		
		$this->Job->id = $id;
		if (!$this->Job->exists()) {
			throw new NotFoundException(__('Invalid job'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
		
			if ($this->Job->save($this->request->data)) {
			
				$insertedUserId = $this->Job->id;
				//pdf work process start
				$this->helpers[] = 'Pdf';
				$pdfUserdata = $this->Job->read(null, $insertedUserId);
				//pr($pdfUserdata);die;
				App::import('Helper', 'Pdf');					
				$this->Pdf = new PdfHelper(new View(null));					
				$html = $this->Pdf->pdfTemplate($pdfUserdata,'edit');
				
				$this->Mpdf->init();					
				
				$mpdf = new mPDF();					
				
				$mpdf->WriteHTML($html);
				
				//$from_name 		= $pdfUserdata['Job']['photographer_name'];
				
				$newName 		= strtolower($pdfUserdata['Job']['photographer_name']);
				
				$mName 			= preg_replace('/\s+/', '',$newName);
				
				$filename 		= time()."_".$mName.".pdf";
									
				$mpdf->Output("pdf/".$filename,'F');
				
				$to 	= $pdfUserdata['Job']['photographer_email'];
				
				
				$subject	=   'Job created:Job created  successfully';
				$message	=   'Job has been created successfully  following is venue details';
				$message	.=   '<table width="50%">';
				$message	.=   '<tr><td>Contact Person:</td><td>'.$this->data['Job']['venue_contact_person'].'</td></tr>';
				$message	.=   '<tr><td>Mobile:</td><td>'.$this->data['Job']['venue_mobile'].'</td></tr>';	
				$message	.=   '<tr><td>Address:</td><td>'.$this->data['Job']['venue_address'].'</td></tr>';
				$message	.=   '<tr><td>Shoot Date:</td><td>'.$this->data['Job']['shoot_date'].'</td></tr>';
				
				$this->_mail($to,$subject,$message,WWW_ROOT."pdf/" .$filename);
				
				
				
				$this->loadModel('Setting');
				$settingDetails=$this->Setting->find('first');
				$this->_mail($settingDetails['Setting']['email'],$subject,$message);
				$this->_mail($settingDetails['Setting']['email1'],$subject,$message);
				$this->_mail($settingDetails['Setting']['emai2'],$subject,$message);
				$this->Session->setFlash(__('The job has been updated'),'flash_custom_success');
				$this->redirect(array('action' => 'index'));
				
				
				
				$this->Session->setFlash(__('The job has been updated'),'flash_custom_success');
				$this->redirect(array('action' => 'index'));
			} else {
				
				$this->Session->setFlash(__('The job could not be updated. Please, try again.'),'flash_custom_error');
			
			}
		} else {
				$this->request->data = $this->Job->read(null, $id);
		}
		$venues = $this->Job->Venue->find('list');
		$photographers = $this->Job->Photographer->find('list');
		$this->set(compact('venues', 'photographers'));
	}
	
	/**
	* admin_editCallSheet method
	*
	* @throws NotFoundException
	* @param string $id
	* @return void
	*/
	
	public function admin_reUserOrder($id = null) {
	
		/*Check if logged in user is photographer and venue*/
		if($this->Session->read('Auth.User.role')=='venue' || $this->Session->read('Auth.User.role')=='photographer'){
		
			$this->Session->setFlash(__('Invalid Access'),'flash_custom_error');
			$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));
		
		}
		
		$this->Job->id = $id;
		
		if (!$this->Job->exists()) {
			throw new NotFoundException(__('Invalid job'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
		
			$this->Job->create();
			if ($this->Job->save($this->request->data)) {
			
				$insertedUserId = $this->Job->id;
				//pdf work process start
				$this->helpers[] = 'Pdf';
				$pdfUserdata = $this->Job->read(null, $insertedUserId);
				//pr($pdfUserdata);die;
				 App::import('Helper', 'Pdf');					
				 $this->Pdf = new PdfHelper(new View(null));					
				
				$html = $this->Pdf->pdfTemplate($pdfUserdata);
				$this->Mpdf->init();					
				$mpdf = new mPDF();					
				$mpdf->WriteHTML($html);
				
				//$from_name 		= $pdfUserdata['Job']['photographer_name'];
				
				$newName 		= strtolower($pdfUserdata['Job']['photographer_name']);
				$mName 			= preg_replace('/\s+/', '',$newName);
				$filename 		= time()."_".$mName.".pdf";
									
				$mpdf->Output("pdf/".$filename,'F');
				
				$to 	= $pdfUserdata['Job']['photographer_email'];
				
				
				$subject	=   'Job created:Job created  successfully';
				$message	=   'Job has been created successfully  following is venue details';
				$message	.=   '<table width="50%">';
				$message	.=   '<tr><td>Contact Person:</td><td>'.$this->data['Job']['venue_contact_person'].'</td></tr>';
				$message	.=   '<tr><td>Mobile:</td><td>'.$this->data['Job']['venue_mobile'].'</td></tr>';	
				$message	.=   '<tr><td>Address:</td><td>'.$this->data['Job']['venue_address'].'</td></tr>';
				$message	.=   '<tr><td>Shoot Date:</td><td>'.$this->data['Job']['shoot_date'].'</td></tr>';
				
				
				
				$this->_mail($to,$subject,$message,WWW_ROOT."pdf/" .$filename);
				
				$this->loadModel('Setting');
				$settingDetails=$this->Setting->find('first');
				$this->_mail($settingDetails['Setting']['email'],$subject,$message);
				$this->_mail($settingDetails['Setting']['email1'],$subject,$message);
				$this->_mail($settingDetails['Setting']['emai2'],$subject,$message);
				$this->Session->setFlash(__('The job has been saved'),'flash_custom_success');
				$this->redirect(array('action' => 'index'));
			
			} else {
				$this->Session->setFlash(__('The job could not be saved. Please, try again.'),'flash_custom_error');
			}
		
		} else {
			$this->request->data = $this->Job->read(null, $id);
		}
			$venues = $this->Job->Venue->find('list');
			$photographers = $this->Job->Photographer->find('list');
		
		
		
		$this->set(compact('venues', 'photographers'));
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
		$this->Job->id = $id;
		if (!$this->Job->exists()) {
			throw new NotFoundException(__('Invalid job'));
		}
		if ($this->Job->delete()) {
			$this->Session->setFlash(__('Job deleted'),'flash_custom_success');
			$this->redirect(array('action' => 'index'));
		}
			$this->Session->setFlash(__('Job was not deleted'),'flash_custom_error');
			$this->redirect(array('action' => 'index'));
	}
	
	/**
	* admin_live method
	*
	* @throws MethodNotAllowedException
	* @throws NotFoundException
	* @param string $id
	* @return void
	*/
	public function admin_live($id = null) {
	
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Job->id = $id;
		if (!$this->Job->exists()) {
			throw new NotFoundException(__('Invalid job'));
		}
		$this->Job->updateAll(array('Job.is_live'=>"'yes'"), array('Job.id'=>$id));
		
		$pdfUserdata = $this->Job->read(null, $id);
		$this->helpers[] = 'Pdf';
		App::import('Helper', 'Pdf');					
		$this->Pdf = new PdfHelper(new View(null));					
		$html = $this->Pdf->pdfTemplate($pdfUserdata);
		$this->Mpdf->init();					
		$mpdf = new mPDF();					
		$mpdf->WriteHTML($html);
		
		$newName 		= strtolower($pdfUserdata['Job']['photographer_name']);
		$mName 			= preg_replace('/\s+/', '',$newName);
		$filename 		= time()."_".$mName.".pdf";
		$mpdf->Output("pdf/".$filename,'F');
		
		$fileUrl=WWW_ROOT."pdf/" .$filename;
		
		$to 		 = $pdfUserdata['Job']['photographer_email'];
		$subject	 =   'Job created:Job created  successfully';
		$message 	 = 	'';
		$message	.=   'Job has been lived  following is venue details';
		$message	.=   '<table width="50%">';
		$message	.=   '<tr><td>Contact Person:</td><td>'.$pdfUserdata['Job']['venue_contact_person'].'</td></tr>';
		$message	.=   '<tr><td>Mobile:</td><td>'.$pdfUserdata['Job']['venue_mobile'].'</td></tr>';	
		$message	.=   '<tr><td>Address:</td><td>'.$pdfUserdata['Job']['venue_address'].'</td></tr>';
		$message	.=   '<tr><td>Shoot Date:</td><td>'.$pdfUserdata['Job']['shoot_date'].'</td></tr>';
			
		$this->_mail($to,$subject,$message,$fileUrl);
		
		$this->loadModel('Setting');
		$settingDetails=$this->Setting->find('first');
		$this->_mail($settingDetails['Setting']['email'],$subject,$message);
		$this->_mail($settingDetails['Setting']['email1'],$subject,$message);
		$this->_mail($settingDetails['Setting']['emai2'],$subject,$message);
		
		
		$this->Session->setFlash(__('Job has been lived'),'flash_custom_error');
		$this->redirect(array('action' => 'index'));
	}	
	
	/**
	* ajaxVenueDetails method
	* call using ajax 
	* @return venue details array in json encoded
	*/
	public function ajaxVenueDetails(){
	
		$this->loadModel('Venue');
		$venues = $this->Venue->find('first',array('conditions'=>array('Venue.id'=>$_POST['id'])));
		$venuesArr["name"]= $venues['Venue']['name'];
		$venuesArr["mobile"]= $venues['Venue']['mobile'];
		$venuesArr["address"]= $venues['Venue']['address'].','.$venues['Venue']['town'].','.$venues['Venue']['county'];
		$venuesArr["postcode"]= $venues['Venue']['postcode'];
		echo json_encode($venuesArr);
		exit;
	
	}

	/**
	* ajaxPhotographyDetails method
	* call using ajax 
	* @return photography details array in json encoded
	*/
	function ajaxPhotographyDetails(){
	
		$this->loadModel('Photographer');
		$photographer = $this->Photographer->find('first',array('conditions'=>array('Photographer.id'=>$_POST['id'])));
		$photographerArr["name"]= $photographer['Photographer']['name'];
		$photographerArr["mobile"]= $photographer['Photographer']['mobile'];
		$photographerArr["website"]= $photographer['Photographer']['website'];
		$photographerArr["email"]= $photographer['User']['email'];
		echo json_encode($photographerArr);
		exit;
	
	}


}
