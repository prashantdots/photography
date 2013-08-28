<div class="shell">
		
		<!-- Small Bread Crumb -->
		<div class="small-nav">
					Dashboard
		</div>
		<!-- End Small Bread Crumb -->
		<!-- Flash messages -->
		<?php echo $this->Session->flash(); ?>
		<br />
		<!-- End Flash messages -->
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				
				<!-- Box -->
				<div class="box full">
				
					<!-- Box Head -->
					<?php echo $this->Form->create("Job", array('type' => 'get'),array('action' => 'index')); ?>
					<div class="box-head">
						<h2 class="left">Current Jobs</h2>
						<div class="right">
							<label>search jobs</label>
							<input type="text" name="search" class="field small-field" value="<?php echo (array_key_exists('search',$this->request->query))?$this->request->query['search']:''?>"/>
							<input type="submit" class="button" value="search" />
						</div>
					</div>
					<?php  echo $this->Form->end(); ?>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						 <colgroup>
                        <col width="" />
						<col width="" />
                        <col width="" />
                        <col width="" />
                        <col width="" />
                        <col width="" />
                        <col width="" />
                        <col width="" />
                        <col width="" />
                        </colgroup>
							<tr>
								<th><?php echo $this->Paginator->sort('id'); ?></th>
								<th><?php echo $this->Paginator->sort('invoice_id'); ?></th>
								<th><?php echo $this->Paginator->sort('venue_id'); ?></th>
								<th><?php echo $this->Paginator->sort('photographer_id'); ?></th>
								<th><?php echo $this->Paginator->sort('ordered_by'); ?></th>
								<th><?php echo $this->Paginator->sort('order_date'); ?></th>
								<th><?php echo $this->Paginator->sort('shoot_date'); ?></th>
								<th><?php echo $this->Paginator->sort('created'); ?></th>
								<th width="110" class="ac">Content Control</th>
							</tr>
						<?php
						if(!empty($jobs)):
						$num=0;
						foreach ($jobs as $job):
						if($num%2==0)
						$class='';
						else
						$class='class="odd"';
						 ?>
							<tr <?php echo $class;?>>
							<td><?php echo h($job['Job']['id']); ?>&nbsp;</td>
							<td><?php  echo ($job['Invoice']['id']!='')?$this->Html->link($job['Invoice']['id'], array('controller' => 'invoices', 'action' => 'view', $job['Invoice']['id'])):'Not created'; ?>&nbsp;</td>
							<td><?php echo $this->Html->link($job['Venue']['name'], array('controller' => 'venues', 'action' => 'view', $job['Venue']['id'])); ?></td>
							<td>
							<?php 
							if($this->Session->read('Auth.User.role')=='venue'){
							echo h($job['Photographer']['name']); 
							}else{
							echo $this->Html->link($job['Photographer']['name'], array('controller' => 'photographers', 'action' => 'view', $job['Photographer']['id'])); 
							}
							
							?>							
							
							</td>
							<td><?php echo h($job['Job']['ordered_by']); ?>&nbsp;</td>
							<td><?php echo h(date('d-m-Y',strtotime($job['Job']['order_date']))); ?>&nbsp;</td>
							<td><?php echo h(date('d-m-Y',strtotime($job['Job']['shoot_date']))); ?>&nbsp;</td>
							<td><?php echo h(date('d-m-Y',strtotime($job['Job']['created']))); ?>&nbsp;</td>
							<td class="actions">
						<?php 
						if($this->Session->read('Auth.User.role')=='photographer')
						echo $this->Html->link(__('AddGallery'), array('admin'=>true,'controller'=>'galleries','action' => 'add', $job['Job']['id']),array('class'=>'ico edit'));
						echo $this->Html->link(__('UploadGallery'), array('admin'=>true,'controller'=>'galleries','action' => 'testUploader', $job['Job']['id']),array('class'=>'ico edit'));
						 ?>
						<?php echo $this->Html->link(__('ViewGallery'), array('admin'=>true,'controller'=>'galleries','action' => 'index', $job['Job']['id']),array('class'=>'ico edit')); ?>
						
								
							</td>
							</tr>
					<?php 
					$num++;
					endforeach;
					else:
					 ?>		
						<tr><td colspan="9">No Record Available</td></tr>
				    <?php endif;?>		
						</table>
						
						
						<!-- Pagging -->
						<div class="pagging">
							<div class="left"><?php	echo $this->Paginator->counter(array('format' => __('Showing {:current}-{:count} of {:pages}')));?></div>
							<div class="right">
								<?php 	echo $this->Paginator->prev( __('Previous'), array('tag'=>'span','after'=>null,'before'=>null), null, array());?>
								<?php echo $this->Paginator->numbers(array('separator' => ''));?>
								<?php echo $this->Paginator->next(__('Next'), array(), null, array());?>
								
							</div>
						</div>
						<!-- End Pagging -->
						
					</div>
					<!-- Table -->
					
				</div>
				<!-- End Box -->

			</div>
			<!-- End Content -->
			
		
			
			<div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
	</div>