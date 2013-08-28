<!DOCTYPE HTML>
					<html>
					<head><title>Lick list</title>
					</head>
					<body style="margin:0; padding:0; background:#000;">
					<div style="font:10.50pt Helvetica, Arial, sans-serif; background:url(<?php echo Router::url('/', true)?>img/body-bg.jpg) repeat-x center top #000;">
					  <div id="header" style="background:url(<?php echo Router::url('/', true)?>img/header-bg.png) repeat-x left top #303030; color:#fff; overflow:hidden;">
						<div style="width:1000px;padding:0 30px; margin:0 auto;">
						  <div id="logo" style="text-align:center; padding:10px;"><a href="<?php echo Router::url('/', true)?>"><?php echo $this->Html->image('logo.png',array('width'=>272,'height'=>181,'alt'=>'logo'));?></a></div>
						  <div id="address" style="text-align:center; font:10.50pt Helvetica, Arial, sans-serif; padding:0 0 12px;color:white;">Kingswood House, 58 - 64 Baxter Avenue, Southend-on-Sea, Essex SS2 6BG.</div>
						</div>
					  </div>
					  <div id="title" style="background:url(<?php echo Router::url('/', true)?>img/nav-bg.png) repeat-x left bottom #363636; border-top:#585858 solid 2px; color:#fff; font-size:14.5pt; ">
						<div style="width:1000px;padding:30px 30px 24px;margin:0 auto;  background:url(<?php echo Router::url('/', true)?>img/title-bg.png) no-repeat right top;"> CALL SHEET </div>
					  </div>
					  <div id="content" style="color:#fff; font-size:14px; line-height:16px;">
						<div style="width:1000px;padding:10px 30px 0; margin:0 auto; ">
						<div id="data" style="background:#000000; border-radius:3px; padding:20px; border-bottom:#747677 solid 1px; margin-bottom:10px;">
							<table id="data-table" style="color:#ec008c; width:100%;">
							  <colgroup>
							  <col width="65%">
							  <col width="35%">
							  </colgroup>
							 <tr>
								<td>Job Number (to be quoted on all communications):</td>
								<td><?php echo $job['Job']['job_no'];?></td>
							  </tr>
							  <tr>
								<td>Order Date:</td>
								<td><?php echo date("M d Y",strtotime($job['Job']['order_date']));?></td>
							  </tr>
							  <tr>
								<td>Ordered By:</td>
								<td><?php echo $job['Job']['ordered_by'];?></td>
							  </tr>
							 <tr>
								<td>Agreed Fee:</td>
								<td>&pound;<?php echo $job['Job']['agreed_venue_fee'];?></td>
							  </tr>
							   <tr>
								<td>Licklist Commission:</td>
								<td>&pound;<?php echo $job['Job']['licklist_commission'];?></td>
							  </tr>
							   <tr>
								<td>Photographers Net:</td>
								<td>&pound;<?php echo $job['Job']['agreed_photographer_fee'];?></td>
							  </tr>
							</table>
						  </div>
						  <div id="data" class="alt" style="background:#000000; border-radius:3px; padding:20px; border-bottom:#747677 solid 1px; margin-bottom:10px;">
							<table id="data-table" style="color:#fff; width:100%;">
							  <colgroup>
							  <col width="65%">
							  <col width="35%">
							  </colgroup>
							  <tr>
								<td>Principle Photographer: </td>
								<td><?php echo $job['Job']['agreed_photographer_fee'];?></td>
							  </tr>
							   <tr>
								<td>Photographers ID number:</td>
								<td><?php echo $job['Job']['photographer_id'];?></td>
							  </tr>
							  <tr>
								<td>Availability:</td>
								<td><?php echo $job['Job']['photographer_arrival_time'];?>(Confirmed)</td>
							  </tr>
							  <tr>
								<td>Mobile:</td>
								<td><?php echo $job['Job']['photographer_mobile'];?></td>
							  </tr>
							  <tr>
								<td>Email:</td>
								<td><?php echo $job['Job']['photographer_email'];?></td>
							  </tr>
							  <tr>
								<td>Website:</td>
								<td><?php echo $job['Job']['photographer_website'];?></td>
							  </tr>
							
							  <tr>
								<td>Own Vehicle Y/N :</td>
								<td><?php echo $photographer['Photographer']['vehicle'];?></td>
							  </tr>
							  <tr>
								<td>Distance Will Travel:</td>
								<td><?php echo $photographer['Photographer']['distance'];?></td>
							  </tr>
							  <tr>
								<td>Preferred Working Days:</td>
								<td><?php echo ($photographer['Photographer']['preferred_working_days']!='')?implode(',',unserialize($photographer['Photographer']['preferred_working_days'])):'';;?></td>
							  </tr>
							  <tr>
								<td>Photographic Experience:</td>
								<td><?php echo $photographer['Photographer']['experience'];?></td>
							  </tr>
							  <tr>
								<td>Postproduction Experience:</td>
								<td><?php echo $photographer['Photographer']['post_experience'];?></td>
							  </tr>
							   <tr>
								<td>Skill Score:</td>
								<td><?php echo $photographer['Photographer']['skill_score'];?></td>
							  </tr>
							  <tr>
								<td>Total shoots to date:</td>
								<td>N/A</td>
							  </tr>
							  <tr>
								<td>Total earnings to date:</td>
								<td>N/A</td>
							  </tr>
							</table>
						  </div>
						  <div id="data" style="background:#000000; border-radius:3px; padding:20px; border-bottom:#747677 solid 1px; margin-bottom:10px;">
							<table id="data-table" style="color:#ec008c; width:100%;">
							  <colgroup>
							  <col width="65%">
							  <col width="35%">
							  </colgroup>
							  <tr>
								<td>Cover Photographer: </td>
								<td><?php echo $job['Job']['cover_photographer'];?></td>
							  </tr>
							 <tr>
								<td>Availability:</td>
								<td><?php echo $job['Job']['photographer_arrival_time'];?> (Confirmed)</td>
							  </tr>
							  <tr>
								<td>Mobile:</td>
								<td><?php echo $job['Job']['photographer_mobile'];?></td>
							  </tr>
							  <tr>
								<td>Email:</td>
								<td><?php echo $job['Job']['photographer_email'];?></td>
							  </tr>
							  <tr>
								<td>Website:</td>
								<td><?php echo $job['Job']['photographer_website'];?></td>
							  </tr>
							</table>
						  </div>
						  <div id="data" class="alt" style="background:#000000; border-radius:3px; padding:20px; border-bottom:#747677 solid 1px; margin-bottom:10px;">
							<table id="data-table" style="color:#fff; width:100%;">
							  <colgroup>
							  <col width="65%">
							  <col width="35%">
							  </colgroup>
							  <tr>
								<td>Shoot Date:</td>
								<td><?php echo date("M d Y",strtotime($job['Job']['shoot_date']));?></td>
							  </tr>
							  <tr>
								<td>Location / Venue:</td>
								<td><?php echo $venue['Venue']['town'];?></td>
							  </tr>
							  <tr>
								<td>Address:</td>
								<td><?php echo $job['Job']['venue_address'];?></td>
							  </tr>
							  <tr>
								<td>Post Code:</td>
								<td><?php echo $job['Job']['venue_postcode'];?></td>
							  </tr>
							   <tr>
								<td>Venues attended:</td>
								<td><?php echo $job['Job']['venue_contact_person'];?>
							  </tr>
							</table>
						  </div>
						  <div id="data2" style="background:#000000; border-radius:3px; padding:20px; border-bottom:#747677 solid 1px; margin-bottom:10px;">
							<table id="data-table2" style="color:#ec008c; width:100%;">
							  <colgroup>
							  <col width="65%">
							  <col width="35%">
							  </colgroup>
							  <tr>
								<td>Image Upload Req. By:</td>
								<td><?php echo $job['Job']['image_upload_req_by'];?> (day following shoot, via Drop Box)</td>
							  </tr>
							</table>
						  </div>
						  <div id="data3" class="alt" style="background:#000000; border-radius:3px; padding:20px; border-bottom:#747677 solid 1px; margin-bottom:10px;">
							<table id="data-table3" style="color:#fff; width:100%;">
							  <colgroup>
							  <col width="65%">
							  <col width="35%">
							  </colgroup>
							  <tr>
								<td>Photographer Arrival Time:</td>
								<td><?php echo $job['Job']['photographer_arrival_time'];?></td>
							  </tr>
							  <tr>
								<td>Shoot Commences:</td>
								<td><?php echo $job['Job']['shoot_commences'];?></td>
							  </tr>
							  <tr>
								<td>Shoot Concludes:</td>
								<td><?php echo $job['Job']['shoot_concludes'];?></td>
							  </tr>
							  <tr>
								<td>Dress Code:</td>
								<td><?php echo $job['Job']['dress_code'];?></td>
							  </tr>
							</table>
						  </div>
						  <div id="data4" style="background:#000000; border-radius:3px; padding:20px; border-bottom:#747677 solid 1px; margin-bottom:10px;">
							<table id="data-table4" style="color:#ec008c; width:100%;">
							  <colgroup>
							  <col width="65%">
							  <col width="35%">
							  </colgroup>
							  <tr>
								<td>Licklist Representative (attending):</td>
								<td><?php echo $job['Job']['personal_licklist_contact'];?></td>
							  </tr>
							  <tr>
								<td>Mobile:</td>
								<td><?php echo $job['Job']['mobile1'];?></td>
							  </tr>
							  <tr>
								<td>Special Instructions / Additional Shots:</td>
								<td>N/A</td>
							  </tr>
							</table>
						  </div>
						  <div id="data5" class="alt" style="background:#000000; border-radius:3px; padding:20px; border-bottom:#747677 solid 1px; margin-bottom:10px;">
							<table id="data-table5" style="color:#fff; width:100%;">
							  <colgroup>
							  <col width="65%">
							  <col width="35%">
							  </colgroup>
							  <tr>
								<td>Contact (if no Licklist Representative attending):</td>
								<td><?php echo $job['Job']['venue_contact_person'];?></td>
							  </tr>
							  <tr>
								<td>Mobile:</td>
								<td><?php echo $job['Job']['venue_mobile'];?></td>
							  </tr>
							  <tr>
								<td>Special Instructions / Additional Shots:</td>
								<td>N/A.</td>
							  </tr>
							</table>
						  </div>
						  <div id="data7" style="background:#000000; border-radius:3px; padding:20px; border-bottom:#747677 solid 1px; margin-bottom:10px;">
							<table id="data-table7" style="color:#ec008c; width:100%;">
							  <colgroup>
							  <col width="65%">
							  <col width="35%">
							  </colgroup>
							  <tr>
								<td>Licklist Emergency Contact:</td>
								<td>Ben Jennings</td>
							  </tr>
							  <tr>
								<td>Mobile:</td>
								<td>07703-472-1910</td>
							  </tr>
							  <tr>
								<td>Email:</td>
								<td>N/A</td>
							  </tr>
							</table>
						  </div>
					  </div>
					  <div id="title" style="background:url(<?php echo Router::url('/', true)?>img/nav-bg.png) repeat-x left bottom #363636;border-top:#585858 solid 2px;   color:#fff; font-size:14.5pt; ">
						<div style="width:1000px;padding:30px 30px 24px;margin:0 auto;background:url(<?php echo Router::url('/', true)?>img/title-bg.png) no-repeat right top;">BRIEF/SPECIAL INSTRUCTIONS:</div>
					  </div>
					  	  <div id="footer" style="color:#fff; font-size:14px; line-height:25px;">
						<div style="background-color:#000000;width:1000px;padding:10px 30px 0; margin:0 auto;">
						  <p><i>Special instructions / requirements as below. Should no brief follow, requirements are as stated in the Licklist Photography Handbook.<br><a style="color:#0066FF;" href="www.licklist.co.uk/photography_handbook">(www.licklist.co.uk/photography_handbook)</a></i></p>
						</div>
					  </div>	
						
					  <div id="footer" style="color:#fff; font-size:14px; line-height:25px;">
						<div style="background-color:#000000;width:1000px;padding:10px 30px 0; margin:0 auto;">
						<b>Dear <?php echo $job['Job']['photographer_name'];?>,</b>
						<blockquote>
						<p><?php echo $job['Job']['message'];?></p>
						</blockquote>
						<p><b>Regards &shy; Ben J,</b></p>
						</div>
					  </div>
					  <div style="clear:both;"></div>	
					  <div id="footer" style="color:#fff; font-size:14px; line-height:25px;">
						<div style="background-color:#000000;width:1000px;padding:10px 30px 0; margin:0 auto;">
						<b>NOTES:</b>
						<ol>
							<li>You are required to photograph venue(s) & supply resulting material following specific instructions stated in the Licklist Photography Handbook: <a style="color:#0066FF;" href="www.licklist.co.uk/photography_handbook">(www.licklist.co.uk/photography_handbook)</a> See section 06: Who & what do I photograph.</li>
							<li>Contrary to the Handbook you are not required to SMS Ben Jennings on arrival & departure.</li>
							<li>All venues are secured & know you are coming. Do not allow poorly informed door staff to refuse your entry. Should entry be refused telephone your Emergency Licklist Contact immediately  (& before leaving the vicinity). </li>
							<li>Should you run out of Tag Yourself Cards please advise Hollie Ratcliife (hollie@liclisklist.co.uk) & we shall replenish. Tag cards are shipped via royal mail (allow a minimum of 72 hours from order request to receipt). It is your sole responsibly to ensure you have (& liberally distribute) tag cards. You should ALWAYS retain & carry a minimum of 100x tag cards.  </li>
							<li>Contrary to the Handbook you are NOT required to supply hi-res images on DVD. You are to supply low-res by upload only. However, please retain hi-res fro a minimum of 4 months following each session as (on occasion) we may request such. </li>
							<li>We are experiencing difficulty with direct uploads to the network. Until further notice you are to upload completed assignments to specified drop-boxes (links furnished by email). Every assignment is allocated a unique Job Number. Ensure you upload to correctly referenced drop-boxes only.</li>
							<li>You may issue billing only on assignment completion. Please do via email to: <a style="color:#0066FF;" href="brad@licklist.co.uk">(brad@licklist.co.uk)</a> All invoices are paid within 3 working days of receipt. Payment is via BACS only. Ensure you quote your bank sort code & account number. </li>
							<li>Should you be running late / unable to attend or encounter any difficulty you are to contact telephone your Licklist Emergency Contact immediately (by telephone).</li>
							<li>Optional bookings are to be deemed confirmed & live ONLY on receipt of formal instructions & following the issue of an official  call sheet / job number. You are not to attend any Licklist venue (in a professional capacity) unless expressly instructed. Licklist reserve the right to cancel any booking / optional booking without notice & without charge.</li>
							<li>You accept this assignment on the clear understanding that you have read, agree to & will abide by Licklist’s Terms and Conditions of Business & Supply <a style="color:#0066FF;" href="www.licklist.co.uk/photography_terms">(www.licklist.co.uk/photography_terms)</a> & all such stipulations as outlined within & attached</li>
								
						</ol>
						<ul>
						<li>You confirm that you understand all instructions & requirements (as stated in the Licklist Photography Handbook) & such special requirements as may be stated within.</li>
						<li>You confirm that you are able to execute this assignment to the required standard (as illustrated in the Licklist Photographers Gallery: <a style="color:#0066FF;" href="www.licklist.co.uk/photography_samples">(www.licklist.co.uk/photography_samples)</a> & are able to “shoot to match” the strongest images.</li>
						<li>You are to advise if any "ad hoc" overtime is requested by the client (Licklist shall raise retrospective billing for all). You remain in the employment of Licklist at all times & may not solicit work directly from any Licklist client. Licklist shall retain all copyright & ownership of all resulting images at all times (including the right to 3rd party resale).</li>
						</ul><br />
						Should you have any questions, queries or reservations do not hesitate to contact us.<br />
						<b>Enjoy the shoot! Kindest Regards....</b><br /><br />
							<?php echo $this->Html->image('signature.png',array('width'=>90,'height'=>70,'alt'=>'signature'));?>
<br />
						Ben Jennings (Photography Manager).
						
						</div>
					  </div>
					</div>
					</body>
					</html>