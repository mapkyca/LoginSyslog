<?php

    namespace IdnoPlugins\LoginSyslog {

        class Main extends \Idno\Common\Plugin {
	                
            public static function getIP() {
                // Work out IP address (if behind proxy)
                $ip = $_SERVER['REMOTE_ADDR'];
                if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                     $proxies = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']); // We are behind a proxy 
                     $ip = trim($proxies[0]);
                }
                
                return $ip;
            }
            
            public static function syslog($message, $log = LOG_SYSLOG, $level = LOG_NOTICE) {
                openlog("idno({$_SERVER['HTTP_HOST']})", LOG_PID, $log);

                syslog($level, $message);

                closelog();
            }
	    
	    public function createLogEntry($details, $action) {
		
		$item = new LogItem();
		$item->build($action, $details); 
		$item->save(); 
	    }
            
	    function registerPages() {
		
                // Register admin settings
                \Idno\Core\site()->addPageHandler('admin/loginsyslog', '\IdnoPlugins\LoginSyslog\Pages\Admin');
                // Register settings page
                \Idno\Core\site()->addPageHandler('account/loginsyslog', '\IdnoPlugins\LoginSyslog\Pages\Account');
                
                // Add menu items to account & administration screens
                \Idno\Core\site()->template()->extendTemplate('admin/menu/items', 'admin/LoginSyslog/menu');
                \Idno\Core\site()->template()->extendTemplate('account/menu/items', 'account/LoginSyslog/menu');
	    }
	    
            function registerEventHooks() {

                 \Idno\Core\site()->addEventHook('login/failure/nouser', function(\Idno\Core\Event $event) {
                     Main::syslog("Invalid user ". $event->data()['credentials']['email'] ." from " . Main::getIP(),  LOG_AUTH, LOG_NOTICE);
		     $this->createLogEntry($event->data()['credentials']['email'], 'Login failure - invalid user');
                 });
                 
                 \Idno\Core\site()->addEventHook('login/failure', function(\Idno\Core\Event $event) {
                     Main::syslog("Authentication failure for ". $event->data()['user']->getHandle() ." from " . Main::getIP(),  LOG_AUTH, LOG_NOTICE);
		     $this->createLogEntry($event->data()['user'], 'Login attempt failure');
                 });
		 
		 \Idno\Core\site()->addEventHook('login/failure/api', function(\Idno\Core\Event $event) { 
                     Main::syslog("Authentication failure for API User from " . Main::getIP(),  LOG_AUTH, LOG_NOTICE); 
                 });
                 
                 \Idno\Core\site()->addEventHook('login/success', function(\Idno\Core\Event $event) {
                     Main::syslog("Accepted login for ". $event->data()['user']->getHandle() ." from " . Main::getIP(),  LOG_AUTH, LOG_INFO);
		     $this->createLogEntry($event->data()['user'], 'Logged in successfully');
                 });
		 
		 \Idno\Core\site()->addEventHook('logout/success', function(\Idno\Core\Event $event) {
                     Main::syslog("User logged out ". $event->data()['user']->getHandle() ." from " . Main::getIP(),  LOG_AUTH, LOG_INFO);
		     $this->createLogEntry($event->data()['user'], 'Logged out');
                 });
                
            }
        }

    }
