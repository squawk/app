<?php
App::uses('AppController', 'Controller');
/**
 * App Controller
 *
 * @property App $App
 */
class AppController extends Controller {

	public $components = array('Cookie', 'RequestHandler', 'Session', 'Paginator',
								'Auth' => array(
									'authorize'     => array('Controller'),
									'loginRedirect' => array('controller' => 'users', 'action' =>'home', 'admin' => true),
									'loginAction'   => array('controller' => 'users', 'action' =>'login', 'admin' => true),
									'authenticate' => array('Form' => array('passwordHasher' => 'Blowfish'))
								));

	public function beforeFilter() {
		$this->checkInstall();

		$this->handleRedirects();

		// Change the layout to admin if the prefix is admin
		if (!empty($this->params['prefix']) && $this->params['prefix'] == 'admin') {
			if (Configure::read('Config.adminTheme')) {
				$this->theme = Configure::read('Config.adminTheme');
			}

			$this->layout = 'admin';
		} elseif (Configure::read('Config.theme')) { // lets see if we are using a theme
			$this->theme = Configure::read('Config.theme');
		}
	}

	public function beforeRender() {
		// a work around for flash messages
		// success by default
		if (!empty($this->params['prefix']) && $this->params['prefix'] == 'admin') {
			if ($this->Session->check('Message.flash')) {
				$flash = $this->Session->read('Message.flash');

				if ($flash['element'] == 'default') {
					$flash['element'] = 'success';
					$this->Session->write('Message.flash', $flash);
				}
			}
		}

		// lets load the menu for the front end
		if (empty($this->params['prefix'])) {
			$this->loadModel('Page');
			$topMenu    = $this->Page->menu(null, 'top');
			$bottomMenu = $this->Page->menu(null, 'bottom');
			$this->set(compact('topMenu', 'bottomMenu'));
		}

	}

	public function isAuthorized($user) {
		if (!empty($this->params['prefix']) && $this->params['prefix'] == 'admin' && !$user) {
			return false;
		}

		return true;
	}

	protected function handleRedirects() {
		$here = trim($this->here, '/');
	    if (!empty($_SERVER['REDIRECT_QUERY_STRING'])) {
			$here .= '?' . $_SERVER['REDIRECT_QUERY_STRING'];
		}

		$this->loadModel('Redirect');
		$redirect = $this->Redirect->getRedirect($here);

		if ($redirect) {
			return $this->redirect($redirect, 301);
		}

		return false;
	}

	public function checkInstall() {
		if (!Configure::read('Coderity.checkInstall')) {
			return false;
		}

		if ($this->action == 'admin_install') {
			return false;
		}

		// lets see if any users exist, if not, this is a fresh install
		$this->loadModel('User');
		if (!$this->User->hasAny()) {
			return $this->redirect(array('admin' => true, 'controller' => 'users', 'action' => 'install'));
		}
	}
}