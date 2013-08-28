<?php
echo $this->Html->css('shadowbox/shadowbox');
		
echo $this->Html->script(array('shadowbox/shadowbox'));
?>
<script>
	$(document).ready(function(){
		$('#GalleryAdminAddForm').submit(function(){
		    if (!$("#GalleryTermAndCondition").is(":checked")) {
					alert("please check term and condition");
					return false;
				}
				return true;
		});	
		
		$('.gallery_image').click(function(){
		 var imageSrc=$(this).attr('src');
		 	Shadowbox.open({
				content:   imageSrc,
				player:     "img"
			});
		});	
	
	});
</script>
<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		$this->Html->addCrumb('High Resolution Requests',array('admin'=>true,'controller'=>'galleries','action'=>'allHighResolutionRequest'));
		$this->Html->addCrumb('Upload Image');
		echo $this->Html->getCrumbs('  > ','Dashboard');?>
  </div>
  <!-- End Small Nav -->
  <?php echo $this->Session->flash(); ?> <br />
  <!-- Main -->
  <div id="main">
    <div class="cl">&nbsp;</div>
    <!-- Content -->
    <div id="content">
      <!-- Box -->
      <div class="box full">
        <!-- Box Head -->
        <div class="box-head">
          <h2>Add Gallery</h2>
        </div>
        <!-- End Box Head -->
        <?php echo $this->Form->create('Gallery',array('type'=>'file')); ?>
        <!-- Form -->
        <div class="form">
          <ul class="fields">
            <li><label>Original Image</label>
			<img src="<?php echo $this->webroot.'uploads/gallery/'.$imageArr['GalleryImage']['image'];?>" class="gallery_image" style="width:300px; height:auto;cursor:pointer;"/>
			</li>
			  
			  <li><label>Image</label><?php echo $this->Form->input('filename', array('type'=>'file','label' => false,'div'=>false,'li'=>false));?> 
			  
			  </li>
			  <li>&nbsp;</li>
			  
			  <li> &nbsp;</li>
			 
			  <li> &nbsp;</li>
			 
			  
            
             
          </ul>
        </div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
          <?php 
				$options = array(
								'label' => 'Submit',
								'type' => 'Submit',
								'class' => 'button',
								'div'=>false,
				);
				
				echo $this->Form->end($options);?>
        </div>
        <!-- End Form Buttons -->
      </div>
      <!-- End Box -->
    </div>
    <!-- End Content -->
    <div class="cl">&nbsp;</div>
  </div>
  <!-- Main -->
</div>
<script type="text/javascript">
			s = '<?php echo $s; ?>';
</script>