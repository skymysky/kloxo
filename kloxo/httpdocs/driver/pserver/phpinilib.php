<?php 

class phpini_flag_b extends lxaclass
{
	static $__desc_display_error_flag = array("f", "", "display_errors");
	static $__desc_register_global_flag = array("f", "", "register_globals");
	static $__desc_enable_zend_flag = array("f", "", "enable_zend");
	static $__desc_enable_xcache_flag = array("f", "", "enable_xcache");
	static $__desc_enable_ioncube_flag = array("f", "", "enable_ioncube");
	static $__desc_enable_suhosin_flag = array("f", "", "enable_suhosin");
	static $__desc_upload_max_filesize = array("", "", "upload_file_max_size");
	static $__desc_log_errors_flag = array("f", "", "log_errors");
	static $__desc_file_uploads_flag = array("f", "", "file_uploads");
	static $__desc_upload_tmp_dir_flag = array("", "", "upload_tmp_dir");
	static $__desc_output_buffering_flag = array("f", "", "output_buffering");
	static $__desc_register_argc_argv_flag = array("f", "", "register_argc_argv");
	static $__desc_magic_quotes_gpc_flag = array("f", "", "magic_quotes_gpc");
	static $__desc_register_long_arrays_flag = array("f", "", "register_long_arrays");
	static $__desc_variables_order_flag = array("", "", "variables_order");
	static $__desc_output_compression_flag = array("f", "", "output_compression");
	static $__desc_post_max_size_flag = array("", "", "post_max_size");
	static $__desc_magic_quotes_runtime_flag = array("f", "", "magic_quotes_runtime");
	static $__desc_magic_quotes_sybase_flag = array("f", "", "magic_quotes_sybase");
	static $__desc_gpc_order_flag = array("", "", "gpc_order");
	static $__desc_extension_dir_flag = array("", "", "extension_dir");
	static $__desc_enable_dl_flag = array("f", "", "enable_dl");
	static $__desc_sendmail_from = array("", "", "sendmail_from");
	static $__desc_cgi_force_redirect_flag = array("f", "", "cgi_force_redirect");
	static $__desc_mysql_allow_persistent_flag = array("f", "", "mysql_allow_persistent_flag");
	static $__desc_disable_functions = array("t", "", "disable_functions");
	static $__desc_max_execution_time_flag = array("", "", "max_execution_time");
	static $__desc_max_input_time_flag = array("", "", "max_input_time");
	static $__desc_memory_limit_flag = array("", "", "memory_limit");
	static $__desc_allow_url_fopen_flag = array("f", "", "allow_url_fopen");
	static $__desc_allow_url_include_flag = array("f", "", "allow_url_include");
	static $__desc_session_save_path_flag = array("", "", "session_save_path");
	static $__desc_session_autostart_flag = array("f", "", "session_autostart");
	static $__desc_safe_mode_flag = array("f", "", "safe_mode");

	static $__desc_multiple_php_flag = array("f", "", "multiple_php_enable");
	static $__desc_multiple_php_ready = array("", "", "multiple_php_ready");
	static $__desc_multiple_php_ratio = array("", "", "multiple_php_ratio");

	static $__desc_max_input_vars_flag = array("", "", "max_input_vars");
}

class phpini extends lxdb
{
	static $__desc = array("", "", "php_configuration");
	static $__desc_nname = array("", "", "php_configuration");
	static $__desc_enable_zend_flag = array("f", "", "enable_zend");
	static $__desc_enable_ioncube_flag = array("f", "", "enable_ioncube");
	static $__desc_register_global_flag = array("f", "", "register_globals");
	static $__desc_display_error_flag = array("f", "", "display_errors");
	static $__desc_php_manage_flag = array("", "", "manage_php_configuration");
	static $__acdesc_update_edit = array("", "", "PHP_config");
	static $__acdesc_update_extraedit = array("", "", "advanced_PHP_config");
	static $__acdesc_show = array("", "", "PHP_config");

	static $__desc_php_selected = array("s", "", "php_selected");

	static function initThisObjectRule($parent, $class, $name = null)
	{
		return $parent->getClName();
	}

	function getInheritedList()
	{
		global $ghtml, $login;
	/*
		$list[] = 'enable_xcache_flag';
		$list[] = 'enable_zend_flag';
		$list[] = "enable_ioncube_flag";
		$list[] = "enable_suhosin_flag";
	*/
	//	$list[] = 'safe_mode_flag';
		$list[] = 'output_compression_flag';
		$list[] = 'session_save_path_flag';

		$list[] = 'multiple_php_ready';

		return $list;
	}

