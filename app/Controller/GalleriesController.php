<?php
App::uses('AppController', 'Controller');
/**
 * Galleries Controller
 *
 * @property Gallery $Gallery
 */
class GalleriesController extends AppController {

var $uses		= array( 'Job','Gallery','GalleryImage');

public $components = array('Image');

	
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($job_id) {
		$this->Job->id = $job_id;
		if (!$this->Job->exists()) {
			throw new NotFoundException(__('Invalid job'));
		}
		
		
		$this->Gallery->recursive=-1;
				
		$galleryArr=$this->Gallery->find('first',array('conditions'=>array('Gallery.job_id'=>$job_id)));
		
		$galleryImagesArr=array();
		if(!empty($galleryArr)){

			$this->GalleryImage->recursive = -1;
			
			$galleryImagesArr=$this->GalleryImage->find('all',array('conditions'=>array('gallery_id'=>$galleryArr['Gallery']['id'])));
		
		
		}
		
	
		
		
		$this->set(compact('galleryArr', 'job_id','galleryImagesArr'));
		
	}



/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($job_id) {
		$this->Job->id = $job_id;
		if (!$this->Job->exists()) {
			throw new NotFoundException(__('Invalid job'));
		}
			/*fetch gellery details and set if $this->data is not empty.......................................................................*/
			$jobDetails=$this->Job->find('first',array('fields'=>array('Job.venue_contact_person'),'conditions'=>array('Job.id'=>$job_id)));
							
			$this->set('venue_contact_person',$jobDetails['Job']['venue_contact_person']);
			$this->set('fileError','');
		
		if (!empty($this->data)) {
			
			
			
			$this->Gallery->set( $this->data);
			
			if($this->Gallery->galleryValidation()){
			
				$galleryArr=array();
				
				$galleryArr['Gallery']['title']=$this->data['Gallery']['title'];
				
				$galleryArr['Gallery']['description']=$this->data['Gallery']['description'];
				
				$galleryArr['Gallery']['job_id']=$job_id;
				
				$galleryArr['Gallery']['is_publish']='no';
				
				
				if(!empty($this->data['Gallery']['id'])){
				
				$this->Gallery->id=$this->data['Gallery']['id'];
				
				}else{
				
				$this->Gallery->create();
				
				}
				
				if($this->Gallery->save($galleryArr,false)){
				
					if(array_key_exists('filename',$this->data['Gallery'])){
							
							
							$waterVenue=$this->Job->find('first',array('fields'=>array('Venue.user_id','Venue.watermark_image_type'),'conditions'=>array('Job.id'=>$job_id)));
					
							$gallery_id=$this->Gallery->id;
							
							$galleryImagesArr=array();
							
							$galleryImagesArr['GalleryImage']['gallery_id']=$gallery_id;
							
							foreach($this->data['Gallery']['filename'] as $keyImage=>$image_details){

									$this->loadModel('GalleryImage');
									if(empty($image_details['name']))
									  continue;
							
									$user_image=$image_details['name'];
									$filename	=	strtolower(substr($user_image,0, (strpos($user_image,'.')-1) )).md5(time());
									$ext 		=	strtolower(substr($user_image, (strpos($user_image,'.')+1) ));
									$filename	=	str_replace(' ','_',$filename).'.'.$ext;	
															
									$uploaddir = WWW_ROOT.'uploads/gallery/'; 
					
							
					if(move_uploaded_file($image_details['tmp_name'],$uploaddir.$filename)){				
					
					if($waterVenue['Venue']['watermark_image_type']=='normal'):
				
					$venueWaterMarkImage=WWW_ROOT.'uploads/watermark-venue/120x120/venue_user_'.$waterVenue['Venue']['user_id'].'.png';
				
					else:
					/*Dynamically creating venue watermark image*/
					list($gallery_width, $gallery_height, $gallery_type) = getimagesize($uploaddir.$filename);
					list($water_width, $water_height, $water_type) = getimagesize(WWW_ROOT.'uploads/watermark-venue/venue_user_'.$waterVenue['Venue']['user_id'].'.png');
					$wmTarget1=WWW_ROOT.'/uploads/watermark-venue/temp/venue_user_'.$waterVenue['Venue']['user_id'].'.png';
					$this->Image->resize_png_image(WWW_ROOT.'uploads/watermark-venue/venue_user_'.$waterVenue['Venue']['user_id'].'.png',$gallery_width,$water_height,$wmTarget1);						                    
					$venueWaterMarkImage=WWW_ROOT.'uploads/watermark-venue/temp/venue_user_'.$waterVenue['Venue']['user_id'].'.png';
				
					endif;
															
									
					$result = $this->Image->create_watermark($uploaddir.$filename,$venueWaterMarkImage,'',$waterVenue['Venue']['watermark_image_type']);
									
									
					$result = $this->Image->create_watermark($uploaddir.$filename,WWW_ROOT.'uploads/watermark-admin/150x150/admin_watermark.png','admin',$waterVenue['Venue']['watermark_image_type']);
									
									
									
											if ($result === false) {
												return false;
											} else {
											
												$galleryImagesArr['GalleryImage']['image']=$filename;	
												
												$this->GalleryImage->create();
												
												$this->GalleryImage->save($galleryImagesArr,false);
											}
									
									
									}
							
							}
							
					
					}
					
				$this->Session->setFlash(__('Gallery has been saved'),'flash_custom_success');
				
				//$this->redirect(array('action' => 'index',$job_id));
				
				$url=Router::url('/', true)."admin/galleries/index/".$job_id;
				
				echo '<script>window.location.href="'.$url.'"</script>';		
				
				}else{
				
				$this->Session->setFlash(__('Error in saving gallery'),'flash_custom_error');
			
				}
			
			
			}else{
			
			$vaildationArray=$this->Gallery->validationErrors;
			
			if(!empty($vaildationArray) && array_key_exists('filename',$vaildationArray)){
			
			$this->set('fileError',$vaildationArray['filename']);
			
			}
			
			$this->Session->setFlash(__('The Gallery could not be saved. Please, try again.'),'flash_custom_error');
			
			}
			
			
		}else{
				$this->Gallery->recursive=-1;
							
				$galleryArr=$this->Gallery->find('first',array('conditions'=>array('Gallery.job_id'=>$job_id)));		
				
				if(!empty($galleryArr)){
					$this->data=$galleryArr;
				
				}
		}
		
		
		$this->set(compact('job_id'));

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
	
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->GalleryImage->id = $id;
		if (!$this->GalleryImage->exists()) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		
		$this->GalleryImage->recursive=0;
		
		$imageArr=$this->GalleryImage->find('first',array('fields'=>array('GalleryImage.image','Gallery.id','Gallery.job_id'),'conditions'=>array('GalleryImage.id'=>$id)));
		
		/*.....................Unlink image....................................................*/
		unlink(WWW_ROOT.'uploads'.DS.'gallery'.DS.$imageArr['GalleryImage']['image']);
		
		/*.....................Delete gallery image....................................................*/
		if ($this->GalleryImage->delete()) {
			
			/*.........................Set publish field as false.................*/
			$this->Gallery->id = $imageArr['Gallery']['id'];					
			$updatedGalleryArr['is_publish']='no';					
			$this->Gallery->save($updatedGalleryArr,false);	
					
			$this->Session->setFlash(__('Image deleted'),'flash_custom_success');
			$this->redirect(array('action' => 'index',$imageArr['Gallery']['job_id']));
		}
		
		$this->Session->setFlash(__('Image was not deleted'),'flash_custom_error');
		$this->redirect(array('action' => 'index',$imageArr['Gallery']['job_id']));
	}	
	
	
/**
 * admin_publish method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_publish($id = null) {
		
		$this->Gallery->id = $id;
		if (!$this->Gallery->exists()) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		
		$this->Gallery->recursive = -1;
		
		$galleryDetails=$this->Gallery->find('first',array('conditions'=>array('Gallery.id'=>$id)));
		
		//start if gallery is existing
		if(!empty($galleryDetails['Gallery'])):
		
		
		$this->GalleryImage->recursive=-1;
		$galleryImagesDetails=$this->GalleryImage->find('all',array('fields'=>array('image'),'conditions'=>array('GalleryImage.gallery_id'=>$id)));
		$jobDetails=$this->Job->find('first',array('fields'=>array('Venue.licklist_venue_id,Venue.name'),'conditions'=>array('Job.id'=>$galleryDetails['Gallery']['job_id'])));	
		
		
		
		
		
			$galleryArr=array();
		
			if(!empty($galleryImagesDetails)):			
			$im=0;	
			foreach($galleryImagesDetails as $images):
			
			$imagePath=Router::url('/', true).'uploads/gallery/'.$images['GalleryImage']['image'];			
			$galleryArr['uploads'][$im++]="$imagePath";
			
			endforeach;
			
			endif;	
			
			
					
			//code start if gallery is not publish
			if($galleryDetails['Gallery']['is_publish']=='no'):
				
				if($galleryDetails['Gallery']['licklist_gallery_id']==0):
				
					$galleryArr['venue_id']=	$jobDetails['Venue']['licklist_venue_id'];					
					$galleryArr['name']=	$jobDetails['Venue']['name'];						
					$galleryArr['date']=	date('Y-m-d',strtotime($galleryDetails['Gallery']['created']));	
					
				else:	
					
					$galleryArr['id']=	$galleryDetails['Gallery']['licklist_gallery_id'];					
					$galleryArr['name']=	$galleryDetails['Gallery']['title'];						
					$galleryArr['date']=	date('Y-m-d',strtotime($galleryDetails['Gallery']['created']));	
				
				endif;	
				
			else:
			
			$this->Session->setFlash(__('Gallery already published'),'flash_custom_success');					
			$this->redirect(array('action' => 'index',$galleryDetails['Gallery']['job_id']));	
			
			endif;
		//end start if gallery is not publish
		
		
		
		
		$postdata = http_build_query($galleryArr);

		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);
		
			$context  = stream_context_create($opts);
			//$returndata = file_get_contents('http://alpha.licklist.co.uk/api/photography/post?uid=12345', false, $context);
			$returndata = file_get_contents(Configure::read('AppGalleryUrl'), false, $context);
			$resultArr=json_decode($returndata);
			
			if($resultArr->success){

					$this->Gallery->updateAll(array('Gallery.is_publish'=>"'yes'",'Gallery.licklist_gallery_id'=>$resultArr->gallery_id), array('Gallery.id'=>$id));
					$this->Session->setFlash(__('Gallery has been published'),'flash_custom_success');					
					$this->redirect(array('action' => 'index',$galleryDetails['Gallery']['job_id']));
			
			}else{
			
					$this->Session->setFlash(__('Errror while publishing Gallery'),'flash_custom_error');					
					$this->redirect(array('action' => 'index',$galleryDetails['Gallery']['job_id']));
			
			}
		
		endif;
		//end if gallery is existing
		
		
		
		die;
		
		
	}
	

	
	public function admin_rejected($id = null) {
		
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->GalleryImage->id = $id;
		if (!$this->GalleryImage->exists()) {
			throw new NotFoundException(__('Invalid job'));
		}
		
		$this->GalleryImage->recursive=0;
		
		$imageArr=$this->GalleryImage->find('first',array('fields'=>array('GalleryImage.image','Gallery.job_id'),'conditions'=>array('GalleryImage.id'=>$id)));
		
		$this->request->data['GalleryImage']['is_active']='rejected';
		
		if ($this->GalleryImage->save($this->request->data,false)) {

			$this->Session->setFlash(__('Image rejected'),'flash_custom_success');
		
			$this->redirect(array('action' => 'index',$imageArr['Gallery']['job_id']));
		}
		$this->Session->setFlash(__('Image was not rejected'),'flash_custom_error');
		$this->redirect(array('action' => 'index',$imageArr['Gallery']['job_id']));
	}
	
	public function admin_createZip($id=null){
	
		 $this->Gallery->id = $id;
		
		  if (!$this->Gallery->exists()) {
				throw new NotFoundException(__('Invalid Gallery'));
		  }
		
		 $filename='gallery';
		 
		 
		 if (file_exists(WWW_ROOT.$filename)) {
			rmdir(WWW_ROOT.$filename.'/');
		 }
		
		 mkdir(WWW_ROOT.$filename.'/', 0777);
		 
		 $this->loadModel('GalleryImage');
		 
		 $this->GalleryImage->recursive=-1;
		 
		 $galleryImagesDetails=$this->GalleryImage->find('all',array('conditions'=>array('GalleryImage.gallery_id'=>$id)));
		 
		 
		 foreach($galleryImagesDetails as $value){
		 
		 copy(WWW_ROOT.'uploads/gallery/'.$value['GalleryImage']['image'], WWW_ROOT.$filename.'/'.$value['GalleryImage']['image']);
		 
		 }
		 
		 
		
		 App::import('Vendor', 'Zip', array('file' => 'CreateZipFile.inc.php')); 
		 
		 $zip			= new CreateZipFile;
		 
		 $directoryToZip="./".$filename;  // This will zip all the file(s) in this present working directory
 
		 $outputDir="/"; //Replace "/" with the name of the desired output directory.
		
		 $zipName=$filename.".zip";
		
		
		
		
		//Code toZip a directory and all its files/subdirectories
		$zip->zipDirectory($directoryToZip,$outputDir);
		
		//$rand=md5(microtime().rand(0,999999));
		
		//$zipName=$rand."_".$zipName;
		
		$fd=fopen($zipName, "wb");
		
		$out=fwrite($fd,$zip->getZippedfile());
		
		fclose($fd);
		
		$zip->forceDownload($zipName);
		
				
		@unlink($zipName);
		
		
		 foreach($galleryImagesDetails as $value){
		 
		 @unlink(WWW_ROOT.$filename.'/'.$value['GalleryImage']['image']);
		 
		 }
		
		rmdir(WWW_ROOT.$filename.'/');
		die;

	}
	

public function admin_requestForHighResolution($id){

		$this->GalleryImage->id = $id;
		if (!$this->GalleryImage->exists()) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		
		$galleryDeatils=$this->GalleryImage->find('first',array('fields'=>array('GalleryImage.id','GalleryImage.image','Gallery.id','Gallery.title','Gallery.job_id'),'conditions'=>array('GalleryImage.id'=>$id)));
		
		$this->loadModel('Job');
		
		$photographerUser=$this->Job->find('first',array('fields'=>array('Photographer.id'),'conditions'=>array('Job.id'=>$galleryDeatils['Gallery']['job_id'])));
		
		$this->loadModel('Photographer');
		
		$photographerDetails=$this->Photographer->find('first',array('fields'=>array('Photographer.id','Photographer.name','User.email'),'conditions'=>array('Photographer.id'=>$photographerUser['Photographer']['id'])));
		
		$this->loadModel('HighResolutionRequest');
		
		$highResolutionRequestsArr=array();
		
		$highResolutionRequestsArr['HighResolutionRequest']['photographer_id']=$photographerDetails['Photographer']['id'];
		
		$highResolutionRequestsArr['HighResolutionRequest']['gallery_image_id']=$galleryDeatils['GalleryImage']['id'];
		
		/*Saving all requests for high resolutions....................*/
		$this->HighResolutionRequest->create();
		
