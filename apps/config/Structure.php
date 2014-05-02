<?php
/**
 * Created by fxrialab team
 * Author: Uchiha
 * Date: 7/30/13 - 8:46 AM
 * Project: UserWired Network - Version: beta
 */
// source code structure
// base
$dir = dirname(__FILE__);
$dirSource = substr($dir, 0, strpos($dir, 'apps') - 1);

define ('DS', '/');
define ('BASE_URL', 'http://demo.dandelionet.org/');
define ('DOCUMENT_ROOT', $dirSource . DS);
define ('F3', DOCUMENT_ROOT . 'lib' . DS);
define ('CONFIG', DOCUMENT_ROOT . 'apps' . DS . 'config' . DS);

// framework
define ('CONTROLLERS', DOCUMENT_ROOT . 'apps' . DS . 'controllers' . DS);
define ('HELPERS', DOCUMENT_ROOT . 'apps' . DS . 'helpers' . DS);
define ('MODELS', DOCUMENT_ROOT . 'apps' . DS . 'models' . DS);
define ('VIEWS', DOCUMENT_ROOT . 'apps' . DS . 'views' . DS);
define('COMPONENTS', DOCUMENT_ROOT . 'apps' . DS . 'components' . DS);
define ('TEMPLATE', 'default');
define ('UI', VIEWS . TEMPLATE . DS);

// inside view
define ('ELEMENTS', 'elements' . DS);
define ('LAYOUTS', 'layouts' . DS);
define ('EMAILS', 'emails' . DS);

// static
define ('WEBROOT', BASE_URL . 'apps' . DS . 'views' . DS . TEMPLATE . DS . 'webroot' . DS);
define ('IMAGES', WEBROOT . 'images' . DS);
define ('JS', WEBROOT . 'js' . DS);
define ('CSS', WEBROOT . 'css' . DS);
define ('UPLOAD', DOCUMENT_ROOT . 'apps' . DS . 'views' . DS . TEMPLATE . DS . 'webroot' . DS . 'upload' . DS);
define ('UPLOAD_URL', BASE_URL . 'apps' . DS . 'views' . DS . TEMPLATE . DS . 'webroot' . DS . 'upload' . DS);

// vendors
define ('VENDORS', DOCUMENT_ROOT . 'vendors' . DS);
define ('MODEL_UTILS', VENDORS . 'fxrialab' . DS . 'modelUtils' . DS);
define ('FACTORY_UTILS', VENDORS . 'fxrialab' . DS . 'factoryUtils' . DS);
define ('FACADE', VENDORS . 'fxrialab' . DS . 'facade' . DS);
define ('ORIENTDB', VENDORS . 'OrientDB' . DS);
//define ('AMQP', VENDORS . 'PhpAmqpLib' . DS);
define ('SYMFONY_LOADER', VENDORS . "Symfony/Component/ClassLoader" . DS);
//define ('AMQCONFIG', DOCUMENT_ROOT. 'vendors' . DS . 'php-amqplib' . DS. 'vendor'.DS);

// modules
define ('MODULES', DOCUMENT_ROOT . 'apps' . DS . 'modules' . DS);
define ('ROOT_MOD', BASE_URL . 'apps' . DS . 'modules' . DS);

define ('CACHE_TIME', 3600);
?>
