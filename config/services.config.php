<?php
/**
 * Created by PhpStorm.
 * User: Andy
 * Date: 10/26/2015
 * Time: 8:39 PM
 */

return array(
    'service_manager' => array(
        'invokables' => array(
            'ViewModel' => 'Zend\View\Model\ViewModel',
        ),
        'factories' => array(
            'ATPCore\Db' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'SessionManager' => 'ATPCore\Session\SessionManager',
        ),
        'shared' => array(
            'ViewModel' => false,
        )
    )
);