<?php
App::uses('AppController', 'Controller');
/**
 * Photographer Controller
 *
 * @property Photographer $Photographer
 *
 * Developed By:Vijender Singh Rana
 *
 * Date:11 July 2013
 */
class MapsController extends AppController {

var $uses		= array( 'Venue','Photographer');


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
	
		$locationArr=array();
		
		$venueList=$this->Venue->find('all',array('fields'=>array('Venue.name','Venue.mobile','Venue.address','Venue.town','Venue.county','Venue.postcode')));	
		
		
		$i=0;
		foreach($venueList as $venue){
		
		$locationArr[$i]['name']=$venue['Venue']['name'];
		$locationArr[$i]['address']=$venue['Venue']['address'].','.$venue['Venue']['town'].','.$venue['Venue']['county'].','.$venue['Venue']['postcode'];
		$locationArr[$i]['mobile']=$venue['Venue']['mobile'];
		$locationArr[$i]['type']='Venue';
	
		
		$prepAddr = str_replace(' ','+',$locationArr[$i]['address']);
 		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
		$output= json_decode($geocode);
		
		$locationArr[$i]['lat']=$output->results[0]->geometry->location->lat;
		$locationArr[$i]['long']=$output->results[0]->geometry->location->lng;
	
		$i++;
		}
		
		
		$photographerList=$this->Photographer->find('all',array('fields'=>array('Photographer.name','Photographer.address1','Photographer.address2','Photographer.town','Photographer.county','Photographer.postcode','Photographer.mobile')));	
		
		foreach($photographerList as $photographer){
		
		$locationArr[$i]['name']=$photographer['Photographer']['name'];
		$locationArr[$i]['address']=$photographer['Photographer']['address1'].','.$photographer['Photographer']['address2'].','.$photographer['Photographer']['town'].','.$photographer['Photographer']['county'].','.$photographer['Photographer']['postcode'];
		$locationArr[$i]['mobile']=$photographer['Photographer']['mobile'];
		$locationArr[$i]['type']='Photographer';
		
		$prepAddr = str_replace(' ','+',$locationArr[$i]['address']);
 		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
		$output= json_decode($geocode);
		
		$locationArr[$i]['lat']=$output->results[0]->geometry->location->lat;
		$locationArr[$i]['long']=$output->results[0]->geometry->location->lng;
		
	
		$i++;
		}
		
		//pr($locationArr);die;
		$this->set(compact('locationArr'));
		
	}




	
	
}
