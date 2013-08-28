<script type="text/javascript">

$(function() {
	$( "#JobDate" ).datepicker({
			minDate: new Date(),
			showOn: "button",
			buttonImage: "<?php echo $this->webroot;?>img/calendar.png",
			buttonImageOnly: true
	});

$('#JobJob').change(function(){
		 if($(this).val()==''){
		 $('#JobDate').val('');
		 $('#JobVenue').val('');
		 $('#JobPrice').val('');
		 $('#JobPhotographerName').val('');
		 }else{
			 $.ajax({
				type: 'POST',
				cache: false,
				url: '<?php echo $this->Html->url(array('admin'=>false,'controller'=>'invoices','action'=>'ajaxJobDetails'),true); ?>',
				data: 'job_no='+$(this).val(),
				dataType: 'json',
				success: function(data) {
					$('#JobDate').val(data.date);
					$('#JobVenue').val(data.venue);
					$('#JobPrice').val(data.price);
					$('#JobPhotographerName').val(data.photographer_name);
				}
			});
			return false;
		}
	});
});	
</script>
<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		$this->Html->addCrumb('Invoice');
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
          <h2>Send Invoice</h2>
        </div>
        <!-- End Box Head -->
        <?php echo $this->Form->create('Job'); ?>
        <!-- Form -->
        <div class="form">
          <ul class="fields">
            <li>
              <label>Job Number <span>(Required Field)</span></label>
             <?php 
			 echo $this->Form->input('job', array('type'=>'select','options'=>$jobs,'empty'=>'-Select Job No-','label' => false,'div'=>false));?> </li>
			 
			  <li>
              <label>Date <span>(Required Field)</span></label>
            <?php  echo $this->Form->input('date', array('label' => false,'div'=>false,'readonly'=>'readonly'));?> </li>
			 
			  <li>
              <label>Venue <span>(Required Field)</span></label>
             <?php  echo $this->Form->input('venue', array('label' => false,'div'=>false));?> </li>
			 
			  <li>
              <label>Price <span>(Required Field)</span></label>
             <?php  echo $this->Form->input('price', array('label' => false,'div'=>false));?> </li>
			 
			
           
		    
			  
			
          </ul>
        </div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
          <?php 
		 			echo $this->Form->hidden('photographer_name');
					$options = array(
								'label' => 'Send Invoice',
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
