<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
//...

    public $components = array(
        'Session',
         'Auth' => array(
        'loginRedirect' => array('controller' => 'dashboards', 'action' => 'index'),
        'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
        'authorize' => array('Controller') // Added this line
    	)
    );
	
	public function isAuthorized($user) {
    // Admin can access every action
		
	   if (isset($user['role']) && ($user['role'] === 'admin' || $user['role'] === 'photographer' || $user['role'] === 'venue')) {
		
		if($user['role']=='photographer'){
	
		 $this->loadModel('Photographer');
		
		$photoDetails=$this->Photographer->find('first',array('fields'=>array('Photographer.id'),'conditions'=>array('Photographer.user_id'=>$user['id'])));
				
		$this->Session->write('Auth.User.photographer_id',$photoDetails['Photographer']['id']);
		
		}else if($user['role']=='venue'){
	
		 $this->loadModel('Venue');
		
		 $venueDetails=$this->Venue->find('first',array('fields'=>array('Venue.id'),'conditions'=>array('Venue.user_id'=>$user['id'])));
				
		 $this->Session->write('Auth.User.venue_id',$venueDetails['Venue']['id']);
		
		}
	   
        return true;
       }

		// Default deny
		return false;
	}

    public function beforeFilter() {
       // $this->Auth->allow('index', 'view');
		$this->set('authUser', $this->Auth->user());
    }
    //...
	
	public function _mail($to='',$subject='',$message='',$file='') {
		
		App::import('Vendor', 'ClassPhpmailer', array('file' => 'class.phpmailer.php'));
		
		$mail			= new PHPMailer;
		
		$mail->From		= 'admin@photography.com';
		
		$mail->FromName = 'Admin';
		
		$mail->AddAddress($to);               // Name is optional
		
		if($file!='')
		$mail->addAttachment($file,'call-sheet');
		
		//$mail->AddReplyTo($mail_settings['Setting']['admin_email_id'], 'Admin');
		
		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
		
		$mail->IsHTML(true);                                  // Set email format to HTML

		$mail->Subject = $subject;
		
		$mail->Body    = $message;

		
		$mail->Send();
		
		
		
	}

}
