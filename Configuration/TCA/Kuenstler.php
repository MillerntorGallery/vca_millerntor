<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_vcamillerntor_domain_model_kuenstler'] = array(
	'ctrl' => $TCA['tx_vcamillerntor_domain_model_kuenstler']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, decription, logo, werk,ausstellung,url,email,facebook,twitter,instagram,other',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, decription, logo, werk,ausstellung,--div--;Kontakt,url,email,facebook,twitter,instagram,other,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_vcamillerntor_domain_model_kuenstler',
				'foreign_table_where' => 'AND tx_vcamillerntor_domain_model_kuenstler.pid=###CURRENT_PID### AND tx_vcamillerntor_domain_model_kuenstler.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'name' => array(
			'exclude' => 0,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_kuenstler.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'decription' => array(
			'exclude' => 0,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_kuenstler.decription',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					)
				)
			),
			'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
		),
/*		'logo' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_kuenstler.logo',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_vcamillerntor',
				'show_thumbs' => 1,
				'size' => 5,
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' => '',
			),
		),
		*/
			'logo' => array(
					'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_kuenstler.logo',
					'l10n_mode' => 'mergeIfNotBlank',
					'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('logo',
							array(
									'appearance' => array(
											'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
									),
									// custom configuration for displaying fields in the overlay/reference table
									// to use the imageoverlayPalette instead of the basicoverlayPalette
									'foreign_types' => array(
											'0' => array(
													'showitem' => '
                                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                                --palette--;;filePalette'
											),
											\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
													'showitem' => '
                                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                                --palette--;;filePalette'
											),
									)
							),
							$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
					)
			),
				
		'url' => array(
				'exclude' => 0,
				'l10n_mode' => 'mergeIfNotBlank',
				'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_kuenstler.url',
				'config' => array(
						'type' => 'input',
						'size' => 60,
						'eval' => 'trim'
				),
		),
		'email' => array(
				'exclude' => 0,
				'l10n_mode' => 'mergeIfNotBlank',
				'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_kuenstler.email',
				'config' => array(
						'type' => 'input',
						'size' => 60,
						'eval' => 'trim'
				),
		),
		'facebook' => array(
				'exclude' => 0,
				'l10n_mode' => 'mergeIfNotBlank',
				'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_kuenstler.facebook',
				'config' => array(
						'type' => 'input',
						'size' => 60,
						'eval' => 'trim'
				),
		),
		'twitter' => array(
				'exclude' => 0,
				'l10n_mode' => 'mergeIfNotBlank',
				'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_kuenstler.twitter',
				'config' => array(
						'type' => 'input',
						'size' => 60,
						'eval' => 'trim'
				),
		),
		'instagram' => array(
				'exclude' => 0,
				'l10n_mode' => 'mergeIfNotBlank',
				'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_kuenstler.instagram',
				'config' => array(
						'type' => 'input',
						'size' => 60,
						'eval' => 'trim'
				),
		),
		'other' => array(
				'exclude' => 0,
				'l10n_mode' => 'mergeIfNotBlank',
				'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_kuenstler.other',
				'config' => array(
						'type' => 'input',
						'size' => 60,
						'eval' => 'trim'
				),
		),
		'werk' => array(
			'exclude' => 0,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_kuenstler.werk',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vcamillerntor_domain_model_werk',
				'MM' => 'tx_vcamillerntor_werk_kuenstler_mm',
				'MM_opposite_field' => 'artist',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				
			),
		),
		'ausstellung' => array(
				'exclude' => 0,
				'l10n_mode' => 'mergeIfNotBlank',
				'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_kuenstler.ausstellung',
				'config' => array(
						'type' => 'select',
						'foreign_table' => 'tx_vcamillerntor_domain_model_ausstellung',
						'MM' => 'tx_vcamillerntor_ausstellung_kuenstler_mm',
						'MM_opposite_field' => 'kuenstler',
						'size' => 10,
						'autoSizeMax' => 30,
						'maxitems' => 9999,
						'multiple' => 0,
		
				),
		),
	),
);

?>