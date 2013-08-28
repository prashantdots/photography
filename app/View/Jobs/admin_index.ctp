<?php
App::import('Helper', 'Common');
?>
<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav">
		<?php
		$this->Html->addCrumb('Jobs');
		echo $this->Html->getCrumbs(' > ','Dashboard');?>
		</div>
		<!-- End Small Nav -->
		
		<?php echo $this->Session->flash(); ?>
		<br />
		<!-- Main -->
			
		<div id="main">
		<a href="<?php echo Router::url('/', true);?>admin/jobs/add?jobtype=live" class="add-button" style="float:right;"><span>Add new job</span></a>
		<a href="<?php echo Router::url('/', true);?>admin/jobs/optionedJob" class="add-button" ><span>Optioned Job</span></a>
		&nbsp;&nbsp;
		<br /><br /><br />
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
							<col width="180" />
						   </colgroup>
							<tr>
								<th><?php echo $this->Paginator->sort('id'); ?></th>
								<th><?php echo $this->Paginator->sort('job_no'); ?></th>
								<th><?php echo $this->Paginator->sort('venue_id'); ?></th>
								<th><?php echo $this->Paginator->sort('photographer_id'); ?></th>
								<th><?php echo $this->Paginator->sort('ordered_by'); ?></th>
								<th><?php echo $this->Paginator->sort('order_date'); ?></th>
								<th><?php echo $this->Paginator->sort('shoot_date'); ?></th>
								<th>Upload complete</th>
								<th class="ac">Content Control</th>
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
							<td><?php  echo $this->Html->link($job['Job']['job_no'], array('controller' => 'jobs', 'action' => 'view', $job['Job']['id'])); ?>&nbsp;</td>
							<td><?php echo $this->Html->link($job['Venue']['name'], array('controller' => 'venues', 'action' => 'view', $job['Venue']['id'])); ?></td>
							<td><?php echo $this->Html->link($job['Photographer']['name'], array('controller' => 'photographers', 'action' => 'view', $job['Photographer']['id'])); ?>							</td>
							<td><?php echo h($job['Job']['ordered_by']); ?>&nbsp;</td>
							<td><?php echo h(date('d-m-Y',strtotime($job['Job']['order_date']))); ?>&nbsp;</td>
							<td><?php echo h(date('d-m-Y',strtotime($job['Job']['shoot_date']))); ?>&nbsp;</td>
							<td><?php 
							echo $this->Common->getJobUploadDate($job['Job']['id']);
							 ?>&nbsp;</td>
							<td class="actions">
								<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $job['Job']['id']),array('class'=>'ico edit')); ?>
								<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $job['Job']['id']), array('class'=>'ico del'), __('Are you sure want to delete?', $job['Job']['id'])); ?>
								<?php echo $this->Html->link(__('Re-use'), array('action' => 'reUserOrder', $job['Job']['id']),array('class'=>'ico edit')); 
								
								 echo $this->Html->link(__('ViewGallery'), array('admin'=>true,'controller'=>'galleries','action' => 'index', $job['Job']['id']),array('class'=>'ico edit')); ?>
							</td>
							</tr>
					<?php 
					$num++;
					endforeach;
					else:
					 ?>	
					 <tr><td colspan="9">No Record Available</td></tr>	
					<?php endif; ?>		
						
						
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
