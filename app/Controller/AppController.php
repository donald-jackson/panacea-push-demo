<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	static $errorCodes;
    
    public function beforeFilter() {
        AppController::$errorCodes = array(-1024 => __('Unknown error, please try again'));
		$this->layout = 'bootstrap';
        if ($this->params['prefix'] == 'admin') {
            $this->checkAuth();
            $this->set("loggedInAdmin", true);
        } else {
            $this->set("loggedInAdmin", false);
        }
        
        $authDone = false;
        
        if($this->params['ext'] == 'json') {
        	$this->checkAuth();
        	$authDone = true;
        }

        if (($this->params['prefix'] != 'admin') && (!$this->inWhitelist()) && !$authDone) {
            $this->redirect(array('controller' => 'pages', 'action' => 'home'));
        } else {
            
        }
    }
    
    function inWhitelist() {
        if($this->params['controller'] == 'pages') {
            return true;
        }
        
        if(($this->params['controller'] == 'applications') && (($this->params['action'] == 'process_notifications') || ($this->params['action'] == 'process_delayed_messages'))) {
            return true;
        }
        
        if(($this->params['controller'] == 'entries') && ($this->params['action'] == 'process_ussd_close')) {
            return true;
        }
        
        return false;
    }

    public function getError($code) {
        return $this->errorCodes[$code];
    }
    
    
    
    static function buildApiCall($action, $params, $url = null) {
        if(is_null($url)) {
            $url = Configure::read('Labs.FeatureApiUrl');
        }
        
        $url .= "?action=".urlencode($action);
        foreach($params as $key => $val) {
            $url .= "&".urlencode($key)."=".urlencode($val);
        }
        
        return $url;
    }
    
    static function doApiCall($action, $params, $url = null) {
        $url = AppController::buildApiCall($action, $params, $url);
        
        CakeLog::write('api-calls', "Calling {$url}");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        
        $result = curl_exec($ch);

        if(!empty($result)) {
            $json = json_decode($result, true);
            
            if(is_array($json)) {
                if($json['status'] >= 0) {
                    return $json;
                } else {
                    AppController::$errorCodes[$json['status']] = $json['message'];
                    return $json['status'];
                }
            }
        }
        return -1024;
    }
    
    function checkAuth() {
        $user = @$_SERVER['PHP_AUTH_USER'];
        $pw = @$_SERVER['PHP_AUTH_PW'];
        $user = strtolower($user);
        Configure::load('admin_users');
        
        $users = Configure::read('AdminUsers');
        
        $ok = true;
        
        if(!isset($users[$user])) {
            $ok = false;
        }
        
        if($ok) {
            $pw = Security::hash($pw);
            if($users[$user] != $pw) {
                $ok = false;
            }
        }
        
        if (!$ok) {
            header('WWW-Authenticate: Basic realm="' . $_SERVER['HTTP_HOST'] . '"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Access denied';
            exit;
        }
    }
}
