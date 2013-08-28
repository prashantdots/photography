<div class="shell">
		
		<!-- Small Bread Crumb -->
		<div class="small-nav">
					Dashboard
		</div>
		<!-- End Small Bread Crumb -->
		<!-- Flash messages -->
		<?php echo $this->Session->flash(); ?>
		<!-- End Flash messages -->
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				
				<!-- Box -->
					<div class="box full">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Current job</h2>
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
					
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<thead>
							<colgroup>
							<col width="" />
							<col width="" />
							<col width="" />
							<col width="" />
							<col width="140" />
						   </colgroup>
                            <tr>
								<th width="13">S.No.</th>
								<th>Job No.</th>
								<th>Venue</th>
								<th>Photographer</th>
								<th width="110" class="ac">Content Control</th>
							</tr>
                            </thead>
                            <tbody>
							<?php if(!empty($job)):
							$jobNo=0;
							foreach($job as $current_job):
							
							if($jobNo%2==0)
							$class='';
							else
							$class='class="odd"';
							 $jobNo++;
							?>
							<tr <?php echo $class;?>>
								<td><?php echo $jobNo;?></td>
								<td><?php echo $this->Html->link($current_job['Job']['job_no'], array('controller' => 'jobs', 'action' => 'view', $current_job['Job']['id'])); ?></td>
								<td><?php echo $this->Html->link($current_job['Venue']['name'], array('controller' => 'venues', 'action' => 'view', $current_job['Venue']['id'])); ?></td>
								<td><?php echo $this->Html->link($current_job['Photographer']['fname'].' '.$current_job['Photographer']['lname'], array('controller' => 'photographers', 'action' => 'view', $current_job['Photographer']['id'])); ?></td>
								<td><?php echo $this->Html->link(__('Edit'), array('controller'=>'jobs','action' => 'edit', $current_job['Job']['id']),array('class'=>'ico edit')); ?>
								<?php echo $this->Form->postLink(__('Delete'), array('controller'=>'jobs','action' => 'delete', $current_job['Job']['id']), array('class'=>'ico del'), __('Are you sure want to delete?', $current_job['Job']['id'])); ?></td>
							</tr>
						 <?php 
						
						 endforeach;
						 else:?>
						 <tr>
                         	<td colspan="5">No Record Available</td>
                         </tr>
						 <?php endif;?>							
						</tbody>
                        </table>
					</div>
					<!-- Table -->
				</div>
				<div class="box full">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Current Photographer</h2>
					</div>
					<!-- End Box Head -->
					<!-- Table -->
					<div class="table">
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tbody>
							<colgroup>
							<col width="" />
							<col width="" />
							<col width="" />
							<col width="160" />
							<col width="140" />
						   </colgroup>
							<tr>
								<th>S.No.</th>
								<th>Name</th>
								<th>Email</th>
								<th>Address</th>
								<th class="ac">Content Control</th>
							</tr>
						<?php if(!empty($photographer)):
							$photoNo=0;
							foreach($photographer as $current_photographer):
							
							if($photoNo%2==0)
							$class='';
							else
							$class='class="odd"';
							 $photoNo++;
							?>
							<tr <?php echo $class;?>>
								<td><?php echo $photoNo;?></td>
								<td><h3><?php echo $this->Html->link($current_photographer['Photographer']['name'], array('controller' => 'photographers', 'action' => 'view', $current_photographer['Photographer']['id'])); ?></h3></td>
								<td><?php echo $current_photographer['User']['email'];?></td>
								<td><?php echo $current_photographer['Photographer']['address1'].'<br>'.$current_photographer['Photographer']['address2'].'<br>'.$current_photographer['Photographer']['town'];?></td>
								<td><?php echo $this->Html->link(__('Edit'), array('controller'=>'photographers','action' => 'edit', $current_photographer['Photographer']['id']),array('class'=>'ico edit')); ?>
								<?php echo $this->Form->postLink(__('Delete'), array('controller'=>'photographers','action' => 'delete', $current_photographer['Photographer']['id']), array('class'=>'ico del'), __('Are you sure want to delete?', $current_photographer['Photographer']['id'])); ?></td>
							</tr>
							
					 <?php 
						 endforeach;
						 else:?>	
						 
						 <tr><td colspan="5">No Record Available</td></tr>
						 
						 <?php endif;?>
						</tbody></table>
						
			
						
					</div>
					<!-- Table -->
					
				</div>
				
					<div class="box full">
					<!-- Box Head -->
					<div class="box-head">
						<h2 class="left">Current Venues</h2>
					</div>
					<!-- End Box Head -->	

					<!-- Table -->
					<div class="table">
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tbody>
							<colgroup>
							<col width="" />
							<col width="" />
							<col width="" />
							<col width="160" />
							<col width="140" />
						   </colgroup>
							<tr>
								<th>S.No.</th>
								<th>Name</th>
								<th>Email</th>
								<th>Address</th>
								<th class="ac">Content Control</th>
							</tr>
			<?php if(!empty($venue)):
							$venueNo=0;
							foreach($venue as $current_venue):
							
							if($venueNo%2==0)
							$class='';
							else
							$class='class="odd"';
							 $venueNo++;
							?>
							<tr <?php echo $class;?>>
								<td><?php echo $venueNo;?></td>
								<td><h3><?php echo $this->Html->link($current_venue['Venue']['name'], array('controller' => 'venues', 'action' => 'view', $current_venue['Venue']['id'])); ?></h3></td>
								<td><?php echo $current_venue['User']['email'];?></td>
								<td><?php echo $current_venue['Venue']['address'].'<br>'.$current_venue['Venue']['town'].'<br>'.$current_venue['Venue']['county'];?></td>
								<td><?php echo $this->Html->link(__('Edit'), array('controller'=>'venues','action' => 'edit', $current_venue['Venue']['id']),array('class'=>'ico edit')); ?>
								<?php echo $this->Form->postLink(__('Delete'), array('controller'=>'venues','action' => 'delete', $current_venue['Venue']['id']), array('class'=>'ico del'), __('Are you sure want to delete?', $current_venue['Venue']['id'])); ?></td>
							</tr>
										
					 <?php 
						 endforeach;
						 else:?>
						 <tr><td colspan="5">No Record Available</td></tr>
						<?php endif;?>	
						</tbody></table>
						
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