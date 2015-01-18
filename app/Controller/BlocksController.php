<?php
App::uses('AppController', 'Controller');
/**
 * Blocks Controller
 *
 * @property Block $Block
 */
class BlocksController extends AppController {

	public $helpers = array('Ck');

	public $order = 'Block.name';

	public function beforeFilter(){
		parent::beforeFilter();

		if (!empty($this->Auth)) {
			$this->Auth->allow('get');
		}
	}

	public function get($slug = null) {
		return $this->Block->get($slug);
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($search = null) {
		$conditions = array();

		if ($this->request->is('post')) {
			$this->redirect(array('action' => 'index', $this->request->data['Block']['search']));
		} elseif (!empty($search)) {
			$conditions['or'] = array('Block.name LIKE' => '%' . $search . '%', 'Block.content LIKE' => '%' . $search . '%');
		}

		$this->paginate = array('conditions' => $conditions, 'limit' => 50, 'order' => $this->order, 'contain' => false);
		$this->set('blocks', $this->paginate());

		$this->set('search', $search);
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Block->create();
			if ($this->Block->save($this->request->data)) {
				$this->Session->setFlash(__('The content block has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The content block could not be saved. Please, try again.'), 'error');
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null, $revision = null) {
		if (!$this->Block->exists($id)) {
			throw new NotFoundException(__('Invalid content block'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Block->save($this->request->data)) {
				$this->Session->setFlash(__('The content block has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The content block could not be saved. Please, try again.'), 'error');
			}
		} else {
			$options = array('conditions' => array('Block.' . $this->Block->primaryKey => $id), 'contain' => false);
			$this->request->data = $this->Block->find('first', $options);

			if ($revision) {
				$this->request->data['Block'] = $this->Block->Revision->get($revision, $this->request->data['Block']);
			}
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Block->id = $id;
		if (!$this->Block->exists()) {
			throw new NotFoundException(__('Invalid content block'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Block->delete()) {
			$this->Session->setFlash(__('The content block has been deleted.'));
		} else {
			$this->Session->setFlash(__('The content block could not be deleted. Please, try again.'), 'error');
		}
		return $this->redirect(array('action' => 'index'));
	}
}