<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav">
		<?php
		$this->Html->addCrumb('Venues');
		echo $this->Html->getCrumbs(' > ','Dashboard');?>
		</div>
		<!-- End Small Nav -->
		
		<?php echo $this->Session->flash(); ?>
		<br />
		<!-- Main -->
			
		<div id="main">
		<a href="<?php echo Router::url('/', true);?>admin/venues/add" class="add-button" style="float:right;"><span>Add new venue</span></a><br /><br /><br />
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
			
				<!-- Box -->
				<div class="box full">
				
					<!-- Box Head -->
					<?php echo $this->Form->create("Venue", array('type' => 'get'),array('action' => 'index')); ?>
					<div class="box-head">
						<h2 class="left">Current Venue</h2>
						<div class="right">
							<label>search venues</label>
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
                        <col width="110" />
                        <col width="" />
                        <col width="110" />
                        <col width="140" />
                        </colgroup>
							<tr>
									<th><?php echo $this->Paginator->sort('id'); ?></th>
									<th><?php echo $this->Paginator->sort('User.username','Username'); ?></th>
									<th><?php echo $this->Paginator->sort('User.email','Email'); ?></th>
									<th><?php echo $this->Paginator->sort('name','Name'); ?></th>
									<th><?php echo $this->Paginator->sort('mobile','Mobile'); ?></th>
									<th><?php echo $this->Paginator->sort('address','Address'); ?></th>
									<th><?php echo $this->Paginator->sort('created'); ?></th>
							
								<th width="110" class="ac">Content Control</th>
							</tr>
						<?php
						if(!empty($venues)):
						$num=0;
						foreach ($venues as $venue):
						if($num%2==0)
						$class='';
						else
						$class='class="odd"';
						 ?>
							<tr <?php echo $class;?>>
							<td><?php echo h($venue['Venue']['id']); ?>&nbsp;</td>
							<td><?php  echo $this->Html->link($venue['User']['username'], array('controller' => 'venues', 'action' => 'view', $venue['Venue']['id'])); ?>&nbsp;</td>
							<td><?php echo $venue['User']['email']; ?>&nbsp;</td>
							<td><?php echo h($venue['Venue']['name']); ?>&nbsp;</td>
							<td><?php echo h($venue['Venue']['mobile']); ?>&nbsp;</td>
							<td><?php echo h($venue['Venue']['address']).','.h($venue['Venue']['town']).','.h($venue['Venue']['county']).','.h($venue['Venue']['postcode']); ?>&nbsp;</td>
							<td><?php echo h(date('d-m-Y',strtotime($venue['Venue']['created']))); ?>&nbsp;</td>
							<td class="actions">
									<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $venue['Venue']['id']),array('class'=>'ico edit')); ?>
									<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $venue['Venue']['id']), array('class'=>'ico del'), __('Are you sure you want to delete?', $venue['Venue']['id'])); ?>
							</td>
							</tr>
					<?php 
					$num++;
					endforeach; 
					else:
					?>		
					<tr><td colspan="8">No Record Available</td></tr>	
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