	function getLocalList()
	{
		global $ghtml, $login;

	//	if ($this->getParentO()->is__table('pserver')) {
		if ($this->getParentO()->getClass()  === 'pserver') {
			$list[] = 'multiple_php_ready';

			$list[] = 'multiple_php_flag';

			$flag = (isset($this->phpini_flag_b->multiple_php_flag)) ?
				$this->phpini_flag_b->multiple_php_flag : 'off';

			if ($flag === 'on') {
				$list[] = 'multiple_php_ratio';
			}
		} else {
			$sa=$login->getList('pserver');

			foreach ($sa as $s) {
				if ($s->nname === $this->syncserver) {
					$flag = (isset($s->getObject('phpini')->phpini_flag_b->multiple_php_flag)) ?
						$s->getObject('phpini')->phpini_flag_b->multiple_php_flag : 'off';
				}
			}

			if ($flag === 'on') {
			//	if (!$this->getParentO()->is__table('web')) {
				if ($this->getParentO()->getClass() !== 'web') {
					$list[] = 'multiple_php_ready';
					$list[] = 'multiple_php_ratio';
				} else {
					$list[] = 'php_selected';
				}
			}
		}

	//	if (!$this->getParentO()->is__table('web')) {
		if ($this->getParentO()->getClass() !== 'web') {
			$list[] = 'display_error_flag';
		//	$list[] = 'register_global_flag';
			$list[] = 'log_errors_flag';
			$list[] = 'output_compression_flag';
		}
	/*
		$list[] = 'enable_xcache_flag';
		$list[] = 'enable_zend_flag';
		$list[] = "enable_ioncube_flag";
		$list[] = "enable_suhosin_flag";
	*/
		return $list;
	}

	function getExtraList()
	{
		$list[] = 'sendmail_from';
		$list[] = 'enable_dl_flag';
		$list[] = 'output_buffering_flag';
	//	$list[] = 'register_long_arrays_flag';
		$list[] = 'allow_url_fopen_flag';
		$list[] = 'allow_url_include_flag';
		$list[] = 'register_argc_argv_flag';
	//	$list[] = 'magic_quotes_gpc_flag';
		$list[] = 'mysql_allow_persistent_flag';
		$list[] = 'disable_functions';
		$list[] = 'max_execution_time_flag';
		$list[] = 'max_input_time_flag';
		$list[] = 'memory_limit_flag';
		$list[] = 'post_max_size_flag';
		$list[] = "upload_max_filesize";

		$list[] = 'max_input_vars_flag';

		$list[] = 'file_uploads_flag';
	//	$list[] = 'magic_quotes_runtime_flag';
	//	$list[] = 'magic_quotes_sybase_flag';
		$list[] = 'cgi_force_redirect_flag';
	//	$list[] = 'safe_mode_flag';
	//	$list[] = 'session_autostart_flag' ;
		$list[] = 'session_save_path_flag';

		return $list;
	}

	function getAdminList()
	{
		global $login;
		
		if (!$login->isAdmin()) {
			$list[] = 'disable_functions';
			$list[] = 'max_execution_time_flag';
			$list[] = 'max_input_time_flag';
			$list[] = 'memory_limit_flag';
			$list[] = 'post_max_size_flag';
			$list[] = "upload_max_filesize";

			return $list;
		}
	}

	function fixphpIniFlag()
	{
		if (!isset($this->phpini_flag_b) || get_class($this->phpini_flag_b) !== 'phpini_flag_b') {
			$this->phpini_flag_b = new phpini_flag_b(null, null, $this->nname);
			$this->setUpINitialValues();
		}
	}

	function createExtraVariables()
	{
		global $gbl, $sgbl, $login, $ghtml;

		$this->fixphpIniFlag();
		$gen = $login->getObject('general')->generalmisc_b;

	//	if (!$this->getParentO()->is__table('pserver')) {
		if ($this->getParentO()->getClass() !== 'pserver') {
			$ob = new phpini(null, 'localhost', createParentName('pserver', 'localhost'));
			$ob->get();
			$ob->fixphpIniFlag();

			// MR -- trick for escape web-based php.ini
		//	if ($this->getParentO()->is__table('web')) {
			if ($this->getParentO()->getClass() === 'web') {
				$this->__var_docrootpath = $this->getParentO()->getFullDocRoot();
			}

			$list = $this->getInheritedList();
			
			foreach ($list as $l) {
				$this->phpini_flag_b->$l = $ob->phpini_flag_b->$l;
			}

			// MR -- trick for escape web-based php.ini
		//	if ($this->getParentO()->is__table('web')) {
			if ($this->getParentO()->getClass() === 'web') {
				$this->__var_web_user = $this->getParentO()->username;
				$this->__var_customer_name = $this->getParentO()->customer_name;
				$this->__var_disable_openbasedir = (isset($this->getParentO()->webmisc_b->disable_openbasedir)) ?
					$this->getParentO()->webmisc_b->disable_openbasedir : null;
			} else {
				$this->__var_web_user = $this->getParentO()->nname;
			}
		}

		$this->__var_extrabasedir = $gen->extrabasedir;
		$driverapp = $gbl->getSyncClass(null, $this->syncserver, 'web');
		$this->__var_webdriver = $driverapp;
	}

