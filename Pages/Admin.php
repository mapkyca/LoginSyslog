<?php

    /**
     * LoginSyslog pages
     */

    namespace IdnoPlugins\LoginSyslog\Pages {

        /**
         * Default class to serve LoginSyslog settings in administration
         */
        class Admin extends \Idno\Common\Page
        {

            function getContent()
            {
		$offset = 0;
		
                $this->adminGatekeeper(); // Admins only
		
                $t = \Idno\Core\site()->template();
                $body = $t->__(['items' => \IdnoPlugins\LoginSyslog\LogItem::get([], array(), 50, $offset)])->draw('admin/loginsyslog');
                $t->__([
		    'title' => 'System Account Activity', 
		    'body' => $body,
		])->drawPage();
            }


        }

    }