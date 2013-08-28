<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		if($this->Session->read('Auth.User.role')=='admin'){
		$this->Html->addCrumb('Job', array('admin'=>true,'controller'=>'jobs','action'=>'index'));
		}
		$this->Html->addCrumb('View Job');
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
          <h2>View Job</h2>
        </div>
        <!-- End Box Head -->
        <?php echo $this->Form->create('User'); ?>
        <!-- Form -->
        <div class="form">
          <ul class="fields">
			 <li>
              <label><?php echo __('Id'); ?></label>
            <?php echo h($job['Job']['id']); ?>
           
            <li>
              <label><?php echo __('Job No'); ?></label>
              <?php echo h($job['Job']['job_no']); ?></li>
			
			 <li>
              <label><?php echo __('Order Date'); ?></label>
             <?php echo h(date('d-m-Y',strtotime($job['Job']['order_date']))); ?> </li>			  
			  
            
            <li>
              <label><?php echo __('Ordered By'); ?></label>
              <?php echo h($job['Job']['ordered_by']); ?></li>
            <li>
              <label><?php echo __('Agreed Photographer Fee'); ?></label>
            <?php echo '&pound;'.h($job['Job']['agreed_photographer_fee']); ?></li>
          
            <li>
              <label><?php echo __('Agreed Venue Fee'); ?></label>
              <?php echo '&pound;'.h($job['Job']['agreed_venue_fee']); ?> </li>
           
            <li>
              <label><?php echo __('Shoot Date'); ?></label>
             <?php echo h(date('d-m-Y',strtotime($job['Job']['shoot_date']))); ?></li>
            
            <li>
              <label><?php echo __('Venue'); ?></label>
             <?php echo $this->Html->link($job['Venue']['name'], array('controller' => 'venues', 'action' => 'view', $job['Venue']['id'])); ?> </li>
            <li>
              <label><?php echo __('Venue Contact Person'); ?></label>
             <?php echo h($job['Job']['venue_contact_person']); ?> </li>
             
			  <li> <label><?php echo __('Venue Mobile'); ?></label>
              <?php echo h($job['Job']['venue_mobile']); ?></li>
            <li>
              <label><?php echo __('Venue Address'); ?></label>
              <?php echo h($job['Job']['venue_address']); ?> </li>
			  
			   <li>
              <label><?php echo __('Venue Postcode'); ?></label>
              <?php echo h($job['Job']['venue_postcode']); ?> </li>
			  
			   <li>
              <label><?php echo __('Photographer Arrival Time'); ?></label>
              <?php echo h($job['Job']['photographer_arrival_time']); ?> </li>
			  
			   <li>
              <label><?php echo __('Shoot Commences'); ?></label>
              <?php echo h($job['Job']['shoot_commences']); ?> </li>
			  
			   <li>
              <label><?php echo __('Shoot Concludes'); ?></label>
              <?php echo h($job['Job']['shoot_concludes']); ?> </li>
			  
			   <li>
              <label><?php echo __('Dress Code'); ?></label>
              <?php echo h($job['Job']['dress_code']); ?> </li>
			  
			  	   <li>
              <label><?php echo __('Image Upload Req By'); ?></label>
              <?php echo h($job['Job']['image_upload_req_by']); ?> </li>
			  
			  	   <li>
              <label><?php echo __('Photographer'); ?></label>
            <?php echo $this->Html->link($job['Photographer']['name'], array('controller' => 'photographers', 'action' => 'view', $job['Photographer']['id'])); ?></li>
			  
			  	   <li>
              <label><?php echo __('Photographer Name'); ?></label>
             <?php echo h($job['Job']['photographer_name']); ?> </li>
			  
			  	   <li>
              <label><?php echo __('Photographer Mobile'); ?></label>
              <?php echo h($job['Job']['photographer_mobile']); ?> </li>
			  
			  <li>
              <label><?php echo __('Photographer Email'); ?></label>
              <?php echo h($job['Job']['photographer_email']); ?> </li>
			    <li>
              <label><?php echo __('Cover Photographer'); ?></label>
              <?php echo h($job['Job']['cover_photographer']); ?> </li>
			    <li>
              <label><?php echo __('Personal Licklist Contact'); ?></label>
              <?php echo h($job['Job']['personal_licklist_contact']); ?> </li>
			    <li>
              <label><?php echo __('Mobile1'); ?></label>
              <?php echo h($job['Job']['mobile1']); ?> </li>
			    <li>
              <label><?php echo __('Mobile2'); ?></label>
              <?php echo h($job['Job']['mobile2']); ?> </li>
			      <li>
              <label><?php echo __('Email1'); ?></label>
              <?php echo h($job['Job']['email1']); ?> </li>
			   <li>
              <label><?php echo __('Email2'); ?></label>
              <?php echo h($job['Job']['email2']); ?> </li>
			  
			  <li>
              <label><?php echo __('Message'); ?></label>
              <?php echo h($job['Job']['message']); ?> </li>
			  
			  <li>
              <label><?php echo __('Created'); ?></label>
              <?php echo h(date('d-m-Y',strtotime($job['Job']['created']))); ?></li>
			  
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
