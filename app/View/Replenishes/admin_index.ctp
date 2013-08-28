<script>
$(function(){
$('#JobCard').focus();
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
		$this->Html->addCrumb('Resources');
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
          <h2>Resources</h2>
        </div>
        <!-- End Box Head -->
        <?php echo $this->Form->create('Job'); ?>
        <!-- Form -->
        <div style="margin:10px 10px 10px 10px;font-size:16px;font-weight:bold;">Replenish Card</div>
		<div class="form">
          <ul class="fields">
			<li style="height:60px;">
              <label>Card Number <span>(Required Field)</span></label>
             <?php  echo $this->Form->input('card', array('label' => false,'div'=>false,'onkeypress'=>'return validate(event)','maxlength'=>3));?>
			 <label><span>(numeric value)</span></label>
			 </li>
			 
			  <li>&nbsp; </li>
          </ul>
        </div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
          <?php 
		 
					$options = array(
								'label' => 'Send',
								'class' => 'button',
								'div'=>false,
							);
							echo $this->Form->end($options);?>
        </div>
        <!-- End Form Buttons -->
		
		
		<?php echo $this->Form->create('Replenish',array('action'=>'sendUniformRequest')); ?>
        <!-- Form -->
		 <div style="margin:10px 10px 10px 10px;font-size:16px;font-weight:bold;">Request New Uniform</div>
        <div class="form">
          <ul class="fields">
            <li style="height:60px;">
              <label>Select Size <span>(Required Field)</span></label>
              <?php 
			  $selectSizeArr=array();
			  $selectSizeArr['Small']='S';
			  $selectSizeArr['Medium']='M';
			  $selectSizeArr['Large']='L';
			  $selectSizeArr['Extra Large']='XL';
			  
			  echo $this->Form->input('size', array('type'=>'select','options'=>$selectSizeArr,'label' => false,'div'=>false));?>
			  </li>
			 
			  <li>&nbsp; </li>
          </ul>
        </div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
          <?php 
		 
					$options = array(
								'label' => 'Send',
								'class' => 'button',
								'div'=>false,
							);
							echo $this->Form->end($options);?>
        </div>
        <!-- End Form Buttons -->
		
		<?php echo $this->Form->create('Replenish',array('action'=>'sendMakeSuggestionRequest')); ?>
        <!-- Form -->
		 <div style="margin:10px 10px 10px 10px;font-size:16px;font-weight:bold;">Make a suggestion</div>
        <div class="form">
          <ul class="fields">
            <li style="height:60px;">
              <label>Suggestion<span>(Required Field)</span></label>
              <?php 
			  echo $this->Form->input('suggestion', array('type'=>'textarea','label' => false,'div'=>false));?>
			  </li>
			 
			  <li>&nbsp; </li>
			  <li>&nbsp; </li>
			  <li>&nbsp; </li>
          </ul>
        </div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
          <?php 
		 
					$options = array(
								'label' => 'Send',
								'class' => 'button',
								'div'=>false,
							);
							echo $this->Form->end($options);?>
        </div>
        <!-- End Form Buttons -->
		
		
		<?php echo $this->Form->create('Replenish',array('action'=>'sendNewIDCardRequest')); ?>
        <!-- Form -->
		 <div style="margin:10px 10px 10px 10px;font-size:16px;font-weight:bold;">Request New ID Card</div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
          <?php 
		 
					$options = array(
								'label' => 'Send',
								'class' => 'button',
								'div'=>false,
							);
							echo $this->Form->end($options);?>
        </div>
        <!-- End Form Buttons -->
		
		
		<?php echo $this->Form->create('Replenish',array('action'=>'requestFeedbackLatShoot')); ?>
        <!-- Form -->
		 <div style="margin:10px 10px 10px 10px;font-size:16px;font-weight:bold;">Request feedback on last shoot</div>
        <!-- End Form -->
		
        <!-- Form Buttons -->
        <div class="buttons">
          <?php 
		 
					$options = array(
								'label' => 'Send',
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
