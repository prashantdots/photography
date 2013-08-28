<?php
App::uses('AppController', 'Controller');
/**
 * Calendar Controller
 *
 * @property Calendar $Calendar
 */
class CalendarsController extends AppController {

public $helpers = array('Html');

	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		
		
	}
	
	/*return all the booking of photographer,when photographer is logged in*/
	public function getAvailability(){
	
		$this->loadModel('Job');
	
		$this->Job->recursive=-1;
	
		$jobDetails=$this->Job->find('all',array('fields'=>array('id','job_no','shoot_date','photographer_website'),'conditions'=>array('photographer_id'=>$this->Session->read('Auth.User.photographer_id'))));
	
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
		
		$bookingDetails=$this->BookingReason->find('all',array('conditions'=>array('photographer_id'=>$this->Session->read('Auth.User.photographer_id'))));
		
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
	
	/*
	this method called by ajax to
	date is set in post array
	check photographer booking this particular date
	*/
	public function ajaxCheckPhotographerBooking(){
		
		$date = explode('/',$_POST['date']);
		
		if(strtotime(date('Y-m-d')) >= strtotime(date($date[2].'-'.$date[1].'-'.$date[0]))){
		
		echo json_encode(array('response'=>'fail'));
		
		die();
		}
		
		if(!empty($date)){
		
		$shoot_date=$date[2].'-'.$date[1].'-'.$date[0].' 12:00:00';
		
		$photographer_id=$this->Session->read('Auth.User.photographer_id');
		
		$this->loadModel('Job');
		
		//echo "SELECT * FROM jobs WHERE photographer_id=".$photographer_id." AND shoot_date=".$shoot_date;die;
		$isBooking=$this->Job->find('count',array('conditions'=>array('Job.photographer_id'=>$photographer_id,'Job.shoot_date'=>$shoot_date)));
		
		if($isBooking > 0)
		echo json_encode(array('response'=>'fail'));
		else {
		
		$this->loadModel('BookingReason');
		
		$isResonBooking=$this->BookingReason->find('count',array('conditions'=>array('BookingReason.photographer_id'=>$photographer_id,'BookingReason.shoot_date'=>$shoot_date)));
		
		if($isResonBooking > 0)
		echo json_encode(array('response'=>'fail'));
		else
		echo json_encode(array('response'=>'success'));
		
		}
		
		die;
		
		
		}
		
		
		
		
		
	}
	
	/*
	this method called by ajax to
	store reason if photographer is not available
	*/
	public function ajaxSavePhotographerReason(){
	
		$date = explode('/',$_POST['date']);
		
		$reason = $_POST['reason'];
		
		if(!empty($date)){
		
		$shoot_date=$date[2].'-'.$date[1].'-'.$date[0].' 12:00:00';
		
		$this->loadModel('BookingReason');
		
		$bookingReasonArr=array();
		
		$bookingReasonArr['BookingReason']['photographer_id']=$this->Session->read('Auth.User.photographer_id');
		
		$bookingReasonArr['BookingReason']['shoot_date']=$shoot_date;
		
		$bookingReasonArr['BookingReason']['reason']=$reason;
		
		$this->BookingReason->create();
		
		if($this->BookingReason->save($bookingReasonArr))
		echo json_encode(array('response'=>'success'));
		else
		echo json_encode(array('response'=>'fail'));
		
		die;
		
		
		}
		
	
	
	}
	
	public function admin_allBooking(){

	
	}
	
	public function admin_getAllBooking($filter=''){
	
		$this->loadModel('Job');
	
		
		if($filter==''){
		$this->Job->recursive=-1;
		$jobDetails=$this->Job->find('all',array('fields'=>array('id','job_no','shoot_date','photographer_website','photographer_name','photographer_id')));
		}else{
		$jobDetails=$this->Job->find('all',array('fields'=>array('Job.id','Job.job_no','Job.shoot_date','Job.photographer_website','Job.photographer_name','Job.photographer_id'),'conditions' => array(
				'OR' => array('Photographer.county LIKE' => '%'. $filter . '%'))));
		}
		
		$jobArr=array();
		
		$i=0;
		foreach($jobDetails as $details){
	
		$jobArr[$i]['id']=$details['Job']['id'];
	
		$jobArr[$i]['title']=$details['Job']['photographer_name'].'-Available';
	
		$jobArr[$i]['start']=date('Y-m-d',strtotime($details['Job']['shoot_date']));
	
		$jobArr[$i]['url']=Router::url('/', true).'admin/photographers/view/'.$details['Job']['photographer_id'];
		
		$i++;
		}
		
		$this->loadModel('BookingReason');
		
		$bookingDetails=$this->BookingReason->find('all', array(
									'joins' => array(
										array(
											'table' => 'photographers',
											'alias' => 'Photographer',
											'type' => 'INNER',
											'conditions' => array(
												'Photographer.id = BookingReason.photographer_id'
											)
										)
									),
									'fields' => array('Photographer.title','Photographer.fname','Photographer.lname', 'BookingReason.*'),
								));

		
		foreach($bookingDetails as $booking){
	
		$jobArr[$i]['id']=$booking['BookingReason']['id'];
	
		$jobArr[$i]['title']=$booking['Photographer']['title'].' '.$booking['Photographer']['fname'].' '.$booking['Photographer']['lname'].'-'.$booking['BookingReason']['reason'];
	
		$jobArr[$i]['start']=date('Y-m-d',strtotime($booking['BookingReason']['shoot_date']));
	
		$jobArr[$i]['url']='javascript:void(0)';
		
		$i++;
		}
		
		
		
		
		echo json_encode($jobArr);	
	
	
	
		die();
	
	
	}




}
