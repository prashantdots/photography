<div class="shell">
		
		<!-- Small Nav -->
		<div class="small-nav">
		<?php
		$this->Html->addCrumb('High Resolution Requests');
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
					<div class="box-head">
						<h2 class="left">Resolutions Requests</h2>
				
					</div>
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
									<th><?php echo $this->Paginator->sort('GalleryImage.image','Image'); ?></th>
									<th><?php echo $this->Paginator->sort('created'); ?></th>
							
								<th width="110" class="ac">Content Control</th>
							</tr>
						<?php
						if(!empty($requestDetails)):
						$num=0;
						foreach ($requestDetails as $resolutions):
						if($num%2==0)
						$class='';
						else
						$class='class="odd"';
						 ?>
							<tr <?php echo $class;?>>
							<td><?php echo h($resolutions['HighResolutionRequest']['id']); ?>&nbsp;</td>
							<td><?php echo h($resolutions['GalleryImage']['image']); ?>&nbsp;</td>
							<td><?php echo h(date('d-m-Y',strtotime($resolutions['HighResolutionRequest']['created']))); ?>&nbsp;</td>
							<td class="actions">
									<?php echo $this->Html->link(__('Upload'), array('action' => 'uploadHighResolutionImage', $resolutions['HighResolutionRequest']['id']),array('class'=>'ico edit')); ?>
									
							</td>
							</tr>
					<?php 
					$num++;
					endforeach; 
					else:
					?>		
					<tr><td colspan="4">No Record Available</td></tr>	
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
