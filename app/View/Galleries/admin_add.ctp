<script>
	$(document).ready(function(){
		$('#GalleryAdminAddForm').submit(function(){
		    if (!$("#GalleryTermAndCondition").is(":checked")) {
					alert("please check term and condition");
					return false;
				}
				return true;
		});		
	
	});
</script>
<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		$this->Html->addCrumb('Gallery',array('admin'=>true,'controller'=>'galleries','action'=>'index',$job_id));
		$this->Html->addCrumb('Add Gallery');
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
            <li>
              <label>Title <span>(Required Field)</span></label>
              <?php echo $this->Form->input('title', array('label' => false,'div'=>false,'li'=>false,'value'=>$venue_contact_person.'- Licklist '.date('d/m/y')));?> </li>
           
            <li>
              <label>Description</label>
              <?php echo $this->Form->input('description', array('type'=>'textarea','label' => false,'div'=>false));?> </li>
			  
			  <li><label>Image<span>(Required Field Ctrl+select for multiple image)</span></label><?php echo $this->Form->input('filename.', array('type'=>'file','label' => false,'div'=>false,'li'=>false,'multiple'=>true));?> 
			  <?php
			  if($fileError!='')
			  echo '<div class="error-message">'.$fileError.'</div>';
			  ?>
			  </li>
			  <li>&nbsp;</li>
			  
			  <li> &nbsp;</li>
			  <li><label style="width:100%"> <?php echo $this->Form->checkbox('term_and_condition', array('hiddenField' => false));
			  echo $this->Html->link("By uploading I agree to Licklist's Terms and Conditions", 'javascript:void(0);', array('target' => '_blank','style'=>'text-decoration:none;'));
			  ?></label>
			 
			  </li>
			  <li> &nbsp;</li>
			 
			  
            
             
          </ul>
        </div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
          <?php 
		 
				echo $this->Form->hidden('id');
				
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