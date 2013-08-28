<script>
$(function(){
$('#UserUsername').focus();
});
//Function to allow only numbers to textbox
function validate(key){
	
	//getting key code of pressed key
	var keycode = (key.which) ? key.which : key.keyCode;
	
	var phn = document.getElementById('txtPhn');
	//comparing pressed keycodes
	
	if (!(keycode==8 || keycode==46)&&(keycode < 48 || keycode > 57)){
	return false;
	}
	else{
	//Condition to check textbox contains ten numbers or not
	if (phn.value.length <10){
	return true;
	}
	else{
	return false;
	}
	}
}
</script>
<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		if($this->Session->read('Auth.User.role')=='admin'){
		$this->Html->addCrumb('Venues', array('admin'=>true,'controller'=>'venues','action'=>'index'));
		}
		$this->Html->addCrumb('Edit Venue');
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
          <h2>Edit Venue</h2>
        </div>
        <!-- End Box Head -->
        <?php echo $this->Form->create('User',array('type'=>'file')); ?>
        <!-- Form -->
        <div class="form">
          <ul class="fields">
            <li>
              <label>Username <span>(Required Field)</span></label>
              <?php echo $this->Form->input('username', array('label' => false,'div'=>false));?> </li>
           
            <li>
              <label>Email <span>(Required Field)</span></label>
              <?php echo $this->Form->input('email', array('label' => false,'div'=>false));?> </li>
            
            <li>
              <label>Name <span>(Required Field)</span></label>
              <?php echo $this->Form->input('name', array('label' => false,'div'=>false));?> </li>
           <li>
              <label>Mobile<span>(Required Field)</span></label>
              <?php echo $this->Form->input('mobile', array('label' => false,'div'=>false,'maxlength'=>12,'onkeypress'=>'return validate(event)'));?> </li>
            <li>
              <label>Address<span>(Required Field)</span></label>
              <?php echo $this->Form->input('address', array('label' => false,'div'=>false));?> </li>
            <li>
              <label>Town<span>(Required Field)</span></label>
              <?php echo $this->Form->input('town', array('label' => false,'div'=>false));?> </li>
            <li>
              <label>County<span>(Required Field)</span></label>
              <?php echo $this->Form->input('county', array('label' => false,'div'=>false));?> </li>
            <li>
              <label>Postcode<span>(Required Field)</span></label>
              <?php echo $this->Form->input('postcode', array('label' => false,'div'=>false));?> </li>
			 
			  <li>
			  <label>Watermark Image</label>
		    <?php echo $this->Form->radio('watermark_image_type', array('normal' => 'Normal', 'banner' => 'Banner'), array('legend' => false),array('label' => false,'div'=>false));?>
			  </li> 
			 <li>
              <label>Watermark Image<span>(Required Field)</span></label>
              <?php echo $this->Form->input('watermark_image', array('type'=>'file','label' => false,'div'=>false));?><br/>
			  <img src="<?php echo $this->webroot.'uploads/watermark-venue/120x120/venue_user_'.$this->data['User']['id'].'.png';?>" height="50" width="50" class="gallery_image" /> 			   </li>   
			  
			  
          </ul>
        </div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
          <?php 
			echo $this->Form->hidden('id');
		    echo $this->Form->hidden('venue_id');
					$options = array(
								'label' => 'Update',
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
