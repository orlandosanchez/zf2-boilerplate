<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
	
    private $userTable;

    public function getUserTable() {
      if (!$this->userTable) {
        $sm = $this->getServiceLocator();
        $this->userTable = $sm->get('Admin\Gateway\UserGateway');
      }
      return $this->userTable;
    }

    public function indexAction()
    {
        return new ViewModel();
    }
    public function listAction()
    {
        $users = $this->getUserTable()->fetchAll();
        return new ViewModel(array(
          'users' => $users
        ));
    }

	public function editAction() {
		$user_id 	= $this->params()->fromRoute('user_id');
        $user 		= $this->getUserTable()->getUser($user_id);
		
		$form 		= new \Admin\Form\UserForm();
		$form->setData($user->toArray());
		
		return new ViewModel(array(
			'form' => $form
		));
	}


    public function redirectAction() {
		
		$authorize  = $this->getServiceLocator()->get('BjyAuthorize\Provider\Identity\ProviderInterface');
		$roles      = $authorize->getIdentityRoles();

		if(in_array('user', $roles)) // admin
		{
			$this->redirect()->toRoute('admin');
		} 
		elseif (in_array('guest', $roles)) 
		{

		}

		var_dump(get_class_methods($authorize));
		var_dump(get_class_methods($this->zfcUserAuthentication()));
				var_dump(get_class_methods($this->zfcUserAuthentication()->getIdentity()));
		return false;
    }
}
