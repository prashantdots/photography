<?php
echo $this->Html->script(array('fullcalendar/fullcalendar.min'));
echo $this->Html->css(array('fullcalendar/fullcalendar','fullcalendar/fullcalendar.print'));
?>
<script>

	$(document).ready(function() {
	
		$('#calendar').fullCalendar({

			editable: true,
			
			events: "<?php echo $this->Html->url(array('admin'=>true, 'controller'=>'photographers','action'=>'getAvailability',$photogrpaher_id),true); ?>",
			
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
		$this->Html->addCrumb('Photographer', array('admin'=>true,'controller'=>'photographers','action'=>'index'));
		$this->Html->addCrumb('Calendar');
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