	function createShowPropertyList(&$alist)
	{
		$alist['property'][] = 'a=show';
		$alist['property'][] = 'a=updateform&sa=extraedit';
	}


	function createShowUpdateform()
	{
		$uflist['edit'] = null;

		return $uflist;
	}

	function get_multiple_php_list()
	{
		global $login;

		$l = $login->getList('pserver');

		foreach ($l as $s) {
			if ($s->nname === $this->syncserver) {
				$php = $s->getObject('phpini');
				break;
			}
		}

		$a = array('52', '53', '54', '55');

		foreach ($a as $k => $v) {
			if (file_exists("/opt/php{$v}m/usr/bin/php")) {
			//	$p[] = '+php' . $v . 'm';
				$p[] = '+' . $v . 'm';
				$e[] = true;
			} else {
			//	$p[] = '-php' . $v . 'm';
				$p[] = '-' . $v . 'm';
				$e[] = false;
			}
		}

		if (!isset($e)) {
			$php->phpini_flag_b->multiple_php_flag = 'off';

			throw new lxexception('need_install_phpXYm_series_for_multiple_php', '', $this->syncserver);	
		}

		return $p;
	}

	function postUpdate()
	{
		$this->setUpINitialValues();

		// We need to write because the fixphpini reads everything from the database.
		$this->write();

	//	$this->setPhpModuleUpdate();

	//	if ($this->getParentO()->is__table('pserver')) {
		if ($this->getParentO()->getClass() === 'pserver') {
			lxshell_return("__path_php_path", "../bin/fix/fixphpini.php", 
				"--server={$this->getParentO()->nname}");
		}
	}

	function setPhpModuleUpdate()
	{
		$modulelist = array('xcache', 'suhosin', 'ioncube', 'zend');

		foreach ($modulelist as &$m) {
			if ($this->phpini_flag_b->isOn("enable_{$m}_flag")) {
				$active = isPhpModuleActive($m);

				if (!$active) {
					setPhpModuleActive($m);
				}
			} else {
				setPhpModuleInactive($m);
			}
		}
	}

	function initPhpIni()
	{
	/*
		if (!isset($this->phpini_flag_b) || get_class($this->phpini_flag_b) !== 'phpini_flag_b') {
			$this->phpini_flag_b = new phpini_flag_b(null, null, $this->nname);
		}
	*/

		$this->setUpINitialValues();
	}

	function updateform($subaction, $param)
	{
		global $login;

		$this->initPhpIni();

		$parent = $this->getParentO();

		if ($subaction === 'extraedit') {
			$totallist = $this->getExtraList();
		} 
		else {
			$totallist = $this->getLocalList();
		}

		if ($parent->getClass() !== 'web') {
		
			$inheritedlist = $this->getInheritedList();
			$adminList = $this->getAdminList();

			foreach ($totallist as $l) {
			//	if ((!$parent->is__table('pserver') && array_search_bool($l, $inheritedlist)) || array_search_bool($l, $adminList)) {
				if (($parent->getClass() !== 'pserver' && array_search_bool($l, $inheritedlist)) || array_search_bool($l, $adminList)) {
					$vlist["phpini_flag_b-$l"] = array('M', null);
				} 
				else {
					$vlist["phpini_flag_b-$l"] = null;
				}
			}
		}

	//	if ($parent->is__table('web')) {
		if ($parent->getClass() === 'web') {
			$this->php_selected = 'php53m';

			$l = $this->get_multiple_php_list();

			foreach ($l as $k => $v) {
				if (strpos($v, '-') !== false) { continue; }

				$f[] = 'php' . str_replace('+', '', $v);
			}

			$vlist['php_selected'] = array("s", $f);
		}

		// MR -- still not work (like in 'appearance')
		// still something wrong with 'updateall' process!
	//	if ($parent->is__table('pserver')) {
		if ($parent->getClass() === 'pserver') {
		//	$vlist['__v_updateall_button'] = array();
		}

		return $vlist;
	}


