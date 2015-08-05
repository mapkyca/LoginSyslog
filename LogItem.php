<?php

namespace IdnoPlugins\LoginSyslog {

    class LogItem extends \Idno\Common\Entity {

	function build($action, $userdetails) {

	    $this->action = $action;
	    $this->ip = Main::getIP();

	    // Try and get a geoIP address
	    if ($geo = \Idno\Core\site()->triggerEvent('geoip/lookup', ['ip' => $this->ip], false)) 
	    {
		$this->geo_ip = $geo;
	    }

	    if (
		    ($userdetails instanceof \Idno\Entities\User) ||
		    ($userdetails instanceof \Idno\Entities\RemoteUser)
	    ) {
		$this->setOwner($userdetails);
	    } else {
		$this->email = $userdetails;
	    }
	}

	function save($add_to_feed = false, $feed_verb = 'post') {

	    if (empty($this->_id)) {
		$new = true;
	    } else {
		$new = false;
	    }

	    /* $this->setAccess('PRIVATE');
	      $page = \Idno\Core\site()->currentPage();
	      if ($page) $page->setInput ('access', 'PRIVATE'); */
	    $result = parent::save();
	}

    }

}