<?php
App::uses('AppController', 'Controller');
/**
 * Pages Controller
 *
 * @property Pages $Pages
 */
class PagesController extends AppController {
	public $helpers = array('Ck');

	public function beforeFilter(){
		parent::beforeFilter();

		if (!empty($this->Auth)) {
			$this->Auth->allow('display', 'ckeditor');
		}
	}

	public function display($slug = null) {
		$page = $this->Page->get($slug);

		if (!empty($page['Page']['view']) && $this->request->is('post')) {
			try {
				$this->loadModel('Lead');
				$this->Lead->saveLead($this->request->data, $page['Page']['view']);

				$this->Session->setFlash(__('Thank you for contacting us, we will be in touch with you shortly regarding your query.'));

				if (!empty($page['Page']['post_route'])) {
					return $this->redirect($page['Page']['post_route']);
				}
				return $this->redirect($this->referer(array('action'=>'display', $slug)));
			} catch (Exception $e) {
				$this->Session->setFlash($e->getMessage(), 'error');
			}
		}

		$this->set('page', $page);

		$this->set('title_for_layout', $page['Page']['meta_title']);
		if (!empty($page['Page']['meta_description'])) {
			$this->set('metaDescription', $page['Page']['meta_description']);
		}
		if (!empty($page['Page']['meta_keywords'])) {
			$this->set('metaKeywords', $page['Page']['meta_keywords']);
		}
		if (!empty($page['Page']['view'])) {
			$this->render($page['Page']['view']);
		}
	}

/**
 * A dynamic config file for CK Editor
 * @return void
 */
	public function ckeditor() {
		$this->layout = false;
	}

	public function admin_index($parentId = null, $search = null) {
		if(!empty($this->request->data['Page']['search'])) {
			$this->redirect(array(0, $this->request->data['Page']['search']));
		}

		$conditions = array();

		if (!empty($search)) {
			$conditions['or'] = array('Page.name LIKE' => '%'.$search.'%', 'Page.meta_title LIKE' => '%'.$search.'%', 'Page.slug LIKE' => '%'.$search.'%', 'Page.content LIKE' => '%'.$search.'%');
		} else {
			$conditions['parent_id'] = $parentId;
		}

		if ($parentId) {
			$this->Page->contain();
			$parent = $this->Page->findById($parentId, 'name');
			if(empty($parent)) {
				throw new NotFoundException(__('Invalid page'));
			}

			$parents = $this->Page->getPath($parentId, array('id', 'name'));
			$this->set(compact('parent', 'parents'));
		}

		//if (Configure::read('Content.topMenu')) {
			$this->set('topPages', $this->Page->find('all', array('conditions' => array('top_show' => true, 'element' => false, $conditions), 'order' => array('top_order' => 'asc'), 'contain' => false)));
		//}
		//if (Configure::read('Content.bottomMenu')) {
			$this->set('bottomPages', $this->Page->find('all', array('conditions' => array('bottom_show' => true, 'element' => false, $conditions), 'order' => array('bottom_order' => 'asc'), 'contain' => false)));
		//}
		$this->set('staticPages', $this->Page->find('all', array('conditions' => array('top_show' => false, 'bottom_show' => false, 'element' => false, $conditions), 'order' => array('Page.name' => 'asc'), 'contain' => false)));

		$this->set('parent_id', $parentId);
		$this->set('search', $search);
	}

	public function admin_add($parentId = null, $duplicateId = null) {
		if ($this->request->is('post')) {
			$this->Page->create();
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been added successfully.'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('There was a problem adding the page, please review the errors below and try again.'), 'error');
			}
		} elseif ($duplicateId) {
			$this->request->data = $this->Page->getCopy($duplicateId);
		} else {
			$this->request->data['Page']['parent_id'] = $parentId;
		}

		$this->set('pages', $this->Page->generateTreeList(array('Page.element' => false), null, '{n}.Page.name', '-> '));
	}

	public function admin_edit($id = null, $revision = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid page'));
		}

		$this->Page->contain();
		$page = $this->Page->findById($id);
		if (!$page) {
			throw new NotFoundException(__('Invalid page'));
		}

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Page->save($this->request->data)) {
				$this->Session->setFlash(__('The page has been updated successfully.'));
			} else {
				$this->Session->setFlash(__('There was a problem saving the page, please review the errors below and try again.'), 'error');
			}
			$this->redirect(array('action'=>'index'));
		} else {
			$this->request->data = $page;

			if ($revision) {
				$this->request->data['Page'] = $this->Page->Revision->get($revision, $this->request->data['Page']);
			}
		}

		$this->set('page', $page);

		$this->set('pages', $this->Page->generateTreeList(array('Page.element' => false), null, '{n}.Page.name', '-> '));
	}

	public function admin_save($position = 'top') {
		$this->layout = false;
		$message = '';

		if (!empty($_POST)) {
			$data = $_POST;

			foreach ($data['page'] as $order => $id) {
				// lets get the old modified date to ensure that it isn't updated
				$page = $this->Page->findById($id, array('id', 'modified'));

				if (!empty($page)) {
					$page['Page'][$position . '_show']  = 1;
					$page['Page'][$position . '_order'] = $order;

					$this->Page->save($page);
				}
			}

			$message = __('The ordering has been saved successfully.');
		}

		$this->set('message', $message);
	}

	public function admin_reorder() {
		$this->Page->reorder();

		$this->Session->setFlash(__('The pages were reordered successfully.'));
		$this->redirect($this->referer(array('action'=>'index')));
	}

	public function admin_recover() {
		$this->Page->recover('parent');

		$this->Session->setFlash(__('The pages were recovered successfully.'));
		$this->redirect(array('action'=>'index'));
	}

	public function admin_delete($id = null) {
		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if (!$id) {
			throw new NotFoundException(__('Invalid page'));
		}

		$page = $this->Page->findById($id, 'id');

		if (!$page) {
			throw new NotFoundException(__('Invalid page'));
		}

		if ($this->Page->delete($id)) {
			$this->Session->setFlash(__('The page was successfully deleted.'));
		} else {
			$this->Session->setFlash(__('There was a problem deleting this page.'), 'error');
		}

		$this->redirect(array('action' => 'index'));
	}
}