		if($this->HighResolutionRequest->save($highResolutionRequestsArr,false)){
		
		$filename  = $galleryDeatils['GalleryImage']['image'];
		
		$subject	=   'Photography:Request For High Resolution';
		
		$message	=   '<table width="50%">';			
		
		$message	.=   "<tr><td colspan='2'>Hi ".$photographerDetails['Photographer']['name'].",</td></tr>";
		
		$message	.=   "<tr><td colspan='2'>Ben Jennings has requested you supply the following image as a high resolution original copy</td></tr>";
		
		
		$message	.=  "<tr><td colspan='2'>Please send this image to ben@licklist.co.uk.</td></tr>";
		
		$message	.=  "<tr><td colspan='2'><img src='".Router::url('/', true).'uploads/gallery/'.$filename."' alt='".Router::url('/', true).'uploads/gallery/'.$filename."'/></td></tr>";
		
		$message	.=  "<tr><td colspan='2'>".$filename."</td></tr>";
		
		$message	.=  "<tr><td colspan='2'>Kind regards, Licklist.</td></tr>";
		
		$message	.=   '</table>';
		
		//echo $message;die;				
		//echo WWW_ROOT."img/" .$filename;die;
				
		$this->_mail($photographerDetails['User']['email'],$subject,$message);
		
		$this->Session->setFlash(__('Request has been send'),'flash_custom_success');
				
		$this->redirect(array('admin'=>true,'controller'=>'galleries','action' => 'index',$galleryDeatils['Gallery']['job_id']));
		}else{
		
		$this->Session->setFlash(__('Error while saving request'),'flash_custom_error');
				
		$this->redirect(array('admin'=>true,'controller'=>'galleries','action' => 'index',$galleryDeatils['Gallery']['job_id']));
		
		}
		
		
		
		
		
}


