<?php
$zf2Path = NULL;

$zf2Path = getenv('ZF2_PATH');
if($zf2Path) {
    include $zf2Path . '/Zend/Loader/AutoloaderFactory.php';
    Zend\Loader\AutoloaderFactory::factory([
        'Zend\Loader\StandardAutoloader' => [
            'autoregister_zf' => TRUE,
        ],
    ]);
}
else {
    throw new RuntimeException('Unable to load Zend Framework. Please set the ZF2_PATH environment variable');
}
