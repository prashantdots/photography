<?php 
echo $this->Html->script(array('autosuggest/bsn.AutoSuggest_2.1.3'));
echo $this->Html->css('autosuggest/autosuggest_inquisitor');
?>
<script>
$(function(){
$('#UserVenueName').focus();
});

function getVenueDetails(venueName){

	$('#UserUsername').val('');
	$('#UserName').val('');
	$('#UserAddress').val('');
	$('#UserTown').val('');
	$('#UserCounty').val('');
	
	
			 $.ajax({
					type: 'POST',
					cache: false,
					url: '<?php echo $this->Html->url(array('admin'=>false,'controller'=>'venues','action'=>'ajaxGetVenueData'),true); ?>',
					data: 'venue='+venueName,
					dataType: 'json',
					success: function(data) {
						$('#UserUsername').val(data.slug);
						$('#UserName').val(data.name);
						$('#UserAddress').val(data.address);
						$('#UserTown').val(data.town);
						$('#UserCounty').val(data.county);
					}
				});
	
}
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
		$this->Html->addCrumb('Venue', array('admin'=>true,'controller'=>'venues','action'=>'index'));
		$this->Html->addCrumb('Add Venue');
		echo $this->Html->getCrumbs('>','Dashboard');?>
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
          <h2>Add Venue</h2>
        </div>
        <!-- End Box Head -->
        <?php echo $this->Form->create('User',array('type'=>'file')); ?>
        <!-- Form -->
        <div class="form">
          <ul class="fields">
			 <li>
              <label>Venue Name</label>
              <?php 
			  echo $this->Form->input('venue_name', array('label' => false,'div'=>false,'li'=>false));
			  echo $this->Form->hidden('licklist_venue_id');
			  ?>
			   <script type="text/javascript">
                            var options_xml = {
                                script:"<?php echo Router::url('/', true);?>venues/ajaxGetVenueList?",
                                varname:"venue",
                                timeout:10500,
								callback: function (obj) { document.getElementById('UserLicklistVenueId').value = obj.id;getVenueDetails(obj.info) }
                            }
							
                            var as_xml = new bsn.AutoSuggest('UserVenueName', options_xml);
                   
                  </script>
			   </li>
			  <li>&nbsp;</li>
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
              <label>Name <span>(Required Field)</span></label>
              <?php echo $this->Form->input('name', array('label' => false,'div'=>false,'li'=>false));?> </li>
           
            <li>
              <label>Mobile <span>(Required Field)</span></label>
              <?php echo $this->Form->input('mobile', array('label' => false,'div'=>false,'maxlength'=>12,'onkeypress'=>'return validate(event)'));?> </li>
            
            <li>
              <label>Address <span>(Required Field)</span></label>
              <?php echo $this->Form->input('address', array('label' => false,'div'=>false));?> </li>
            <li>
              <label>Town<span>(Required Field)</span></label>
              <?php echo $this->Form->input('town', array('label' => false,'div'=>false));?> </li>
             
			  <li> <label>County<span>(Required Field)</span></label>
              <?php echo $this->Form->input('county', array('label' => false,'div'=>false));?> </li>
            <li>
              <label>Postcode<span>(Required Field)</span></label>
              <?php echo $this->Form->input('postcode', array('label' => false,'div'=>false));?> </li>
			  <li>
			  <label>Watermark Image</label>
		    <?php echo $this->Form->radio('watermark_image_type', array('normal' => 'Normal', 'banner' => 'Banner'), array('legend' => false,'value' => 'normal'),array('label' => false,'div'=>false));?>
			  </li>   
			<li>
              <label>Watermark Image<span>(Required Field)</span></label>
              <?php echo $this->Form->input('watermark_image', array('type'=>'file','label' => false,'div'=>false));?> </li>  
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