public function admin_allHighResolutionRequest(){
	
	
	$this->loadModel('HighResolutionRequest');
	
	
	$this->paginate = array(
    'joins' => array(
        array(
            'table' => 'gallery_images',
            'alias' => 'GalleryImage',
            'type' => 'INNER',
            'conditions' => array(
                'GalleryImage.id = HighResolutionRequest.gallery_image_id'
            )
        )
    ),
    'conditions' => array(
        'HighResolutionRequest.photographer_id' => $this->Session->read('Auth.User.photographer_id'),
		'HighResolutionRequest.status' => 'pending'
    ),
    'fields' => array('HighResolutionRequest.*', 'GalleryImage.image','GalleryImage.id'),
	'order' => 'HighResolutionRequest.id ASC',
	'limit' => 10
	);
	
	
	$requestDetails = $this->paginate('HighResolutionRequest');
	
	$this->set(compact('requestDetails'));

}

function admin_uploadHighResolutionImage($id){
		
		$this->loadModel('HighResolutionRequest');
		
		$this->HighResolutionRequest->id = $id;
		
		if (!$this->HighResolutionRequest->exists()) {
			throw new NotFoundException(__('Invalid High Resolution Request'));
		}
		
		$requestArr=$this->HighResolutionRequest->find('first',array('conditions'=>array('HighResolutionRequest.id'=>$id)));
		
		$this->GalleryImage->recursive=0;
		
		$imageArr=$this->GalleryImage->find('first',array(
														'fields'=>array(
																	'GalleryImage.image',
																	'Gallery.id',
																	'Gallery.job_id'
																	),
														'conditions'=>array(
																			'GalleryImage.id'=>$requestArr['HighResolutionRequest']['gallery_image_id']
																			)
														));
		
		if (!empty($this->data)) {
			
		//pr($this->data);die;
				if($this->data['Gallery']['filename']['name']!=''){
			
						$waterVenue=$this->Job->find('first',array(
																  'fields'=>array(
																  				'Venue.user_id',
																				'Venue.watermark_image_type'
																				),
																  'conditions'=>array(
																  				'Job.id'=>$imageArr['Gallery']['job_id']
																				)
																));
						
						$gallery_id=$imageArr['Gallery']['id'];
						$user_image=$this->data['Gallery']['filename']['name'];
						$filename	=	strtolower(substr($user_image,0, (strpos($user_image,'.')-1) )).md5(time());
						$ext 		=	strtolower(substr($user_image, (strpos($user_image,'.')+1) ));
						$filename	=	str_replace(' ','_',$filename).'.'.$ext;	
						$uploaddir = WWW_ROOT.'uploads/gallery/'; 
				
								
						if(move_uploaded_file($this->data['Gallery']['filename']['tmp_name'],$uploaddir.$filename)){				
						
						if($waterVenue['Venue']['watermark_image_type']=='normal'):
					
						$venueWaterMarkImage=WWW_ROOT.'uploads/watermark-venue/120x120/venue_user_'.$waterVenue['Venue']['user_id'].'.png';
					
						else:
						/*Dynamically creating venue watermark image*/
						list($gallery_width, $gallery_height, $gallery_type) = getimagesize($uploaddir.$filename);
						list($water_width, $water_height, $water_type) = getimagesize(WWW_ROOT.'uploads/watermark-venue/venue_user_'.$waterVenue['Venue']['user_id'].'.png');
						$wmTarget1=WWW_ROOT.'/uploads/watermark-venue/temp/venue_user_'.$waterVenue['Venue']['user_id'].'.png';
						$this->Image->resize_png_image(WWW_ROOT.'uploads/watermark-venue/venue_user_'.$waterVenue['Venue']['user_id'].'.png',$gallery_width,$water_height,$wmTarget1);						                    
						$venueWaterMarkImage=WWW_ROOT.'uploads/watermark-venue/temp/venue_user_'.$waterVenue['Venue']['user_id'].'.png';
					
						endif;
																
										
						$result = $this->Image->create_watermark($uploaddir.$filename,$venueWaterMarkImage,'',$waterVenue['Venue']['watermark_image_type']);
						$result = $this->Image->create_watermark($uploaddir.$filename,WWW_ROOT.'uploads/watermark-admin/150x150/admin_watermark.png','admin',$waterVenue['Venue']['watermark_image_type']);
										
							if ($result === false) {
							
								return false;
							
							} else {

								$this->GalleryImage->updateAll(array('GalleryImage.image'=>"'$filename'"), array('GalleryImage.id'=>$requestArr['HighResolutionRequest']['gallery_image_id']));
								
								$this->Gallery->updateAll(array('Gallery.is_publish'=>"'no'"), array('Gallery.id'=>$imageArr['Gallery']['id']));
								
								$this->HighResolutionRequest->updateAll(array('HighResolutionRequest.status'=>"'complete'"), array('HighResolutionRequest.id'=>$id));
								
							
							}
						}
						
						@unlink($uploaddir.$imageArr['GalleryImage']['image']);
						$this->Session->setFlash(__('High Resolution Image has been saved'),'flash_custom_success');
						$url=Router::url('/', true)."admin/galleries/index/".$imageArr['Gallery']['job_id'];
						echo '<script>window.location.href="'.$url.'"</script>';	
								
						
						}else{
					
						$this->Session->setFlash(__('Please upload image'),'flash_custom_error');
						
						}
					
		
				
				
		}

		
		$this->set(compact('imageArr'));
		
}

