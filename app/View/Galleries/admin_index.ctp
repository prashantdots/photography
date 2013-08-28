<?php
echo $this->Html->css('shadowbox/shadowbox');
		
echo $this->Html->script(array('shadowbox/shadowbox'));
?>	

<script type="text/javascript">

		window.onload = function(){		
			Shadowbox.init({
			skipSetup: true
			});
		};

	$(function(){
	$('.gallery_image').click(function(){
		 var imageSrc=$(this).attr('src');
		 	Shadowbox.open({
				content:   imageSrc,
				player:     "img"
			});
		});
	
	
		
	});

</script>	
<style type="text/css">
   * {
    margin:0;
    padding:0;
   }
   #test {
    text-align:left;
   }  
   #test div {
    display:inline-block;
    text-align:left;
	padding-top:50px;
   }
  </style>
<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav">
		<?php
		if($this->Session->read('Auth.User.role')=='admin'){
		$this->Html->addCrumb('Jobs', array('admin'=>true,'controller'=>'jobs','action'=>'index'));
		}
		$this->Html->addCrumb('Gallery');
		echo $this->Html->getCrumbs(' > ','Dashboard');?>
		</div>
		<!-- End Small Nav -->
		
		<?php echo $this->Session->flash(); ?>
		<br />
		<!-- Main -->
			
		<div id="main">
		<?php if($this->Session->read('Auth.User.role')=='photographer'){?>
		<a href="<?php echo Router::url('/', true).'admin/galleries/add/'.$job_id;?>" class="add-button" style="float:right;"><span>Add gallery images</span></a><br /><br /><br />
		<?php } ?>
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
			
				<!-- Box -->
				<div class="box full">
				
					<!-- Box Head -->
					
					<div class="box-head">
						<h2 class="left">Current Gallery</h2>
						
					</div>
			
					<!-- End Box Head -->	
					 <?php 	 if(!empty($galleryArr['Gallery'])):
					 if($this->Session->read('Auth.User.role')!='photographer'):
					 ?>
					<div style="float:right;padding-left:15px;">
					<?php 	
					//$imageUrl=$this->Html->image('publish.png', array('alt' => 'Publish Gallery'));			
					echo $this->Html->link('Publish', '/admin/galleries/publish/'.$galleryArr['Gallery']['id'],array('style' => 'text-decoration:none;font-size:13px;font-weight:bold;'));
					?>
					</div>
					
					
					<div style="float:right;padding-left:15px;">
					<?php 	
					//$imageUrl=$this->Html->image('download.png', array('alt' => 'Download Gallery'));			
					echo $this->Html->link('Download Gallery', '/admin/galleries/createZip/'.$galleryArr['Gallery']['id'],array('style' => 'text-decoration:none;font-size:13px;font-weight:bold;'));
					?>
					</div>
					 <?php
					 endif;
					 
					 endif; 
					 
					 ?>	
					<!-- Table -->
					 <div class="form">
				
         			<ul class="list">
					<?php if(!empty($galleryArr['Gallery'])): ?>
                 	<li class=""><strong>Title:</strong><?php echo h($galleryArr['Gallery']['title']); ?></li>
				
					<li class=""><strong>Description:</strong><?php echo h($galleryArr['Gallery']['description']); ?></li>
					
				
					
					<?php else:?>
					
					<li class="gallery-data">No Data Available</li>
					
					<?php endif;?>
					</ul>	
					</div>	
					<div class="columns-3"><ul class="fields">
					<?php	
					if(!empty($galleryImagesArr)):	
					
						foreach($galleryImagesArr as $gallery_details):
					?>
					<li class="gallery-data">
					
					<img src="<?php echo $this->webroot.'uploads/gallery/'.$gallery_details['GalleryImage']['image'];?>"  class="gallery_image" style="width:300px; height:auto;cursor:pointer;"/>
					<br />
					<?php //echo 'Status:'.($gallery_details['GalleryImage']['is_active']=='created')?'Not Seen':$gallery_details['GalleryImage']['is_active']?>
					<?php if($this->Session->read('Auth.User.role')=='photographer'){?>
					 <div class="action-buttons">
					 <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $gallery_details['GalleryImage']['id']), array('class'=>'ico del'), __('Are you sure want to delete?', $gallery_details['GalleryImage']['id'])); ?> 
					 </div>
					<?php } if($this->Session->read('Auth.User.role')=='venue'){?>
					
				 <div class="action-buttons">
					<?php
					echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $gallery_details['GalleryImage']['id']), array('class'=>'ico del'), __('Are you sure want to delete?', $gallery_details['GalleryImage']['id']));
					
					
					/*echo $this->Form->postLink($this->Html->image('rejected.png', array('alt' => __('Effacer'))), 
					  array('action' => 'rejected', $gallery_details['GalleryImage']['id']), 
					  array('escape' => false), //le escape
					  __('Do you want to reject this image #%s?', $gallery_details['GalleryImage']['id']) 
					); 
					
					echo $this->Form->postLink($this->Html->image('approved.gif', array('alt' => __('Effacer'))), 
					  array('action' => 'publish', $gallery_details['GalleryImage']['id']), 
					  array('escape' => false), 
					  __('Do you want to publish #%s?', $gallery_details['GalleryImage']['id']) 
					);*/ 
					?>
					 </div>
					<?php } 
					if($this->Session->read('Auth.User.role')=='admin'){
					?>
					 <div class="action-buttons">
					<?php
				 echo $this->Html->link('High Resolution', array('admin'=>true,'controller'=>'galleries','action'=>'requestForHighResolution',$gallery_details['GalleryImage']['id']), array('class' => 'apply_button button','style'=>'text-decoration:none'));
					?>
					</div>
					<?php					
					} ?>
					</li>
				
					<?php 
					endforeach;
					endif;?>	
					</ul>	</div>
					</div>
					<!-- Table -->
					
				</div>
				<!-- End Box -->
				
		

			</div>
			<!-- End Content -->
			

			
			<div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
	</div>
