<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('style');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->css('jquery-ui.css');
		echo $this->Html->script(array('jquery-1.9.1','jquery/jquery-ui','jquery/jquery-ui-1.10.2.custom.min'));
		
		
	?>
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
		<?php if ($authUser){?>
			<div id="top-navigation">
				Welcome 
				<?php
				if($this->Session->read('Auth.User.role')=='admin'){
				
			    echo $authUser['username'];  
				
				}if($this->Session->read('Auth.User.role')=='photographer'){
				
				echo $this->Html->link($authUser['username'] ,array('admin'=>true,'controller'=>'photographers','action'=>'edit',$this->Session->read('Auth.User.photographer_id')));
				
				}if($this->Session->read('Auth.User.role')=='venue'){
				
				echo $this->Html->link($authUser['username'] ,array('admin'=>true,'controller'=>'venues','action'=>'edit',$this->Session->read('Auth.User.venue_id')));
									
				}
				?>
				
				<span>|</span>
			<!--	<a href="#">Help</a>
				<span>|</span>
				<a href="#">Profile Settings</a>
				<span>|</span>-->
				<?php echo $this->Html->link('Log out', array('admin'=>true,'controller'=>'users','action'=>'logout'));?>
			</div>
			 <?php } ?>	
        <h1><?php 	
				if($authUser){
				echo $this->Html->image("logo.png", array("alt" => "Logo",'url' => array('admin'=>true,'controller'=>'dashboards','action'=>'index')));
				}else{
				echo $this->Html->image("logo.png", array("alt" => "Logo",'url' => array('admin'=>true,'controller'=>'users','action'=>'login')));
				}
		?></h1>
			<h2>Photography 
			
			
			<?php if($this->Session->read('Auth.User.role')=='photographer'){?>
			Photographer
			<?php }else if($this->Session->read('Auth.User.role')=='venue'){?>
			Venue
			<?php }else{?>
			Admin 
			<?php } ?>
			Panel</h2>
			
		</div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
		<?php if ($authUser){?>
		<div id="navigation">
			<ul>
				<?php if($this->Session->read('Auth.User.role')=='admin'){?>
				<li><a href="<?php echo Router::url('/', true);?>admin/dashboards/" <?php echo (strpos(Router::url( $this->here, true ),'dashboards')!='')?'class="active"':''?>><span>Dashboard</span></a></li>
				
			    <li><a href="<?php echo Router::url('/', true);?>admin/jobs" <?php echo (strpos(Router::url( $this->here, true ),'jobs')!='')?'class="active"':''?>><span>Job</span></a></li>
				<li><a href="<?php echo Router::url('/', true);?>admin/photographers" <?php echo (strpos(Router::url( $this->here, true ),'photographers')!='')?'class="active"':''?>><span>Photographers</span></a></li>
				<li><a href="<?php echo Router::url('/', true);?>admin/venues" <?php echo (strpos(Router::url( $this->here, true ),'venues')!='')?'class="active"':''?>><span>Venues</span></a></li>
				<li><a href="<?php echo Router::url('/', true);?>admin/calendars/allBooking" <?php echo (strpos(Router::url( $this->here, true ),'calendars')!='')?'class="active"':''?>><span>Calendar</span></a></li>
				
			<li><a href="<?php echo Router::url('/', true);?>admin/maps" <?php echo (strpos(Router::url( $this->here, true ),'maps')!='')?'class="active"':''?>><span>Map</span></a></li>
					
			<li><a href="<?php echo Router::url('/', true);?>admin/invoices" <?php echo (strpos(Router::url( $this->here, true ),'invoices')!='')?'class="active"':''?>><span>Invoice</span></a></li>	
				
				<li><a href="<?php echo Router::url('/', true);?>admin/settings" <?php echo (strpos(Router::url( $this->here, true ),'settings')!='')?'class="active"':''?>><span>Setting</span></a></li>
				
				<li><a href="<?php echo Router::url('/', true);?>admin/replenishes/log" <?php echo (strpos(Router::url( $this->here, true ),'replenishes')!='')?'class="active"':''?>><span>Replenish cards</span></a></li>
			<?php }if($this->Session->read('Auth.User.role')=='photographer'){ ?>	
			
			<li><a href="<?php echo Router::url('/', true);?>admin/dashboards/" <?php echo (strpos(Router::url( $this->here, true ),'dashboards')!='')?'class="active"':''?>><span>Dashboard</span></a></li>
			
			<li><a href="<?php echo Router::url('/', true);?>admin/invoices/add" <?php echo (strpos(Router::url( $this->here, true ),'invoices')!='')?'class="active"':''?>><span>Invoice</span></a></li>
			
			<li><a href="<?php echo Router::url('/', true);?>admin/calendars/" <?php echo (strpos(Router::url( $this->here, true ),'calendars')!='')?'class="active"':''?>><span>Calendar</span></a></li>
			
			<li><a href="<?php echo Router::url('/', true);?>admin/replenishes/" <?php echo (strpos(Router::url( $this->here, true ),'replenishes')!='')?'class="active"':''?>><span>Resources</span></a></li>
			
			<li><a href="<?php echo Router::url('/', true);?>admin/galleries/allHighResolutionRequest" <?php echo (strpos(Router::url( $this->here, true ),'HighResolutionImage')!='')?'class="active"':''?>><span>High Resolution Request</span></a></li>
			
			
			
			<?php }if($this->Session->read('Auth.User.role')=='venue'){ ?>	
			
			<li><a href="<?php echo Router::url('/', true);?>admin/dashboards/" <?php echo (strpos(Router::url( $this->here, true ),'dashboards')!='')?'class="active"':''?>><span>Dashboard</span></a></li>
			<?php }?>	
			   
			</ul>
		</div>
	 <?php } ?>	
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->

<!-- Container -->
<div id="container">
			<?php echo $this->fetch('content'); ?>
</div>
<!-- End Container -->

<!-- Footer -->
<div id="footer">
	<div class="shell">
		<span>&copy; 2013 - Photographer</span>
		
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</div>
<!-- End Footer -->

</body>
</html>