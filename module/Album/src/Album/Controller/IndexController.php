<?php
namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {
    public function getApplicationEventManager() {
        return $this->getEvent()->getApplication()->getEventManager();
    }
    public function log($params) {
        if(!is_array($params)) {
            $params = ['message' => (string)$params];
        }
        $this->getApplicationEventManager()->trigger('log', $this, $params);
    }
    public function indexAction() {
        $appEventManager = $this->getApplicationEventManager();
        $this->log('album index');
        return new ViewModel(['message' => 'album list']);
    }
}

