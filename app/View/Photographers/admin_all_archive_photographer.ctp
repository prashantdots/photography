<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav">
		<?php
		$this->Html->addCrumb('Photographer', array('admin'=>true,'controller'=>'photographers','action'=>'index'));
		$this->Html->addCrumb('Archive Photographer');
		echo $this->Html->getCrumbs(' > ','Dashboard');?>
		</div>
		<!-- End Small Nav -->
		
		<?php echo $this->Session->flash(); ?>
		<br />
		<!-- Main -->
			
		<div id="main">
	
	<br /><br /><br />
	
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
			
				<!-- Box -->
				<div class="box full">
				
					<!-- Box Head -->
					<?php echo $this->Form->create("photographeers", array('type' => 'get'),array('action' => 'index')); ?>
					<div class="box-head">
						<h2 class="left">Current Photgrapher</h2>
						<div class="right">
							<label>search photographers</label>
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
                        <col width="150" />
					</colgroup>	
							<tr>
									<th><?php echo $this->Paginator->sort('id'); ?></th>
									<th><?php echo $this->Paginator->sort('user_id'); ?></th>
									<th><?php echo $this->Paginator->sort('User.email','Email'); ?></th>
									<th><?php echo $this->Paginator->sort('name','Name'); ?></th>
									<th><?php echo $this->Paginator->sort('mobile','Mobile'); ?></th>
									<th><?php echo $this->Paginator->sort('address1','Address'); ?></th>
									<th><?php echo $this->Paginator->sort('created'); ?></th>
							
								<th class="ac">Content Control</th>
							</tr>
						<?php
						if(!empty($photographers)):
						$num=0;
						foreach ($photographers as $photographer):
						if($num%2==0)
						$class='';
						else
						$class='class="odd"';
						 ?>
							<tr <?php echo $class;?>>
								<td><?php echo h($photographer['Photographer']['id']); ?>&nbsp;</td>
								<td><?php  echo $this->Html->link($photographer['User']['username'], array('controller' => 'photographers', 'action' => 'view', $photographer['Photographer']['id'])); ?>&nbsp;</td>
								<td><?php echo h($photographer['User']['email']); ?>&nbsp;</td>
								<td><?php echo h($photographer['Photographer']['name']); ?>&nbsp;</td>
								<td><?php echo h($photographer['Photographer']['mobile']); ?>&nbsp;</td>
								<td><?php echo h($photographer['Photographer']['address1']).','.h($photographer['Photographer']['address2']).','.h($photographer['Photographer']['town']).','.h($photographer['Photographer']['county']).','.h($photographer['Photographer']['postcode']); ?>&nbsp;</td>
								<td><?php echo h(date('d-m-Y',strtotime($photographer['Photographer']['created']))); ?>&nbsp;</td>
								
								<td class="actions" align="justify">
										<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $photographer['Photographer']['id']),array('class'=>'ico edit')); ?>
										<?php echo $this->Html->link(__('Calendar'), array('action' => 'calendar', $photographer['Photographer']['id']),array('class'=>'ico edit')); ?>
										<?php //echo $this->Form->postLink(__('Archive'), array('action' => 'delete', $photographer['Photographer']['id']), array('class'=>'ico del'), __('Are you sure want to put this into archive?', $photographer['Photographer']['id']),array('class'=>'ico del')); ?>
										
										
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
