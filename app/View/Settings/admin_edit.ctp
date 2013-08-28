<script>
$(function(){
$('#SettingEmail').focus();
});
</script>
<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		$this->Html->addCrumb('Setting', array('admin'=>true,'controller'=>'settings','action'=>'index'));
		$this->Html->addCrumb('Edit Setting');
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
          <h2>Edit Setting</h2>
        </div>
        <!-- End Box Head -->
        <?php echo $this->Form->create('Setting',array('type'=>'file')); ?>
        <!-- Form -->
        <div class="form">
          <ul class="fields">
            <li>
              <label>Email <span>(Required Field)</span></label>
              <?php echo $this->Form->input('email', array('label' => false,'div'=>false,'li'=>false));?> </li>
           
		    <li>
              <label>Email1</label>
              <?php echo $this->Form->input('email1', array('label' => false,'div'=>false));?> </li>
			  
			 <li>
              <label>Email2</label>
              <?php echo $this->Form->input('email2', array('label' => false,'div'=>false));?> </li>
			  
			 <li>
              <label>Mobile<span>(Required Field)</span></label>
              <?php echo $this->Form->input('mobile', array('label' => false,'div'=>false));?> </li> 
		   
            <li>
              <label>Mobile1</label>
              <?php echo $this->Form->input('mobile1', array('label' => false,'div'=>false));?> </li> 
			  
		    <li>
              <label>Mobile2</label>
              <?php echo $this->Form->input('mobile2', array('label' => false,'div'=>false));?> </li> 
			  
		   <li>
              <label>Watermark Image</label>
              <?php echo $this->Form->input('watermark_image', array('type'=>'file','label' => false,'div'=>false));?> </li> 
			 
			
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
