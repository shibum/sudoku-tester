<?php

class Application {
    public function __construct() {
        $this->_set_reporting();
        $this->_unregister_globals();
    }

    /**
     * 
     * set error reporing false for production environment.
     */
    private function _set_reporting() {
        if(DEBUG) {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        }else {
            error_reporting(0);
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);
            ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'errors.log');
        }
    }

    /**
     * 
     * unregister the global values for security concens.
     */
    private function _unregister_globals() {
        if(ini_get('register_globals')) {
            $globalsArray = ['_SESSION', '_COOKIE', '_GET', '_REQUEST', '_SERVER', '_ENV', '_FILES'];
            foreach($globalsArray as $global) {
                foreach($GLOBALS[$global] as $k => $v) {
                    if($GLOBALS[$k] === $v) {
                        unset($GLOBALS[$k]);
                    }
                }
            }
        }
    }
}