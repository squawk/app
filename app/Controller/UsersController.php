<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property Users $Users
 */
class UsersController extends AppController {

	public function beforeFilter(){
		parent::beforeFilter();

		if (!empty($this->Auth)) {
			$this->Auth->allow('admin_login', 'admin_reset', 'admin_install');
		}
	}

	public function admin_login() {
		$this->layout = false;

		if ($this->Auth->user('id')) {
			$this->redirect(array('admin' => true, 'action' => 'home'));
		}

		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				//$this->Cookie->write('User.id', true, '+6 hours');
				$this->Session->setFlash(__('You have been successfully logged in.'));
				$this->redirect(array('action' => 'home'));
			} else {
				$this->Session->setFlash(__('The login details you entered are incorrect. Please try again.'), 'error');
			}
		}

		$this->set('title_for_layout', __('Login'));
	}

	public function admin_install() {
		if ($this->Auth->user('id')) {
			$this->redirect(array('action' => 'home'));
		}

		if ($this->User->hasAny()) {
			$this->redirect(array('action' => 'login'));
		}

		if ($this->request->is('post')) {
			try {
				$this->User->install($this->request->data);

				if ($this->Auth->login()) {
					// lets set a cookie for the KC finder plugin - used to check a valid user
					//$this->Cookie->write('User.id', $this->Auth->user('id'), true, '+6 hours');

					$this->Session->setFlash(__('Coderity has been successfully installed and you have been automatically logged in!'));
					$this->redirect(array('action' => 'home'));
				} else {
					$this->Session->setFlash(__('Coderity has been successfully installed, please login below.'));
					$this->redirect(array('action' => 'login'));
				}
			} catch (Exception $e) {
				$this->Session->setFlash($e->getMessage(), 'error');
			}
		}

		$this->set('title_for_layout', __('Install'));
	}

	public function admin_logout() {
		$this->Session->setFlash(__('You have been logged out successfully.'));
		$this->redirect($this->Auth->logout());
	}

	public function admin_reset(){
		$this->layout = false;

		if ($this->request->is('post')) {
			try {
				$this->User->reset($this->request->data);

				$this->Session->setFlash(__('Please check your account. An email containing your account details has been sent to you.'));
				$this->redirect(array('action'=>'login'));
			} catch (Exception $e) {
				$this->Session->setFlash($e->getMessage(), 'error');
			}
		}

		$this->set('title_for_layout', __('Reset your Password'));
	}

	public function admin_home() {
		$this->loadModel('Setting');
		$siteName  		  = $this->Setting->get('siteName');
		$siteEmail 		  = $this->Setting->get('siteEmail');
		$title_for_layout = __('Dashboard');

		$this->set(compact('siteName', 'siteEmail', 'title_for_layout'));
	}

	public function admin_index($search = null) {
		$conditions = array();

		if (!empty($this->request->data)) {
			$this->redirect(array($this->request->data['User']['search']));
		} elseif(!empty($search)) {
			$conditions['or'] = array('User.first_name LIKE' => '%' . $search . '%', 'User.last_name LIKE' => '%' . $search . '%', 'User.email LIKE' => '%' . $search . '%', 'User.username LIKE' => '%' . $search . '%');
		}

		$this->paginate = array('conditions' => $conditions, 'limit' => 50, 'order' => array('User.last_name' => 'asc'), 'contain' => false);
		$this->set('users', $this->paginate());

		$this->set('search', $search);
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('There user has been created successfully.'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('There was a problem creating the user, please review the errors below and try again.'), 'error');
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid user'));
		}

		$this->User->contain();
		$user = $this->User->findById($id);
		if (!$user) {
			throw new NotFoundException(__('Invalid user'));
		}

		if ($this->request->is(array('put', 'post'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been updated successfully.'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('There was a problem updating the users details, please review the errors below and try again.'), 'error');
			}
		} else {
			$this->request->data = $user;
		}
	}

	public function admin_password() {
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['User']['id'] = $this->Auth->user('id');
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Your password has been changed successfully.'));
				return $this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('Unfortunately there was a problem.  Please correct the errors below.'), 'error');
			}
		}

		$this->set('title_for_layout', __('Change Password'));
	}

	public function admin_delete($id = null) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		$user = $this->User->findById($id);
		if(!$user) {
			throw new NotFoundException(__('Invalid user'));
		}

		if ($user['User']['id'] == $this->Auth->user('id')){
			throw new NotFoundException(__('You cannot delete your own user'));
		}

		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('The user was deleted successfully.'));
		} else {
			$this->Session->setFlash(__('There was a problem deleting this user.'), 'error');
		}

		$this->redirect($this->referer(array('action' => 'index')));
	}
}