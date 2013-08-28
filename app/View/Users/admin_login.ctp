<script>
$(function(){
$('#UserUsername').focus();
});
</script>
<div class="shell">
<?php echo $this->Session->flash(); ?>
  <!-- Main -->
  <div id="main">

    <!-- Content -->
    <div id="content">
      <!-- Box -->
      <div class="login-box">
     
        <!-- Box Head -->
        <div class="login-box-head">
          <h2>Login</h2>
        </div>
        <!-- End Box Head -->
        <?php echo $this->Session->flash('auth'); ?> <?php echo $this->Form->create('User'); ?>
        <div class="login-box-wrapper">
        <!-- Form -->
        <div class="login-form">
          
            <label><?php echo __('Please enter your username and password'); ?></label>
            <?php echo $this->Form->input('username',array('class'=>'input','placeholder'=>'Username'));?> 
           <?php echo $this->Form->input('password',array('class'=>'input','placeholder'=>'Password'));?> 
        </div>
        <!-- End Form -->
        </div>        
        <!-- Form Buttons -->
        <div class="login-buttons">
        <div class="login-box-wrapper">
          <?php 
							$options = array(
								'label' => 'Login',
								'class' => 'button',
								'div'=>false,
							);
						  echo $this->Form->end($options);  
							//echo $this->Form->end(__('Login')); ?>
          <?php //echo $this->Html->link('Register', array('admin' => true, 'controller' => 'users','action'=>'add'), array('class' => 'button','style'=>'text-decoration:none;'));?>
        </div>
        </div>
        <!-- End Form Buttons -->
      <div class="login-footer">
          <?php echo $this->Html->link('Apply', array('admin'=>false,'controller'=>'photographers','action'=>'signup'), array('class' => 'apply_button button'));?>
</div>
      </div>
      
      <!-- End Box -->
    </div>
    <!-- End Content -->
    <div class="cl"></div>
  </div>
  <!-- Main -->

</div>