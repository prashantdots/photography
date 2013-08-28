<?php
echo $this->Html->script(array('fullcalendar/fullcalendar.min'));
echo $this->Html->css(array('fullcalendar/fullcalendar','fullcalendar/fullcalendar.print'));
?>
<script>

	$(document).ready(function() {
	
		$('#calendar').fullCalendar({
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
			var d = new Date(start);
			var dateForRequest=[d.getDate(), d.getMonth()+1, d.getFullYear()].join('/');
				 $.ajax({
						type: 'POST',
						cache: false,
						url: '<?php echo $this->Html->url(array('admin'=>false,'controller'=>'calendars','action'=>'ajaxCheckPhotographerBooking'),true); ?>',
						data: 'date='+dateForRequest,
						dataType: 'json',
						success: function(data) {
							if(data.response=='success'){
								var title = prompt('Event Note:');
								if (title) {
										$.ajax({
											type: 'POST',
											cache: false,
											url: '<?php echo $this->Html->url(array('admin'=>false,'controller'=>'calendars','action'=>'ajaxSavePhotographerReason'),true); ?>',
											data: {date:dateForRequest,reason:title},
											dataType: 'json',
											success: function(data) {
											  if(data.response=='success'){
												window.location.href="<?php echo Router::url('/', true);?>admin/calendars";
											  }else{
											  alert('Error while submitting data');
											  }
											}
										});
										
										
								}
							}
							
							
						}
					});
			},
			editable: true,
			
			events: "<?php echo $this->Html->url(array('admin'=>false, 'controller'=>'calendars','action'=>'getAvailability'),true); ?>",
			
			eventDrop: function(event, delta) {
				alert(event.title + ' was moved ' + delta + ' days\n' +
					'(should probably update your database)');
			},
			
			loading: function(bool) {
				if (bool) $('#loading').show();
				else $('#loading').hide();
			}
			
		});
		
	});

</script>

<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav">
		<?php
		$this->Html->addCrumb('Setting');
		echo $this->Html->getCrumbs(' > ','Dashboard');?>
		</div>
		<!-- End Small Nav -->
		
		<?php echo $this->Session->flash(); ?>
		<br />
		<!-- Main -->
			
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
<div id='loading' style='display:none'>loading...</div>
<div id='calendar'></div>

			</div>
			<!-- End Content -->
			

			
			<div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
	</div>