	function setUpINitialValues()
	{
		global $ghtml, $login;
	/*
		$this->initialValueRpmStatus('enable_xcache_flag');
		$this->initialValueRpmStatus('enable_zend_flag');
		$this->initialValueRpmStatus('enable_ioncube_flag');
		$this->initialValueRpmStatus('enable_suhosin_flag');
	*/
		$this->initialValue('output_compression_flag', 'off');

		$this->initialValue('upload_max_filesize', '16M');
		$this->initialValue('register_global_flag', 'off');
		$this->initialValue('mysql_allow_persistent_flag', 'off');
		$this->initialValue('session_save_path_flag', '/var/lib/php/session');

		// Issue #630 - parse_ini_file to be enabled by default
		//	$this->initialValue('disable_functions', 
		//		'exec,passthru,shell_exec,system,proc_open,popen,curl_exec,'.
		//		'curl_multi_exec,parse_ini_file,show_source');

		// MR -- remove curl from disable_functions
		$initial = 'exec,passthru,shell_exec,system,proc_open,popen,show_source';
		$this->initialValue('disable_functions', $initial);

		$this->initialValue('max_execution_time_flag', '180');
		$this->initialValue('max_input_time_flag', '180');
		$this->initialValue('memory_limit_flag', '64M');
		$this->initialValue('allow_url_fopen_flag', 'on');
		$this->initialValue('allow_url_include_flag', 'on');
		$this->initialValue('display_error_flag', 'off');
		$this->initialValue('log_errors_flag', 'off');
		$this->initialValue('session_autostart_flag', 'off');
		$this->initialValue('file_uploads_flag', 'on');
		$this->initialValue('output_buffering_flag', 'off');
		$this->initialValue('register_argc_argv_flag', 'on');
		$this->initialValue('register_long_arrays_flag', 'on');
		$this->initialValue('magic_quotes_gpc_flag', 'off');
		$this->initialValue('gpc_order_flag', 'GPC');
		$this->initialValue('variables_order_flag', 'EGPCS');
		$this->initialValue('post_max_size_flag', '32M');
		$this->initialValue('magic_quotes_runtime_flag', 'off');
		$this->initialValue('magic_quotes_sybase_flag', 'off');
		$this->initialValue('enable_dl_flag', 'on');
		$this->initialValue('cgi_force_redirect_flag', 'on');
		$this->initialValue('extension_dir_flag', '/usr/lib/php/modules');
		$this->initialValue('upload_tmp_dir_flag', '/tmp');
		$this->initialValue('safe_mode_flag', 'off');

		$this->initialValue('sendmail_from', null);

		$this->initialValue('multiple_php_flag', 'off');

		$php_ratio = '0:6:0:0';

		$this->initialValue('multiple_php_ratio', $php_ratio);

		$list = $this->get_multiple_php_list();

		$this->initialValue('multiple_php_ready', implode(" ", $list));

		$this->initialValue('max_input_vars_flag', '3000');
	}

	function initialValue($var, $val)
	{
		global $login;

		$parent = $this->getParentO();

		if (!isset($this->phpini_flag_b->$var) || !$this->phpini_flag_b->$var) {
		//	if ($parent->is__table('pserver')) {
			if ($parent->getClass() === 'pserver') {
				$this->phpini_flag_b->$var = $val;
			} else {
				if ($login->isCustomer()) {
					$this->phpini_flag_b->$var = $parent->phpini_flag_b->$var;
				} else {
					$slist = $login->getList('pserver');

					foreach ($slist as $k => $v) {
						if ($v->nname === $this->syncserver) {
							$s = $v;
							break;
						}
					}

					$p = $s->getObject('phpini');
					$this->phpini_flag_b->$var = $p->phpini_flag_b->$var;

				}
			}

		}
	}

	function initialValueRpmStatus($var)
	{
		$srcpath = '/home/phpini/etc/php.d';
		$trgtpath = '/etc/php.d';

		if ($var === 'enable_xcache_flag') {
			$module = "xcache";
			$active = isPhpModuleActive($module);
		} elseif ($var === 'enable_suhosin_flag') {
			$module = "suhosin";
			$active = isPhpModuleActive($module);
		} elseif ($var === 'enable_ioncube_flag') {
			$modulebase = "ioncube";
			$modulelist = array($modulebase, "{$modulebase}-loader");
			$ininamelist = $modulelist;

			foreach ($modulelist as &$m) {
				$active = isPhpModuleActive($m, $ininamelist);

				if ($active) { break; }
			}
		} elseif ($var === 'enable_zend_flag') {
			$modulebase = "zend";
		
			if (version_compare(getPhpVersion(), "5.3.0", ">=")) {
				$modulelist = array("{$modulebase}-guard-loader");
				$ininamelist = array("zendguard");
			} else {
				$modulelist = array($modulebase, "{$modulebase}-guard-loader");
				$ininamelist = array("zend", "zendoptimizer");
			}

			foreach ($modulelist as &$m) {
				$active = isPhpModuleActive($m, $ininamelist);

				if ($active) { break; }
			}
		}

		$t = str_replace('_flag', '.flg', $var);

		if ($active) {
			$this->phpini_flag_b->$var = 'on';
		} else {
			$this->phpini_flag_b->$var = 'off';
		}
	}
}