<?php
namespace Application;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

class Module {
    private $logger;
    public function onBootstrap(MvcEvent $e) {
        $eventManager  = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener;
        $moduleRouteListener->attach($eventManager);

        //hook log events
        $this->logger = new Logger;
        $writer = new Stream('php://stderr');
        $this->logger->addWriter($writer);
        $eventManager->attach('log', [$this, 'log']);

        //catch all events and trigger a corresponding log event
        $eventManager->attach('*', function($ev) use($eventManager) {
            $evName = $ev->getName();
            if('log' !== $evName) {
                $eventManager->trigger('log', $this, [
                    'event' => $ev,
                    'message' => "Event: $evName",
                    'target' => get_class($ev->getTarget()),
                ]);
            }
        });
    }

    public function log($ev) {
        $target = $ev->getParam('target', get_class($ev->getTarget()));
        $message = $ev->getParam('message', 'No message provided');
        $priority = $ev->getParam('priority', Logger::INFO);
        $message = sprintf("%s: %s", $target, $message);
        $this->logger->log($priority, $message);
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
