<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		if($this->Session->read('Auth.User.role')=='admin'){
		$this->Html->addCrumb('Venue', array('admin'=>true,'controller'=>'venues','action'=>'index'));
		}
		$this->Html->addCrumb('View Venue');
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
          <h2>View Photographer</h2>
        </div>
        <!-- End Box Head -->
        <?php echo $this->Form->create('User'); ?>
        <!-- Form -->
        <div class="form">
          <ul class="fields">
			 <li>
              <label><?php echo __('Id'); ?></label>
             <?php echo h($venue['Venue']['id']); ?>
           
            <li>
              <label><?php echo __('Username'); ?></label>
              <?php  echo $venue['User']['username']; ?> </li>
			
			 <li>
              <label><?php echo __('Email'); ?></label>
              <?php  echo $venue['User']['email']; ?> </li>			  
			  
            
            <li>
              <label><?php echo __('Name'); ?></label>
              <?php echo h($venue['Venue']['name']); ?> </li>
            <li>
              <label><?php echo __('Mobile'); ?></label>
              <?php echo h($venue['Venue']['mobile']); ?></li>
          
            <li>
              <label><?php echo __('Address'); ?></label>
              <?php echo h($venue['Venue']['address']); ?> </li>
           
            <li>
              <label><?php echo __('Town'); ?></label>
              <?php echo h($venue['Venue']['town']); ?> </li>
            
            <li>
              <label><?php echo __('County'); ?></label>
              <?php echo h($venue['Venue']['county']); ?> </li>
            <li>
              <label><?php echo __('Postcode'); ?></label>
             <?php echo h($venue['Venue']['postcode']); ?> </li>
             
			  <li> <label><?php echo __('Created'); ?></label>
              <?php echo h(date('d-m-Y',strtotime($venue['Venue']['created']))); ?></li>
            <li>
              <label><?php echo __('Modified'); ?></label>
               <?php echo h(date('d-m-Y',strtotime($venue['Venue']['modified']))); ?>  </li>
          </ul>
        </div>
        <!-- End Form -->
        <!-- Form Buttons -->
        <div class="buttons">
    
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
