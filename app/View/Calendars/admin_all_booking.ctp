<?php
echo $this->Html->script(array('fullcalendar/fullcalendar.min'));
echo $this->Html->css(array('fullcalendar/fullcalendar','fullcalendar/fullcalendar.print'));
?>
<script>

	$(document).ready(function() {
	
		$('#calendar').fullCalendar({

			editable: false,
			
			events: "<?php echo $this->Html->url(array('admin'=>true, 'controller'=>'calendars','action'=>'getAllBooking',(array_key_exists('search',$this->request->query))?$this->request->query['search']:''),true); ?>",
			
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
				<!-- Box Head -->
					<?php echo $this->Form->create("photographeers", array('type' => 'get'),array('action' => 'index')); ?>
					<div class="box-head">
						<h2 class="left">Calendar</h2>
						<div class="right">
							<label>search county</label>
							<input type="text" name="search" class="field small-field" value="<?php echo (array_key_exists('search',$this->request->query))?$this->request->query['search']:''?>"/>
							<input type="submit" class="button" value="search" />
						</div>
					</div>
					<?php  echo $this->Form->end(); ?>
					<!-- End Box Head -->	
<div id='loading' style='display:none'>loading...</div>
<div id='calendar'></div>

			</div>
			<!-- End Content -->
			

			
			<div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
	</div>

