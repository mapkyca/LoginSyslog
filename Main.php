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
            
            function registerPages() {
                
                 \Idno\Core\site()->addEventHook('login:failure:nouser', function(\Idno\Core\Event $event) {
                     Main::syslog("Invalid user ". $event->data()['handle_or_email'] ." from " . Main::getIP(),  LOG_AUTH, LOG_NOTICE);
                 });
                 
                 \Idno\Core\site()->addEventHook('login:failure:password', function(\Idno\Core\Event $event) {
                     Main::syslog("Authentication failure for ". $event->data()['user']->getHandle() ." from " . Main::getIP(),  LOG_AUTH, LOG_NOTICE);
                 });
                 
                 \Idno\Core\site()->addEventHook('login:success', function(\Idno\Core\Event $event) {
                     Main::syslog("Accepted password for ". $event->data()['user']->getHandle() ." from " . Main::getIP(),  LOG_AUTH, LOG_INFO);
                 });
                
            }
        }

    }