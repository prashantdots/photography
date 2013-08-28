<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {


public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('admin_add'); // Letting users register themselves
}	
	

public function admin_login() {
		if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			}

		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Session->setFlash(__('Successfully Logged In'),'flash_custom_success');
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'),'flash_custom_error');
			}
		}
	}
	
	public function admin_logout() {
		$this->Session->setFlash(__('Successfully Logged Out'),'flash_custom_success');
		$this->redirect($this->Auth->logout());
	}
	
public function isAuthorized($user) {
    // All registered users can add posts
    if ($this->action === 'add') {
        return true;
    }

    // The owner of a post can edit and delete it
    if (in_array($this->action, array('edit', 'delete'))) {
        $postId = $this->request->params['pass'][0];
        if ($this->Post->isOwnedBy($postId, $user['id'])) {
            return true;
        }
    }

    return parent::isAuthorized($user);
	}	
}
