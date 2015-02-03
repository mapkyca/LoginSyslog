<?php

namespace IdnoPlugins\LoginSyslog {

    class LogItem extends \Idno\Common\Entity {

	function build($action, $userdetails) {

	    $this->action = $action;
	    $this->ip = Main::getIP();

	    if (
		    ($userdetails instanceof \Idno\Entities\User) ||
		    ($userdetails instanceof \Idno\Entities\RemoteUser)
	    ) {
		$this->setOwner($userdetails);
	    } else {
		$this->email = $userdetails;
	    }
	}

	function save() {

	    if (empty($this->_id)) {
		$new = true;
	    } else {
		$new = false;
	    }

	    /*$this->setAccess('PRIVATE');
	    $page = \Idno\Core\site()->currentPage();
	    if ($page) $page->setInput ('access', 'PRIVATE');*/
	    $result = parent::save();
	}

    }

}