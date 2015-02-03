<?php

    /**
     * LoginSyslog pages
     */

    namespace IdnoPlugins\LoginSyslog\Pages {

        /**
         * Default class to serve LoginSyslog-related account settings
         */
        class Account extends \Idno\Common\Page
        {

            function getContent()
            {
		$offset = 0;
		
                $this->gatekeeper(); // Logged-in users only
                
                $t = \Idno\Core\site()->template();
                $body = $t->__(['items' => \IdnoPlugins\LoginSyslog\LogItem::get(['owner' => \Idno\Core\site()->session()->currentUserUUID()], array(), 50, $offset)])->draw('account/loginsyslog');
                $t->__([
		    'title' => 'Account Activity', 
		    'body' => $body,
		])->drawPage();
            }

            

        }

    }