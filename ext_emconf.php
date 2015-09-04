<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "mfc_belogin_captcha".
 *
 * Auto generated 19-09-2013 09:58
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Backend Login Captcha',
	'description' => 'Add an configurable captcha to the backend login after a give amount of failed login tries',
	'category' => 'be',
	'author' => 'Sebastian Fischer',
	'author_email' => 'typo3@marketing-factory.de',
	'shy' => '',
	'conflicts' => '',
	'priority' => 'bottom',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 1,
	'lockType' => '',
	'author_company' => 'Marketing Factory Consulting GmbH',
	'version' => '1.2.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '7.4.0-',
			'php' => '5.5.0-',
			'extbase' => '7.4.0-0.0.0'
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => '',
);

?>
