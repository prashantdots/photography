<script>
$(function() {
	$('#UserUsername').focus();
	$( "#dob_date" ).datepicker({
			dateFormat: 'yy/mm/dd',
			yearRange: '1920:c',
			changeMonth: true,
        	changeYear: true,
			showOn: "button",
			buttonImage: "<?php echo $this->webroot;?>img/calendar.png",
			buttonImageOnly: true
	});
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
<?php 
$title = array(
				''=>'-Select Title-',
				'Mr'	=>'Mr',
				'Mrs'	=>'Mrs',
				'Ms'	=>'Ms',
				'Miss'	=>'Miss',
				'Smt'	=>'Smt'
				);
$days = array(
				''=>'-Select Day-',
				'Sun' =>'Sun',
				'Mon' =>'Mon',
				'Tue' =>'Tue',
				'Wed' =>'Web',
				'Thu' =>'Thu',
				'Fri' =>'Fri',
				'Sat' =>'Sat'
				);	
$exp = array(
				''=>'-Select Exp-',
				'Beginner' =>'Beginner',
				'Intermediate' =>'Intermediate',
				'Advanced' =>'Advanced',
				'Professional' =>'Professional'
				);
					
$options = array('Y' => 'Yes', 'N' => 'No');
//$foo ='Y';
$attributes = array('legend' => false);											

?>

<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		if($this->Session->read('Auth.User.role')=='admin'){
		$this->Html->addCrumb('Photographer', array('admin'=>true,'controller'=>'photographers','action'=>'index'));
		}
		$this->Html->addCrumb('Edit Photographer');
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
          <h2>Edit Photographer</h2>
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
              <label>Title <span>(Required Field)</span></label>
              <?php echo $this->Form->input('title', array('type'=>'select','options'=>$title,'class'=>'phoselect','label' => false,'div'=>false));?> </li>
            <li>
              <label>FName <span>(Required Field)</span></label>
              <?php echo $this->Form->input('fname', array('label' => false,'div'=>false));?> </li>
            <li>
              <label>LName <span>(Required Field)</span></label>
              <?php echo $this->Form->input('lname', array('label' => false,'div'=>false));?> </li>
			  <li>
              <label>Age / DOB <span>(Required Field)</span></label>
              <?php echo $this->Form->input('dob_date', array('type'=>'text','id'=>'dob_date','label' => false,'div'=>false,'readomly'=>'readomly'));?> </li>
			 
			  <li>
              <label>Imgae <span>(Required Field)</span></label>
              <?php echo $this->Form->input('image', array('type'=>'file','label' => false,'div'=>false));?>
			
			 <?php	if($this->data['User']['old_image']!='' && file_exists(WWW_ROOT.'uploads/photographer/'.$this->data['User']['old_image']) ){	
					
					echo $this->Html->image('../uploads/photographer/'.$this->data['User']['old_image'], array('alt' => 'No Image','width' => 50,'height' => 30));
					
					}else{
					
					echo $this->Html->image('no-picture-icon.png', array('alt' => 'No Image','width' => 50,'height' => 30));
					
					}
			?>
			   </li>
			   
            <li>
              <label>Mobile<span>(Required Field)</span></label>
              <?php echo $this->Form->input('mobile', array('label' => false,'div'=>false,'maxlength'=>12,'onkeypress'=>'return validate(event)'));?> </li>
		
            <li>
              <label>Address1<span>(Required Field)</span></label>
              <?php echo $this->Form->input('address1', array('label' => false,'div'=>false));?> </li>
            <li>
              <label>Address2</label>
              <?php echo $this->Form->input('address2', array('label' => false,'div'=>false));?> </li>
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
              <label>Website<span></span></label>
              <?php echo $this->Form->input('website', array('label' => false,'div'=>false));?> </li>
			  <li>
              <label>Own Vehicle Y/N<span></span></label>
<?php echo $this->Form->radio('vehicle', $options, $attributes,array('label' => false,'div'=>false));?> </li>
			   <li>
              <label>Distance Will Travel	<span>(Required Field)</span></label>
              <?php echo $this->Form->input('distance', array('label' => false,'div'=>false));?> </li>
			   <li>
              <label>Photographic Experience <span>(Required Field)</span></label>
              <?php echo $this->Form->input('experience', array('type'=>'select','options'=>$exp,'class'=>'phoselect','label' => false,'div'=>false));?> </li>
			   <li>
              <label>Postproduction Experience <span>(Required Field)</span></label>
              <?php echo $this->Form->input('post_experience', array('type'=>'select','options'=>$exp,'class'=>'phoselect','label' => false,'div'=>false));?> </li>
			  
			   <li>  <label>Skill Score <span>(Required Field)</span></label>
              <?php echo $this->Form->input('skill_score', array('label' => false,'div'=>false));?></li>
			  <li>
               <label>Preferred Working Days</label>
			    <div class="weekdays">
              <label><?php echo $this->Form->input('User.preferred_working_days.0', array('type'=>'checkbox','value'=>'Mon','div' => false,'label' => false,'hiddenField' => false));?>&nbsp;&nbsp;Mon</label>
			  <label><?php echo $this->Form->input('User.preferred_working_days.1', array('type'=>'checkbox','value'=>'Tue','div' => false,'label' => false,'hiddenField' => false));?>&nbsp;&nbsp;Tue</label>
			  <label><?php echo $this->Form->input('User.preferred_working_days.2', array('type'=>'checkbox','value'=>'Wed','div' => false,'label' => false,'hiddenField' => false));?>&nbsp;&nbsp;Wed</label>
			  <label><?php echo $this->Form->input('User.preferred_working_days.3', array('type'=>'checkbox','value'=>'Thu','div' => false,'label' => false,'hiddenField' => false));?>&nbsp;&nbsp;Thu</label>
			  <label><?php echo $this->Form->input('User.preferred_working_days.4', array('type'=>'checkbox','value'=>'Fri','div' => false,'label' => false,'hiddenField' => false));?>&nbsp;&nbsp;Fri</label>
			  <label><?php echo $this->Form->input('User.preferred_working_days.5', array('type'=>'checkbox','value'=>'Sat','div' => false,'label' => false,'hiddenField' => false));?>&nbsp;&nbsp;Sat</label>
			  <label><?php echo $this->Form->input('User.preferred_working_days.6', array('type'=>'checkbox','value'=>'Sun','div' => false,'label' => false,'hiddenField' => false));?>&nbsp;&nbsp;Sun</label>
			  </div>
			   </li>
			  
			   <li><label>Notes</label>
              <?php echo $this->Form->input('note', array('type' => 'textarea','label' => false,'div'=>false));?></li> 
          </ul>
        </div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
          <?php 
		    echo $this->Form->hidden('old_image');
			echo $this->Form->hidden('id');
		    echo $this->Form->hidden('photographer_id');
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
