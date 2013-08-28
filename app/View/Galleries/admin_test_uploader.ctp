<?php 
echo $this->Html->css('vpb_uploader/vpb_uploader.css');
echo $this->Html->script(array('vpb_uploader/vpb_uploader.js'));?>

<script type="text/javascript">
$(document).ready(function()
{
	// Call the main function
	new vpb_multiple_file_uploader
	({
		vpb_form_id: "vasplus_form_id", // Form ID
		autoSubmit: true,
		vpb_server_url: "<?php echo $this->Html->url(array('admin'=>false,'controller'=>'galleries','action'=>'upload_multiple',$job_id));?>" 
		// PHP file for uploading the browsed files
		// To modify the design and display of the browsed file,
		// Open the file named js/vpb_uploader.js and search for the following: /* Display added files which are ready for upload */
		// You can modify the design and display of browsed files and also the CSS file as wish.
	});
});
</script>

<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		$this->Html->addCrumb('Gallery',array('admin'=>true,'controller'=>'galleries','action'=>'index',$job_id));
		$this->Html->addCrumb('Add Gallery');
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
          <h2>Add Gallery</h2>
        </div>
        <!-- End Box Head -->
        <!-- Form -->
        <div class="form">
		<ul class="list">
		<li class=""><strong>Title:</strong><?php echo $jobDetails['Job']['venue_contact_person'].'- Licklist '.date('d/m/y');?></li>
		</ul>
		
		<!-- Browse and Submit Added Giles Area -->	
<center><div style="width:800px; margin-top:20px;" align="center">
		<!--<form name="vasplus_form_id" id="vasplus_form_id" action="javascript:void(0);" enctype="multipart/form-data">-->
		<?php echo $this->Form->create(null, array('url' => 'javascript:void(0);','type' => 'file','id'=>'vasplus_form_id','name'=>'vasplus_form_id'));?>
		
		<div style="width:300px;" align="center">
		<div style="width:230px; float:left;" align="right">
		<div class="vpb_browse_file_box">
		<?php echo $this->Form->input('vasplus_multiple_files.', array('type'=>'file','label' => false,'div'=>false,'li'=>false,'multiple'=>true,'id'=>'vasplus_multiple_files','style'=>'opacity:0;-moz-opacity:0;filter:alpha(opacity:0);z-index:9999;width:90px;padding:5px;cursor:default;'));?> 
		</div>
		</div>
		<div style="width:70px; float:left;" align="left">
		
		<input type="submit" value="Upload" class="vpb_general_button" />
		  <?php 
		  echo $this->Form->end();?>
		</div><br clear="all">
		</div>
		
		</div></center>
		
		
		<br clear="all" /><br clear="all" />
		
		
		
		<!-- Uploaded Files Displayer Area -->	
		<div id="vpb_added_files_box" class="vpb_file_upload_main_wrapper">
		<div id="vpb_file_system_displayer_header"> 
		<div id="vpb_header_file_names"><div style="width:365px; float:left;">File Names</div><div style="width:90px; float:left;">Status</div></div>
		<div id="vpb_header_file_size">Size</div>
		<div id="vpb_header_file_last_date_modified">Last Modified</div><br clear="all" />
		</div>
		<input type="hidden" id="added_class" value="vpb_blue">
		<span id="vpb_removed_files"></span>
</div>
        </div>
        <!-- End Form -->
      </div>
      <!-- End Box -->
    </div>
    <!-- End Content -->
    <div class="cl">&nbsp;</div>
  </div>
  <!-- Main -->
</div>
