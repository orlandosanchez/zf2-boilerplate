<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

	    $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, array($this, 'onDispatchError'), 0);

    }

	public function onDispatchError($e)
	{			
		switch($e->getError())
		{
			case 'error-unauthorized-route':
				$sm = $e->getApplication()->getServiceManager();
	        	$authorize  = $sm->get('BjyAuthorize\Provider\Identity\ProviderInterface');
				$roles      = $authorize->getIdentityRoles();
			break;
		}
		
	}

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
      return array(
        'factories' => array(
          'Admin\Gateway\UserGateway' =>  function($sm) {
            $tableGateway = $sm->get('AdminUserTableGateway');
            $table = new \Admin\Gateway\UserGateway($tableGateway);
            return $table;
          },

          'AdminUserTableGateway' => function ($sm) {
            $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
            $resultSetPrototype = new ResultSet();
            $resultSetPrototype->setArrayObjectPrototype(new \Admin\Model\User());
            return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
          },
        )
      );
    }
}
