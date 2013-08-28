<?php
class CommonHelper extends AppHelper {

	

	public function getJobUploadDate($jobId){
	//let $modelName be User  
		App::import("Model", "Gallery");  

		$model = new Gallery();  
		
		$model->recursive=-1;
		
		$gallery=$model->find('first',array('fields'=>array('Gallery.created'),'conditions'=>array('Gallery.job_id'=>$jobId)));
		
		if(!empty($gallery['Gallery'])){
		
		echo h(date('d-m-Y h:i:s',strtotime($gallery['Gallery']['created'])));
		
		}else{
		
		echo 'Pending';
		
		}
		
	}
	
	/*function for calculation total shoots till date  */
	public function totalShootToDate($photographer_id){
	
		App::import("Model", "Job");  

		$model = new Job();  
		
		$model->recursive=-1;
		
		//$shootDate=$model->find('count',array('conditions'=>array('Job.shoot_date <='=>date('Y-m-d 12:00:00'),'Job.photographer_id'=>$photographer_id)));
		
		$shootDate=$model->find('count', array(
							'joins' => array(
								array(
									'table' => 'galleries',
									'alias' => 'Gallery',
									'type' => 'INNER',
									'conditions' => array(
										'Gallery.job_id = Job.id'
									)
								)
							),
							'conditions' => array('Job.shoot_date <='=>date('Y-m-d 12:00:00'),'Job.photographer_id'=>$photographer_id)
						));
		
		
		return $shootDate;
	
	}
	
	/*function for calculation total earning till date  */
	public function totalEarningToDate($photographer_id){
	
	App::import("Model", "Job");  

	$model = new Job();  
		
	$model->recursive=-1;
		
		
	$totalEarning=$model->find('first', array(
							'joins' => array(
								array(
									'table' => 'invoices',
									'alias' => 'Invoice',
									'type' => 'INNER',
									'conditions' => array(
										'Invoice.job_id = Job.id'
									)
								)
							),
							'fields' => array('Sum(Invoice.price) as total'),
							'conditions' => array('Invoice.is_paid'=>'yes','Job.photographer_id'=>$photographer_id)
						));
						
		return ($totalEarning[0]['total']!='')?$totalEarning[0]['total']:'0.00';
		
	
	}
	
	
}
