<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Ausstellungen',
	'Ausstellungen'
);
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Werke',
	'Werke'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY,
	'Kuenstler',
	'Kuenstler'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'millerntor');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_vcamillerntor_domain_model_galerie', 'EXT:vca_millerntor/Resources/Private/Language/locallang_csh_tx_vcamillerntor_domain_model_galerie.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_vcamillerntor_domain_model_galerie');
$TCA['tx_vcamillerntor_domain_model_galerie'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_galerie',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,adresse,austellungen,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Galerie.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_vcamillerntor_domain_model_galerie.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_vcamillerntor_domain_model_ausstellung', 'EXT:vca_millerntor/Resources/Private/Language/locallang_csh_tx_vcamillerntor_domain_model_ausstellung.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_vcamillerntor_domain_model_ausstellung');
$TCA['tx_vcamillerntor_domain_model_ausstellung'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_ausstellung',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,description,start,end,werke,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Ausstellung.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_vcamillerntor_domain_model_ausstellung.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_vcamillerntor_domain_model_kuenstler', 'EXT:vca_millerntor/Resources/Private/Language/locallang_csh_tx_vcamillerntor_domain_model_kuenstler.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_vcamillerntor_domain_model_kuenstler');
$TCA['tx_vcamillerntor_domain_model_kuenstler'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_kuenstler',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'name,decription,logo,werk,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Kuenstler.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_vcamillerntor_domain_model_kuenstler.gif'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_vcamillerntor_domain_model_werk', 'EXT:vca_millerntor/Resources/Private/Language/locallang_csh_tx_vcamillerntor_domain_model_werk.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_vcamillerntor_domain_model_werk');
$TCA['tx_vcamillerntor_domain_model_werk'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_werk',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'title,description,media,artist,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Werk.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_vcamillerntor_domain_model_werk.gif'
	),
);


//ext_tables.php
$pluginSignature = 'vcamillerntor_kuenstler';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY.'/Configuration/FlexForms/KuenstlerControllerActions.xml');

$pluginSignature = 'vcamillerntor_werke';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY.'/Configuration/FlexForms/WerkControllerActions.xml');


// add tables to "insert Record" content element
t3lib_extMgm::addToInsertRecords('tx_vcamillerntor_domain_model_ausstellung');
t3lib_extMgm::addToInsertRecords('tx_vcamillerntor_domain_model_kuenstler');
t3lib_extMgm::addToInsertRecords('tx_vcamillerntor_domain_model_werk');

?>