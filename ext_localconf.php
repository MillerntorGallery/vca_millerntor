<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

# Entwicklungsumgebung
# ExtBase Reflection Cache AUS
$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['extbase_reflection']['backend'] = 't3lib_cache_backend_NullBackend';

$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['extbase_object']['backend'] = 't3lib_cache_backend_NullBackend';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'VCA.' . $_EXTKEY,
	'Ausstellungen',
	array(
		'Ausstellung' => 'list, show, new, create, edit, update, delete',
		//'Kuenstler' => 'list, show, new, create, edit, update, delete',
		'Werk' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Ausstellung' => 'create, update, delete',
		'Kuenstler' => 'create, update, delete',
		'Werk' => 'create, update, delete',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'VCA.' . $_EXTKEY,
	'Werke',
	array(
		'Werk' => 'list,insertRecord, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Werk' => 'create, update, delete',
		
	)
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'VCA.' . $_EXTKEY,
	'Kuenstler',
	array(
		'Kuenstler' => 'list,insertRecord, show, new, create, edit, update, delete',
		'Werk' => 'list,insertRecord, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Kuenstler' => 'create, update, delete',
		'Werk' => 'create, update, delete',
		
	)
);

?>