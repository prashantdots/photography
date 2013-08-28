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
class SettingsController extends AppController {


 public $components = array('Image');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		
		$this->Setting->recursive = 0;

		$this->set('settings', $this->paginate('Setting'));
	}



/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

public function admin_edit($id = null) {

		$this->Setting->id = $id;
		if (!$this->Setting->exists()) {
			throw new NotFoundException(__('Invalid job'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$isNewImage=false;
			
			//check if image is not uploaded ........................................
			if($this->request->data['Setting']['watermark_image']['name']==''){
			
			$this->request->data['Setting']['watermark_image']['name']='admin_watermark.png';
			
			$this->request->data['Setting']['watermark_image']['type']='image/png';
			
			
			}else{
			
			$isNewImage=true;	
			
			
			}
			//pr($this->request->data);die;
			$this->Setting->set($this->data);
			
			if ($this->Setting->AddSettingValidate()) {
				
				
				if($isNewImage){
						
									@unlink(WWW_ROOT."/uploads/watermark-admin/admin_watermark.png");
									
									@unlink(WWW_ROOT."/uploads/watermark-admin/60x60/admin_watermark.png");
									
									@unlink(WWW_ROOT."/uploads/watermark-admin/150x150/admin_watermark.png");
									
									$fileName = $this->data['Setting']['watermark_image']['name'];
					
									$tmpName  = $this->data['Setting']['watermark_image']['tmp_name'];
									
									$waterMarkInfo = getimagesize($tmpName);
									
									$waterMarkWidth = $waterMarkInfo[0];
									
									$waterMarkHeight = $waterMarkInfo[1];
									
									move_uploaded_file($tmpName, WWW_ROOT."/uploads/watermark-admin/admin_watermark.png");
				
									$wmTarget=WWW_ROOT.'/uploads/watermark-admin/admin_watermark.png';
				
									
									$wmTarget1=WWW_ROOT.'/uploads/watermark-admin/60x60/admin_watermark.png';
				
									$this->Image->resize_png_image(WWW_ROOT."/uploads/watermark-admin/admin_watermark.png",60,60,$wmTarget1);				
				
									$wmTarget2=WWW_ROOT.'/uploads/watermark-admin/150x150/admin_watermark.png';
				
									$this->Image->resize_png_image(WWW_ROOT."/uploads/watermark-admin/admin_watermark.png",150,150,$wmTarget2);
									
						
				}
				
				
				if ($this->Setting->save($this->request->data,false)) {
									
					$this->Session->setFlash(__('The Setting has been saved'),'flash_custom_success');
				
					$this->redirect(array('action' => 'index'));
			
				}else {
			
					$this->Session->setFlash(__('The Setting could not be saved. Please, try again.'),'flash_custom_error');
					$this->redirect(array('action' => 'index'));
			
				}
				
			}
		} else {
			
			$this->request->data = $this->Setting->read(null, $id);
			
			
		}

	}
	
	
}