function admin_testPublishGallery(){

 		$this->Gallery->recursive=-1;
		//,'DATEDIFF(NOW(),created) >'=>1
		//$galleryArr=$this->Gallery->find('all',array('conditions'=>array('is_publish'=>'no')));
		$galleryArr=$this->Gallery->find('all');
		
		
	
		
		$galleryPublishArr=array();
		foreach($galleryArr as $gallery):
		
			$galleryImagesArr=$this->GalleryImage->find('all',array('conditions'=>array('gallery_id'=>$gallery['Gallery']['id'])));
		
			if(!empty($galleryImagesArr)):			
			$im=0;	
			foreach($galleryImagesArr as $images):
			
			$imagePath=Router::url('/', true).'uploads/gallery/'.$images['GalleryImage']['image'];			
			$galleryPublishArr['uploads'][$im++]="$imagePath";
			
			endforeach;
			
			endif;	
		
		
			if($gallery['Gallery']['licklist_gallery_id'] == 0):
			
			$jobArr=$this->Job->find('first',array('fields'=>array('Venue.licklist_venue_id,Venue.name'),'conditions'=>array('Job.id'=>$gallery['Gallery']['job_id'])));	
			$galleryPublishArr['venue_id']=	$jobArr['Venue']['licklist_venue_id'];					
			$galleryPublishArr['name']=	$gallery['Gallery']['title'];						
			$galleryPublishArr['date']=	date('Y-m-d',strtotime($gallery['Gallery']['created']));	
			
			else:
			$galleryPublishArr['id']=	$gallery['Gallery']['licklist_gallery_id'];					
			$galleryPublishArr['name']=	$gallery['Gallery']['title'];						
			$galleryPublishArr['date']=	date('Y-m-d',strtotime($gallery['Gallery']['created']));	
			endif;
			
			echo '<pre>';print_r($galleryPublishArr);
			$postdata = http_build_query($galleryPublishArr);

			$opts = array('http' =>
				array(
					'method'  => 'POST',
					'header'  => 'Content-type: application/x-www-form-urlencoded',
					'content' => $postdata
				)
			);
		
			$context  = stream_context_create($opts);
			//$returndata = file_get_contents('http://alpha.licklist.co.uk/api/photography/post?uid=12345', false, $context);
			$returndata = file_get_contents(Configure::read('AppGalleryUrl'), false, $context);
			$resultArr=json_decode($returndata);
			
			
			if($resultArr->success):
			
			$this->Gallery->updateAll(array('Gallery.is_publish'=>"'yes'",'Gallery.licklist_gallery_id'=>$resultArr->gallery_id), array('Gallery.id'=>$gallery['Gallery']['id']));
			
			endif;
		
		endforeach;
		exit;
		//$this->Session->setFlash(__('Gallery has been published'),'flash_custom_success');					
		
		//$this->redirect(array('admin'=>true,'controller'=>'dashboards','action' => 'index'));

}

