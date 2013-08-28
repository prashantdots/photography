<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav">
		<?php
		$this->Html->addCrumb('Invoice');
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
			
				<!-- Box -->
				<div class="box full">
				
					<!-- Box Head -->
					<?php echo $this->Form->create("Invoice", array('type' => 'get'),array('action' => 'index')); ?>
					<div class="box-head">
						<h2 class="left">Current Invoices</h2>
						<div class="right">
							<label>search invoices</label>
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
							<col width="180" />
						   </colgroup>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('photographer_name','Photographer'); ?></th>
						<th><?php echo $this->Paginator->sort('venue_contact_person','Venue'); ?></th>
						<th><?php echo $this->Paginator->sort('price'); ?></th>
						<th><?php echo $this->Paginator->sort('issue_date'); ?></th>
						<th><?php echo $this->Paginator->sort('is_paid','Status'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th class="ac">Content Control</th>
					</tr>
						<?php
						if(!empty($invoices)):
						$num=0;
						foreach ($invoices as $invoice):
						if($num%2==0)
						$class='';
						else
						$class='class="odd"';
					 ?>
					
					<tr <?php echo $class;?>>
					<td><?php echo h($invoice['Invoice']['id']); ?>&nbsp;</td>
					<td><?php echo h($invoice['Invoice']['photographer_name']); ?>&nbsp;</td>
					<td><?php echo h($invoice['Invoice']['venue_contact_person']); ?>&nbsp;</td>
					<td>&pound; <?php echo h($invoice['Invoice']['price']); ?>&nbsp;</td>
					<td><?php echo h(date('d-m-Y',strtotime($invoice['Invoice']['issue_date']))); ?>&nbsp;</td>
					<td><?php echo h(($invoice['Invoice']['is_paid']=='yes')?'Complete':'Pendding'); ?>&nbsp;</td>
					<td><?php echo h(date('d-m-Y',strtotime($invoice['Invoice']['created']))); ?>&nbsp;</td>
					<td>
					
					<?php 
					if($invoice['Invoice']['is_paid']=='no'):
					echo $this->Form->postLink(__('Paid'), array('action' => 'paid', $invoice['Invoice']['id']), array('class'=>'ico edit'), __('Are you sure want to paid this invoice?', $invoice['Invoice']['id']));
					endif;
					 ?>
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
