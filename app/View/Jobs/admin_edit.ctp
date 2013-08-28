<script>
$(function() {
	$('#JobJobNo').focus();
	$( "#order_date,#shoot_date" ).datepicker({
			minDate: new Date(),
			showOn: "button",
			buttonImage: "<?php echo $this->webroot;?>img/calendar.png",
			buttonImageOnly: true
	});
	
	
	$('#JobVenueId').change(function(){
		 if($(this).val()==''){
		 $('#JobVenueContactPerson').val('');
		 $('#JobVenueMobile').val('');
		 $('#JobVenueAddress').val('');
		 $('#JobVenuePostcode').val('');
		 }else{
			 $.ajax({
				type: 'POST',
				cache: false,
				url: '<?php echo $this->Html->url(array('admin'=>false,'controller'=>'jobs','action'=>'ajaxVenueDetails'),true); ?>',
				data: 'id='+$(this).val(),
				dataType: 'json',
				success: function(data) {
					$('#JobVenueContactPerson').val(data.name);
					$('#JobVenueMobile').val(data.mobile);
					$('#JobVenueAddress').val(data.address);
					$('#JobVenuePostcode').val(data.postcode);
				}
			});
			return false;
		}
	});
	
	$('#JobPhotographerId').change(function(){
		 if($(this).val()==''){
		 $('#JobPhotographerName').val('');
		 $('#JobPhotographerMobile').val('');
		 $('#JobPhotographerWebsite').val('');
		 $('#JobPhotographerEmail').val('');
		 }else{
		
				 $.ajax({
					type: 'POST',
					cache: false,
					url: '<?php echo $this->Html->url(array('admin'=>false,'controller'=>'jobs','action'=>'ajaxPhotographyDetails'),true); ?>',
					data: 'id='+$(this).val(),
					dataType: 'json',
					success: function(data) {
						$('#JobPhotographerName').val(data.name);
						$('#JobPhotographerMobile').val(data.mobile);
						$('#JobPhotographerWebsite').val(data.website);
						$('#JobPhotographerEmail').val(data.email);
					}
				});
				return false;
	  }	
	});

	<!-- Calculating commission of licklist-->
	$('#JobAgreedPhotographerFee,#JobAgreedVenueFee').on('keyup blur change', function() {
   
   	if($('#JobAgreedPhotographerFee').val()!='' && $('#JobAgreedVenueFee').val()!=''){
			
			$('#JobLicklistCommission').val(parseFloat($('#JobAgreedVenueFee').val())-parseFloat($('#JobAgreedPhotographerFee').val()));
		
		}
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
<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		$this->Html->addCrumb('Jobs', array('admin'=>true,'controller'=>'jobs','action'=>'index'));
		$this->Html->addCrumb('Edit Job');
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
          <h2>Edit Job</h2>
        </div>
        <!-- End Box Head -->
        <?php echo $this->Form->create('Job'); ?>
        <!-- Form -->
        <div class="form">
          <ul class="fields">
            <li>
              <label>Job Number <span>(Required Field)</span></label>
              <?php echo $this->Form->input('job_no', array('label' => false,'div'=>false,'li'=>false));?> </li>
           
		    <li>
              <label>Order By <span>(Required Field)</span></label>
              <?php echo $this->Form->input('ordered_by', array('label' => false,'value'=>'Ben Jennings','div'=>false));?> </li>
			  
			 <li style="height:60px;">
              <label>Photographers net fee<span>(Required Field)</span></label>
             <?php echo $this->Form->input('agreed_photographer_fee', array('label' => false,'div'=>false));?> 
			 <label><span>(numeric value only)</span></label>
			  </li>
			  
			 <li style="height:60px;">
              <label>Shoot Gross Value<span>(Required Field)</span></label>
              <?php echo $this->Form->input('agreed_venue_fee', array('label' => false,'div'=>false));?> 
			 <label><span>(numeric value)</span></label>
			 </li> 
		   
            <li>
              <label>Order Date <span>(Required Field)</span></label>
              <?php echo $this->Form->input('order_date', array('type'=>'text','id'=>'order_date','label' => false,'div'=>false));?> </li>
			  
			 <li>
              <label>Shoot Date <span>(Required Field)</span></label>
              <?php echo $this->Form->input('shoot_date', array('type'=>'text','id'=>'shoot_date','label' => false,'div'=>false));?> </li>
			
			  <li style="height:60px;">
              <label>LL Commission deducted at source</label>
             <?php echo $this->Form->input('licklist_commission', array('label' => false,'div'=>false,'readonly'=>'readonly'));?> 
			 <label><span>(numeric value only)</span></label>
			  </li>
			  
			 <li style="height:60px;">&nbsp; </li> 
			 <li><h4 style="color:#E532A0;font-size:14px;">Venue Details</strong></h4></li>
			  <li>&nbsp;</li>
			 
			  <li>
              <label>Venue <span>(Required Field)</span></label>
              <?php echo $this->Form->input('venue_id', array('label' => false,'div'=>false,'empty'=>'-Select-'));?> </li>
			  
			   <li>
              <label>Venue Contact <span>(Required Field)</span></label>
              <?php echo $this->Form->input('venue_contact_person', array('label' => false,'div'=>false));?> </li>
			  
			   <li>
              <label>Mobile <span>(Required Field)</span></label>
              <?php echo $this->Form->input('venue_mobile', array('label' => false,'div'=>false,'maxlength'=>12,'onkeypress'=>'return validate(event)'));?> </li>
			  
			  
			   <li>
              <label>Postcode <span>(Required Field)</span></label>
              <?php echo $this->Form->input('venue_postcode', array('label' => false,'div'=>false));?> </li>
			  
			   <li>
              <label>Address <span>(Required Field)</span></label>
              <?php echo $this->Form->input('venue_address', array('type' => 'textarea','label' => false,'div'=>false));?> </li>
			   <li>&nbsp;</li>
			 
				<li>&nbsp;</li>
				
			 	
			   
			   
			   
			   <li><h4 style="color:#E532A0;font-size:14px;">Photographer Details</strong></h4></li>
			   <li>&nbsp;</li>

			  
			    <li>
              <label>Arrival_time <span>(Required Field)</span></label>
              <?php echo $this->Form->input('photographer_arrival_time', array('label' => false,'div'=>false));?> </li>
			  
			   <li>
              <label>Shoot Commences <span>(Required Field)</span></label>
              <?php echo $this->Form->input('shoot_commences', array('label' => false,'div'=>false));?> </li>
			  
			   <li>
              <label>Shoot Concludes <span>(Required Field)</span></label>
              <?php echo $this->Form->input('shoot_concludes', array('label' => false,'div'=>false));?> </li>
			  
			  
			   <li>
              <label>Dress Code <span>(Required Field)</span></label>
              <?php echo $this->Form->input('dress_code', array('label' => false,'div'=>false));?> </li>
			  
			    <li>
              <label>Image Upload Req By <span>(Required Field)</span></label>
              <?php echo $this->Form->input('image_upload_req_by', array('label' => false,'div'=>false));?> </li>
			   <li>
              <label>Cover Photographer<span>(Required Field)</span></label>
               <?php 
			  $photographersArr=array();
			  $photographersArr['None-Principle Photographer Will Attend']='None-Principle Photographer Will Attend';
			  foreach($photographers as $valuePhoto){
			  $photographersArr[$valuePhoto]=$valuePhoto;
			  }
			  echo $this->Form->input('cover_photographer', array('type'=>'select','options'=>$photographersArr,'label' => false,'div'=>false));?> </li>
			  
			   
			  <li>
              <label>Photographer <span>(Required Field)</span></label>
              <?php echo $this->Form->input('photographer_id', array('label' => false,'div'=>false,'empty'=>'-Select-'));?> </li>
			 
			  <li>
              <label>Name <span>(Required Field)</span></label>
              <?php echo $this->Form->input('photographer_name', array('label' => false,'div'=>false));?> </li>
			  
			  <li>
              <label>Mobile <span>(Required Field)</span></label>
              <?php echo $this->Form->input('photographer_mobile', array('label' => false,'div'=>false,'maxlength'=>12,'onkeypress'=>'return validate(event)'));?> </li>
			  
			  <li>
              <label>Email <span>(Required Field)</span></label>
              <?php echo $this->Form->input('photographer_email', array('label' => false,'div'=>false));?> </li>
			  
			  
			  <li>
              <label>Website <span>(Required Field)</span></label>
              <?php echo $this->Form->input('photographer_website', array('label' => false,'div'=>false));?> </li>
			  
			  <li>&nbsp;</li>
			
			  <li><h4 style="color:#E532A0;font-size:14px;">Other Details</strong></h4> </li>
			   <li>&nbsp;</li>
			  <li>
              <label>Personal Licklist Contact <span>(Required Field)</span></label>
              <?php echo $this->Form->input('personal_licklist_contact', array('label' => false,'div'=>false));?> </li>
			 
			 <li>
              <label>Secondary Licklist Contact</label>
              <?php echo $this->Form->input('secondary_licklist_contact', array('label' => false,'div'=>false));?> </li>
			    
			 
			  <li>
              <label>Mobile <span>(Required Field)</span></label>
              <?php echo $this->Form->input('mobile1', array('label' => false,'div'=>false,'maxlength'=>12,'onkeypress'=>'return validate(event)'));?> </li>	
			  
			  <li>
              <label>Mobile <span>(Other)</span></label>
              <?php echo $this->Form->input('mobile2', array('label' => false,'div'=>false,'maxlength'=>12,'onkeypress'=>'return validate(event)'));?> </li>
			  
			  <li>
              <label>Email <span>(Required Field)</span></label>
              <?php echo $this->Form->input('email1', array('label' => false,'value'=>'Ben@licklist.co.uk','div'=>false));?> </li>	
			  
			  <li>
              <label>Email <span>(Other)</span></label>
              <?php echo $this->Form->input('email2', array('label' => false,'div'=>false));?> </li>
			  
			  <li>
              <label>Message</label>
              <?php echo $this->Form->input('message', array('label' => false,'div'=>false));?> </li>	
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
