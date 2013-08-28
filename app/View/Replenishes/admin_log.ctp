<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav">
		<?php
		$this->Html->addCrumb('Replenish');
		echo $this->Html->getCrumbs(' > ','Dashboard');?>
		</div>
		<!-- End Small Nav -->
		
		<?php echo $this->Session->flash(); ?>
		<br />
		<!-- Main -->
			
		<div id="main">
		<!--<a href="<?php echo Router::url('/', true);?>admin/replenishs" class="add-button" style="float:right;"><span>Send Request For Card</span></a><br /><br /><br />-->
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
			
				<!-- Box -->
				<div class="box full">
				
					<!-- Box Head -->
					<?php echo $this->Form->create("Replenish", array('type' => 'get'),array('action' => 'index')); ?>
					<div class="box-head">
						<h2 class="left">Replenish Log</h2>
						<div class="right">
							<label>search replenish</label>
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
                        <col width="110" />
                        <col width="140" />
                        </colgroup>
							<tr>
									<th><?php echo $this->Paginator->sort('id'); ?></th>
									<th><?php echo $this->Paginator->sort('photographer_name','Photographer'); ?></th>
									<th><?php echo $this->Paginator->sort('card','Card'); ?></th>
									<th><?php echo $this->Paginator->sort('created'); ?></th>
							
							</tr>
						<?php
						if(!empty($replenish)):
						$num=0;
						foreach ($replenish as $repl):
						if($num%2==0)
						$class='';
						else
						$class='class="odd"';
						 ?>
							<tr <?php echo $class;?>>
							<td><?php echo h($repl['Replenish']['id']); ?>&nbsp;</td>
							<td><?php echo h($repl['Replenish']['photographer_name']); ?>&nbsp;</td>
							<td><?php echo h($repl['Replenish']['card']); ?>&nbsp;</td>
			
							<td><?php echo h(date('d-m-Y',strtotime($repl['Replenish']['created']))); ?>&nbsp;</td>
							
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
