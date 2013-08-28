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
			
				<!-- Box -->
				<div class="box full">
				
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Current Setting</h2>
						
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
									<th><?php echo $this->Paginator->sort('id'); ?></th>
									<th><?php echo $this->Paginator->sort('email'); ?></th>
									<th><?php echo $this->Paginator->sort('email1','Email1'); ?></th>
									<th><?php echo $this->Paginator->sort('email2','Email2'); ?></th>
									<th><?php echo $this->Paginator->sort('mobile','Mobile'); ?></th>
									<th><?php echo $this->Paginator->sort('mobile1','Mobile1'); ?></th>
									<th><?php echo $this->Paginator->sort('mobile2','Mobile2'); ?></th>
									<th><?php echo $this->Paginator->sort('watermark_image','Watermark'); ?></th>
									<th><?php echo $this->Paginator->sort('created'); ?></th>
							
								<th width="110" class="ac">Content Control</th>
							</tr>
						<?php
	$num=0;
	foreach ($settings as $admin_setting):
	if($num%2==0)
	$class='';
	else
	$class='class="odd"';
	 ?>
							<tr <?php echo $class;?>>
								<td><?php echo h($admin_setting['Setting']['id']); ?>&nbsp;</td>
								<td><?php echo h($admin_setting['Setting']['email']); ?>&nbsp;</td>
								<td><?php echo h($admin_setting['Setting']['email1']); ?>&nbsp;</td>
								<td><?php echo h($admin_setting['Setting']['email2']); ?>&nbsp;</td>
								<td><?php echo h($admin_setting['Setting']['mobile']); ?>&nbsp;</td>
								<td><?php echo h($admin_setting['Setting']['mobile1']); ?>&nbsp;</td>
								<td><?php echo h($admin_setting['Setting']['mobile2']); ?>&nbsp;</td>
								<td><img src="<?php echo $this->webroot.'uploads/watermark-admin/60x60/admin_watermark.png';?>" height="50" width="50" class="gallery_image" />&nbsp;</td>
								<td><?php echo h(date('d-m-Y',strtotime($admin_setting['Setting']['created']))); ?>&nbsp;</td>
								
								<td class="actions">
										<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $admin_setting['Setting']['id']),array('class'=>'ico edit')); ?>
										
										
										
								</td>
							</tr>
					<?php 
					$num++;
					endforeach; ?>		
						
						
						</table>
	
						
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
