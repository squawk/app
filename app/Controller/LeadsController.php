<?php
App::uses('AppController', 'Controller');
/**
 * Leads Controller
 *
 * @property Leads $Leads
 */
class LeadsController extends AppController {

	public function admin_index($search = null) {
		if (!empty($this->request->data['Lead']['search'])) {
			$this->redirect(array($this->request->data['Lead']['search']));
		} elseif(!empty($search)) {
			$conditions = array('or' => array('Lead.name LIKE' => '%' . $search . '%', 'Lead.email LIKE' => '%' . $search . '%', 'Lead.phone LIKE' => '%' . $search . '%', 'Lead.status LIKE' => '%' . $search . '%'));
		} else {
			$conditions = array();
		}

		$this->paginate = array('conditions' => $conditions, 'limit' => 50, 'order' => array('Lead.created' => 'desc'), 'contain' => false);
		$this->set('leads', $this->paginate());

		$this->set('search', $search);
	}

	public function admin_view($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid lead'));
		}

		$lead = $this->Lead->findById($id);

		if (!$lead) {
			throw new NotFoundException(__('Invalid lead'));
		}

		if ($this->request->is('post')) {
			$this->request->data['Lead']['id'] = $id;

			$this->Lead->save($this->request->data);
			$this->Session->setFlash(__('The status was updated successfully.'));
			$this->redirect(array($id));
		}

		$this->set('lead', $lead);
	}

	public function admin_delete($id = null, $noReferer = false) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if (!$id) {
			throw new NotFoundException(__('Invalid lead'));
		}

		if ($this->Lead->delete($id)) {
			$this->Session->setFlash(__('The lead was deleted successfully.'));
		} else {
			$this->Session->setFlash(__('There was a problem deleting this lead.'), 'error');
		}

		if ($noReferer == true) {
			$this->redirect(array('action' => 'index'));
		} else {
			$this->redirect($this->referer(array('action' => 'index')));
		}
	}
}