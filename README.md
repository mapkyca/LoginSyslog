Syslog logging for Known (nee idno)
===================================

This plugin provides syslog events in the auth log for login success and failure.

Installation
------------

* Drop the LoginSyslog folder into the IndoPlugins folder of your idno installation.
* Log into Known and click on Administration.
* Click "install" next to LoginSyslog.

Once this is done, login failures will be logged to the auth log as notice, while successful
log ins will be logged as info.

I recommend combining this with a fail2ban rule (example given in the example directory).

The latest version of the plugin will also create a visible event log per user and per system (visible by the administrator). 
This log will record log in/log out events as well as failed login attempts. This will allow you to spot if someone is attempting
to access your account without permission (without needing to go into the syslog).

Licence
-------

Released under the Apache 2.0 licence: http://www.apache.org/licenses/LICENSE-2.0.html

See
---
 * Author: Marcus Povey <http://www.marcus-povey.co.uk> 
 
