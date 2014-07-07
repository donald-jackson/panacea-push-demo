<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if(!defined('LABS_CONSTANTS')) {
    define('LABS_CONSTANTS', true);
    
    define('APP_TYPE_PUBLIC', '0');
    define('APP_TYPE_PRIVATE', '1');
    
    define('EVENT_DEVICE_ADDED', '1');
    define('EVENT_MESSAGE_RECEIVED', '2');
    define('EVENT_DEVICE_READY', '4');
}


$config = array('Labs' => array());
$config['Labs']['ProjectName'] = __('Push Application Handler');
$config['Labs']['ProjectDescription'] = __('This is a demo on how to handle notifications from the Panacea Push Service and also show how messages can be automated');
$config['Labs']['EncryptionKey'] = "235kj2n345jk23hjkl5h23lkdfsf089sduf23hnj324jkfdskfsd";
$config['Labs']['FeatureApiUrl'] = "http://api.panaceamobile.com/json";
$config['Labs']['CoreApiUrl'] = "https://push.panaceamobile.com/";


$config['Labs']['AppTypes'] = array(
    APP_TYPE_PUBLIC => __('Public App'),
    APP_TYPE_PRIVATE => __('Private App')
);

$config['Labs']['EventTypes'] = array(
    EVENT_DEVICE_ADDED => __('Device Added'),
    EVENT_MESSAGE_RECEIVED => __('Message received from device'),
    EVENT_DEVICE_READY => __('Device Ready')
);
