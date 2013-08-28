<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		$this->Html->addCrumb('View Invoice');
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
          <h2>View Invoice</h2>
        </div>
        <!-- End Box Head -->
        <!-- Form -->
        <div class="form">
          <ul class="fields">
			 <li>
              <label><?php echo __('Invoice Id'); ?></label>
             <?php echo h($invoice['Invoice']['id']); ?>
           
            <li>
              <label><?php echo __('Job No'); ?></label>
              <?php  echo $invoice['Job']['job_no']; ?> </li>
			
			 <li>
              <label><?php echo __('Photographer'); ?></label>
              <?php  echo $invoice['Invoice']['photographer_name']; ?> </li>			  
			  
            
            <li>
              <label><?php echo __('Venue'); ?></label>
              <?php echo h($invoice['Invoice']['venue_contact_person']); ?> </li>
            <li>
              <label><?php echo __('Price'); ?></label>
              &pound;<?php echo h($invoice['Invoice']['price']); ?></li>
          
            <li>
              <label><?php echo __('Issue Date'); ?></label>
             <?php echo h($invoice['Invoice']['issue_date']); ?> </li>
           
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
