<?php
App::uses('CoderityAppController', 'Coderity.Controller');
/**
 * Redirects Controller
 *
 * @property Redirects $Redirects
 */
class RedirectsController extends CoderityAppController {

	public function admin_index($search = null) {
		$conditions = array();

		if (!empty($this->request->data)) {
			$this->redirect(array($this->request->data['Redirect']['search']));
		} elseif(!empty($search)) {
			$conditions['or'] = array('Redirect.url LIKE' => '%' . $search . '%', 'Redirect.redirect LIKE' => '%' . $search . '%');
		}

		$this->paginate = array('conditions' => $conditions, 'limit' => 50, 'order' => array('Redirect.url' => 'asc'), 'contain' => false);
		$this->set('redirects', $this->paginate());

		$this->set('search', $search);
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Redirect->create();
			if ($this->Redirect->saveMultiple($this->request->data)) {
				$this->Session->setFlash(__('The redirect(s) has been created successfully.'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('There was a problem creating the redirect, please review the errors below and try again.'), 'error');
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid redirect'));
		}

		$this->Redirect->contain();
		$redirect = $this->Redirect->findById($id);
		if (!$redirect) {
			throw new NotFoundException(__('Invalid redirect'));
		}

		if ($this->request->is(array('put', 'post'))) {
			if ($this->Redirect->save($this->request->data)) {
				$this->Session->setFlash(__('The redirect has been updated successfully.'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('There was a problem updating the redirect, please review the errors below and try again.'), 'error');
			}
		} else {
			$this->request->data = $redirect;
		}
	}

	public function admin_delete($id = null) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		$redirect = $this->Redirect->findById($id);
		if (!$redirect) {
			throw new NotFoundException(__('Invalid user'));
		}

		if ($this->Redirect->delete($id)) {
			$this->Session->setFlash(__('The redirect was deleted successfully.'));
		} else {
			$this->Session->setFlash(__('There was a problem deleting this redirect.'), 'error');
		}

		$this->redirect($this->referer(array('action' => 'index')));
	}
}