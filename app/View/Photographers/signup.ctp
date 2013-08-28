<script>
$(function() {
	$( "#dob_date" ).datepicker({			
			dateFormat: 'yy/mm/dd',
			yearRange: '1920:2001',
			changeMonth: true,
        	changeYear: true,		
			showOn: "button",
			buttonImage: "<?php echo $this->webroot;?>img/calendar.png",
			buttonImageOnly: true
	});
});
</script>
<?php 
$title = array(				
				'Mr'	=>'Mr',
				'Mrs'	=>'Mrs',
				'Ms'	=>'Ms',
				'Miss'	=>'Miss',
				'Smt'	=>'Smt'
				);
$days = array(				
				'Sun' =>'Sun',
				'Mon' =>'Mon',
				'Tue' =>'Tue',
				'Wed' =>'Web',
				'Thu' =>'Thu',
				'Fri' =>'Fri',
				'Sat' =>'Sat'
				);	
$exp = array(				
				'Beginner' =>'Beginner',
				'Intermediate' =>'Intermediate',
				'Advanced' =>'Advanced',
				'Professional' =>'Professional'
				);
					
$options = array('Y' => 'Yes', 'N' => 'No');
$foo ='Y';
$attributes = array('legend' => false,'value' => $foo);											

?>

<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		$this->Html->addCrumb('Photographer Signup');
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
          <h2>Add Photographer</h2>
        </div>
        <!-- End Box Head -->
        <?php echo $this->Form->create('User'); ?>
        <!-- Form -->
        <div class="form">
          <ul class="fields">		  	
            <li>
              <label>Username <span>(Required Field)</span></label>
              <?php echo $this->Form->input('username', array('label' => false,'div'=>false,'li'=>false));?> </li>
           
            <li>
              <label>Email <span>(Required Field)</span></label>
              <?php echo $this->Form->input('email', array('label' => false,'div'=>false));?> </li>
            
            <li>
              <label>Password <span>(Required Field)</span></label>
              <?php echo $this->Form->input('password', array('label' => false,'div'=>false));?> </li>
            <li>
              <label>Confirm Password <span>(Required Field)</span></label>
              <?php echo $this->Form->input('cnfrm_password', array('type'=>'password','label' => false,'div'=>false));?> </li>
			  <li>
              <label>Title <span>(Required Field)</span></label>
              <?php echo $this->Form->input('title', array('type'=>'select','options'=>$title,'empty'=>'-Select Title-','label' => false,'div'=>false));?> </li>
            <li>            
              <label>FName <span>(Required Field)</span></label>
              <?php echo $this->Form->input('fname', array('label' => false,'div'=>false));?> </li>
            <li>
              <label>LName <span>(Required Field)</span></label>
              <?php echo $this->Form->input('lname', array('label' => false,'div'=>false));?> </li>
           
			<li>
              <label>Age / DoB <span>(Required Field)</span></label>
              <?php echo $this->Form->input('dob_date', array('type'=>'text','id'=>'dob_date','label' => false,'div'=>false));?> </li>
            <li>
              <label>Mobile<span>(Required Field)</span></label>
              <?php echo $this->Form->input('mobile', array('label' => false,'div'=>false,'maxlength'=>12));?> </li>
            <li>
              <label>Address1<span>(Required Field)</span></label>
              <?php echo $this->Form->input('address1', array('label' => false,'div'=>false));?> </li>
            <li>
              <label>Address2<span>(Required Field)</span></label>
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
              <?php echo $this->Form->input('experience', array('type'=>'select','options'=>$exp,'empty'=>'-Select Experience-','label' => false,'div'=>false));?> </li>
			   <li>
              <label>Postproduction Experience <span>(Required Field)</span></label>
              <?php echo $this->Form->input('post_experience', array('type'=>'select','options'=>$exp,'empty'=>'-Select Experience-','label' => false,'div'=>false));?> </li>
			  <li><label>Skill Score <span>(Required Field)</span></label>
              <?php echo $this->Form->input('skill_score', array('label' => false,'div'=>false));?></li>
			 
              <li>
               <label>Preferred Working Days</label>
			 <div class="weekdays">
              <label><?php echo $this->Form->checkbox('preferred_working_days.', array('value'=>'mon','hiddenField' => false));?>&nbsp;&nbsp;Mon</label>
			  <label><?php echo $this->Form->checkbox('preferred_working_days.', array('value'=>'Tue','hiddenField' => false));?>&nbsp;&nbsp;Tue</label>
			  <label><?php echo $this->Form->checkbox('preferred_working_days.', array('value'=>'wed','hiddenField' => false));?>&nbsp;&nbsp;Wed</label>
			  <label><?php echo $this->Form->checkbox('preferred_working_days.', array('value'=>'thu','hiddenField' => false));?>&nbsp;&nbsp;Thu</label>
			  <label><?php echo $this->Form->checkbox('preferred_working_days.', array('value'=>'fri','hiddenField' => false));?>&nbsp;&nbsp;Fri</label>
			  <label><?php echo $this->Form->checkbox('preferred_working_days.', array('value'=>'sat','hiddenField' => false));?>&nbsp;&nbsp;Sat</label>
			  <label><?php echo $this->Form->checkbox('preferred_working_days.', array('value'=>'sun','hiddenField' => false));?>&nbsp;&nbsp;Sun</label>
			  </div>
			   </li>
                
          </ul>
        </div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
          <?php 
		 
					$options = array(
								'label' => 'Submit',
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
