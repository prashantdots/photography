<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script type="text/javascript">
	function getLocation()
	  {
	  if (navigator.geolocation)
		{
		navigator.geolocation.getCurrentPosition(showPosition);
		}
	   else{x.innerHTML="Geolocation is not supported by this browser.";}
	  }
	function showPosition(position)
	  {
	     var Lat = position.coords.latitude;
	     var Lon = position.coords.longitude;
		 
		 //for local testing
		// var Lat=51.519897;
		 //var Lon=-0.1312515; 
		
		 $('#lat').val(Lat);
		 $('#lon').val(Lon);
		 
			 var locations = new Array();
			 //locations[0] = ['test',Lat,Long];
			 
			 <?php
			 $i=0;
			 foreach($locationArr as $location){ ?>
			 
		     locations[<?php echo $i;?>] = ['<?php echo $location['name'];?>'+'<br/>'+'<?php echo $location['address'];?>'+'<br/>'+'<?php echo $location['mobile'];?>',<?php echo $location['lat'];?>,<?php echo $location['long'];?>,'<?php echo $location['type'];?>'];
			 
			 
			 <?php 
			 $i++;
			 } 
			 ?>
					
					var map = new google.maps.Map(document.getElementById('map'), {
					  zoom: 12,
					  center: new google.maps.LatLng(Lat, Lon),
					  mapTypeId: google.maps.MapTypeId.ROADMAP
					});
					var infowindow = new google.maps.InfoWindow();
					var marker, i;
					for (i = 0; i < locations.length; i++) {  
					  if(locations[i][3]=='Photographer'){
					  	marker = new google.maps.Marker({
						icon:'<?php echo Router::url('/', true).'img/icon-landmark.png';?>',
						position: new google.maps.LatLng(locations[i][1], locations[i][2]),
						map: map
					  });
					  }else{
					 	 marker = new google.maps.Marker({
						position: new google.maps.LatLng(locations[i][1], locations[i][2]),
						map: map
					  });
					  }
					  google.maps.event.addListener(marker, 'click', (function(marker, i) {
						return function() {
						  infowindow.setContent(locations[i][0]);
						 // popup(this,locations[i][0]);
						 infowindow.open(map, marker);
						}
					  })(marker, i));
					}	
					
					  // End of success function of ajax form
						 
	  }
	  

 function popup(location) { 
   setTimeout(function () { 
	   $("#map_info_popup").css({"left":"25px"});
	  $("#map_info_popup #result").html(location);	  
	  return false;
      var newwindow = window.open('hello','Test','width=800,height=500');
      newwindow.focus();
   }, 1);
   return false;
} 
	
getLocation();
</script>
<div class="shell">
  <!-- Small Nav -->
  <div class="small-nav">
    <?php
		$this->Html->addCrumb('Photographer', array('admin'=>true,'controller'=>'photographers','action'=>'index'));
		$this->Html->addCrumb('View Map');
		echo $this->Html->getCrumbs('  > ','Dashboard');?>
  </div>
  <!-- End Small Nav -->
  <?php echo $this->Session->flash(); ?> <br />
  <!-- Main -->
  <div id="main">
    <div class="cl">&nbsp;</div>
    <!-- Content -->
    <div id="content">
<div id="map" style="width:100%; height: 750px;"></div>
    </div>
    <!-- End Content -->
    <div class="cl">&nbsp;</div>
  </div>
  <!-- Main -->
</div>