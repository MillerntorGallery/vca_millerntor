<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

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
		'Werk' => 'list, show, new, create, edit, update, delete',
		
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
		'Kuenstler' => 'list, show, new, create, edit, update, delete',
		'Werk' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Kuenstler' => 'create, update, delete',
		'Werk' => 'create, update, delete',
		
	)
);

?>