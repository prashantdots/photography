<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		if($this->Session->read('Auth.User.role')=='admin'){
		$this->Html->addCrumb('Photographer', array('admin'=>true,'controller'=>'photographers','action'=>'index'));
		}
		$this->Html->addCrumb('View Photographer');
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
             <?php echo h($photographer['Photographer']['id']); ?>
           
            <li>
              <label><?php echo __('Username'); ?></label>
              <?php  echo $photographer['User']['username']; ?> </li>
			
			 <li>
              <label><?php echo __('Name'); ?></label>
              <?php  echo $photographer['Photographer']['name']; ?> </li>
			  
			   <li>
              <label><?php echo __('Dob'); ?></label>
              <?php  echo $photographer['Photographer']['dob_date']; ?> </li>				  
			  
            
            <li>
              <label><?php echo __('Mobile'); ?></label>
              <?php echo h($photographer['Photographer']['mobile']); ?> </li>
            <li>
              <label><?php echo __('Address1'); ?></label>
              <?php echo h($photographer['Photographer']['address1']); ?></li>
          
            <li>
              <label><?php echo __('Address2'); ?></label>
                <?php echo h($photographer['Photographer']['address2']); ?></li>
           
            <li>
              <label><?php echo __('Town'); ?></label>
             <?php echo h($photographer['Photographer']['town']); ?> </li>
            
            <li>
              <label><?php echo __('County'); ?></label>
              <?php echo h($photographer['Photographer']['county']); ?> </li>
            <li>
              <label><?php echo __('Postcode'); ?></label>
             <?php echo h($photographer['Photographer']['postcode']); ?> </li>
			 
			  <li>
              <label><?php echo __('Website'); ?></label>
             <?php echo h($photographer['Photographer']['website']); ?> </li>
			 
			  <li>
              <label><?php echo __('Own Vehicle'); ?></label>
             <?php echo h(($photographer['Photographer']['vehicle']=='Y')?'Yes':'No'); ?> </li>
			 
			   <li>
              <label><?php echo __('Distance Will Travel'); ?></label>
             <?php echo h($photographer['Photographer']['distance']); ?> </li>
			 
			   <li>
              <label><?php echo __('Preferred Working Days'); ?></label>
             <?php echo h(($photographer['Photographer']['preferred_working_days']!='')?implode(',',unserialize($photographer['Photographer']['preferred_working_days'])):''); ?> </li>
			 
			   <li>
              <label><?php echo __('Photographic Experience'); ?></label>
             <?php echo h($photographer['Photographer']['experience']); ?> </li>
			 
			   <li>
              <label><?php echo __('Postproduction Experience'); ?></label>
             <?php echo h($photographer['Photographer']['post_experience']); ?> </li>
			 
			   <li>
              <label><?php echo __('Skill Score'); ?></label>
             <?php echo h($photographer['Photographer']['skill_score']); ?> </li>
             
			 <li>
              <label><?php echo __('Total shoots to date'); ?></label>
            <?php echo h($this->Common->totalShootToDate($photographer['Photographer']['id'])); ?> </li>
			 
			  <li>
              <label><?php echo __('Total earnings to date'); ?></label>
             &pound;&nbsp;<?php echo h($this->Common->totalEarningToDate($photographer['Photographer']['id'])); ?> </li>
			 
			  <li> <label><?php echo __('Created'); ?></label>
              <?php echo h(date('d-m-Y',strtotime($photographer['Photographer']['created']))); ?></li>
            
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
