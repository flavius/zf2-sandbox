<?php
namespace Album;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;

class Module {
    public function onBootstrap(MvcEvent $ev) {
        $eventManager  = $ev->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener;
        $moduleRouteListener->attach($eventManager);
    }
    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }
    public function getAutoloaderConfig() {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }
}