function admin_testUploader($job_id){
		
		$this->Job->id = $job_id;
		
		if (!$this->Job->exists()) {
		
			throw new NotFoundException(__('Invalid job'));
		
		}
		
		$jobDetails=$this->Job->find('first',array('fields'=>array('Job.venue_contact_person'),'conditions'=>array('Job.id'=>$job_id)));
		
		$this->set(compact('job_id','jobDetails'));
}

/*
This is function for upload multiple image
*/
function upload_multiple($job_id){
		
		/*fetch gellery details and set if $this->data is not empty.......................................................................*/
		$galleryDetails=$this->Gallery->findAllByJobId($job_id,array('Gallery.id'));
		
		$jobDetails=$this->Job->find('first',array('fields'=>array('Job.venue_contact_person'),'conditions'=>array('Job.id'=>$job_id)));
		
		$waterVenue=$this->Job->find('first',array('fields'=>array('Venue.user_id','Venue.watermark_image_type'),'conditions'=>array('Job.id'=>$job_id)));
		
		if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
						
						
						$user_image=strip_tags($_FILES['upload_file']['name']);
						
						$filename	=	strtolower(substr($user_image,0, (strpos($user_image,'.')-1) )).md5(time());
						
						$ext 		=	strtolower(substr($user_image, (strpos($user_image,'.')+1) ));
						
						$filename	=	str_replace(' ','_',$filename).'.'.$ext;
						
						$vpb_file_id = strip_tags($_POST['upload_file_ids']); // File id is gotten from the file name
						
						$vpb_file_size = $_FILES['upload_file']['size'];	
						
						//$vpb_file_id = strip_tags($filename); // File id is gotten from the file name	
						
						$uploaddir = WWW_ROOT.'uploads/gallery/'; 
					
					//Without Validation and does not save filenames in the database		
					if(move_uploaded_file($_FILES['upload_file']['tmp_name'],$uploaddir.$filename)){
						
						if($waterVenue['Venue']['watermark_image_type']=='normal'):
				
						$venueWaterMarkImage=WWW_ROOT.'uploads/watermark-venue/120x120/venue_user_'.$waterVenue['Venue']['user_id'].'.png';
				
						else:
					
						/*Dynamically creating venue watermark image*/
						list($gallery_width, $gallery_height, $gallery_type) = getimagesize($uploaddir.$filename);
						list($water_width, $water_height, $water_type) = getimagesize(WWW_ROOT.'uploads/watermark-venue/venue_user_'.$waterVenue['Venue']['user_id'].'.png');
						$wmTarget1=WWW_ROOT.'/uploads/watermark-venue/temp/venue_user_'.$waterVenue['Venue']['user_id'].'.png';
						$this->Image->resize_png_image(WWW_ROOT.'uploads/watermark-venue/venue_user_'.$waterVenue['Venue']['user_id'].'.png',$gallery_width,$water_height,$wmTarget1);						                    
						$venueWaterMarkImage=WWW_ROOT.'uploads/watermark-venue/temp/venue_user_'.$waterVenue['Venue']['user_id'].'.png';
				
						endif;
															
									
						$result = $this->Image->create_watermark($uploaddir.$filename,$venueWaterMarkImage,'',$waterVenue['Venue']['watermark_image_type']);
										
										
						$result = $this->Image->create_watermark($uploaddir.$filename,WWW_ROOT.'uploads/watermark-admin/150x150/admin_watermark.png','admin',$waterVenue['Venue']['watermark_image_type']);
									
									
									
						if ($result === false) {
							return false;
						} else {
						
							if(!empty($galleryDetails)){
								
								$title=$jobDetails['Job']['venue_contact_person'].'- Licklist '.date('d/m/y');
								
								$this->Gallery->updateAll(array('Gallery.title'=>"'$title'"), array('Gallery.id'=>$galleryDetails[0]['Gallery']['id']));
								
								$galleryImagesArr['GalleryImage']['gallery_id']=$galleryDetails[0]['Gallery']['id'];
								
								$galleryImagesArr['GalleryImage']['image']=$filename;
								
								$this->GalleryImage->create();
							
								$this->GalleryImage->save($galleryImagesArr,false);
								
							}else{
								
								$galleryArr['Gallery']['job_id']=$job_id;
								
								$this->Gallery->create();
							
								$this->Gallery->save($galleryArr,false);
								
								$galleryImagesArr['GalleryImage']['gallery_id']= $this->Gallery->id;
								
								$galleryImagesArr['GalleryImage']['title']= $jobDetails['Job']['venue_contact_person'].'- Licklist '.date('d/m/y');
								
								$galleryImagesArr['GalleryImage']['image']=$filename;
								
								$this->GalleryImage->create();
							
								$this->GalleryImage->save($galleryImagesArr,false);
							
							}
							
							
						}
									
									
									
							//Display the file id
							echo $vpb_file_id;
						
						}
						else
						{
							//Display general system error
							echo 'general_system_error';
						}
						
						
		}
	$this->autoRender = false ;	

}


}
