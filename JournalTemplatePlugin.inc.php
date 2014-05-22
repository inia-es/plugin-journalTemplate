<?php

/**
 * @file journalTemplatePlugin.inc.php
 *
 * Copyright (c) 2003-2011 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Include contributions from:
 * 	- 2014 Instituto Nacional de Investigacion y Tecnologia Agraria y Alimentaria
 *
 * @class journalTemplatePlugin
 * @ingroup plugins_generic_journalTemplate
 *
 * @brief Journal Template plugin class
 */


import('lib.pkp.classes.plugins.GenericPlugin');

class JournalTemplatePlugin extends GenericPlugin {
	/**
	 * Called as a plugin is registered to the registry
	 * @param $category String Name of category plugin was registered to
	 * @return boolean True iff plugin initialized successfully; if false,
	 * 	the plugin will not be registered.
	 */
	function register($category, $path) {
		$success = parent::register($category, $path);
//		if (!Config::getVar('general', 'installed') || defined('RUNNING_UPGRADE')) return true;
		if ($success && $this->getEnabled()) {
				HookRegistry::register('Templates::Index::journal', array($this, 'callback'));
	      
	      return true;
	 
	  }
	  return false;
	}	
	function getName(){
		return 'JournalTemplatePlugin';
	}	
	function getDisplayName() {
		return Locale::translate('plugins.generic.journalTemplate.displayName');
	}

	function getDescription() {
		return Locale::translate('plugins.generic.journalTemplate.description');
	}

	
	

	/**
	 * Insert a template in journal.tpl
	 */
	function callback($hookName, $args) {
		$params =& $args[0];
		$smarty =& $args[1];
		$output =& $args[2];
//print ($this->getTemplatePath());
		$output = $smarty->fetch($this->getTemplatePath() . 'journalTemplate.tpl');
		return false;
	}

	
}
?>
