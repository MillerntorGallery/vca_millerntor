<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_vcamillerntor_domain_model_werk'] = array(
	'ctrl' => $TCA['tx_vcamillerntor_domain_model_werk']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, media, artist,ausstellung,material,sizes,year,technic,buyUrl',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, description, media, artist,ausstellung,--div--;Infos,material,sizes,year,technic,buyUrl,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_vcamillerntor_domain_model_werk',
				'foreign_table_where' => 'AND tx_vcamillerntor_domain_model_werk.pid=###CURRENT_PID### AND tx_vcamillerntor_domain_model_werk.sys_language_uid IN (-1,0)',
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
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_werk.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_werk.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
				'wizards' => array(
					'RTE' => array(
				        'notNewRecords' => 1,
				        'RTEonly' => 1,
				        'type' => 'script',
				        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
				        'icon' => 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_rte.gif',
				        'module' => array(
				                'name' => 'wizard_rte'
				        )
					)
				)
			),
			'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
		),
/*		'media' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_werk.media',
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
			'media' => array(
					'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.images',
					'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig('media',
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
		'artist' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_werk.artist',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_vcamillerntor_domain_model_kuenstler',
				'MM' => 'tx_vcamillerntor_werk_kuenstler_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
						'edit' => array(
								'type' => 'popup',
								'title' => 'Edit',
								'module' => array(
										'name' => 'wizard_edit',
								),
								'popup_onlyOpenIfSelected' => 1,
								'icon' => 'actions-open',
								'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1'
						),
						'add' => array(
								'type' => 'script',
								'title' => 'Create new',
								'icon' => 'actions-add',
								'params' => array(
										'table' => 'tx_vcamillerntor_domain_model_kuenstler',
										'pid' => '###CURRENT_PID###',
										'setValue' => 'prepend'
								),
								'module' => array(
										'name' => 'wizard_add'
								)
						),
				),
			),
		),
		'ausstellung' => array(
				'exclude' => 0,
				'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_werk.ausstellung',
				'config' => array(
						'type' => 'select',
						'foreign_table' => 'tx_vcamillerntor_domain_model_ausstellung',
						'MM' => 'tx_vcamillerntor_ausstellung_werk_mm',
						'MM_opposite_field' => 'werke',
						'size' => 10,
						'autoSizeMax' => 30,
						'maxitems' => 9999,
						'multiple' => 0,
		
				),
		),
		'material' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_werk.material',
			'config' => array(
					'type' => 'input',
					'size' => 120,
					'eval' => 'trim'
			),
		),
		'sizes' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_werk.sizes',
			'config' => array(
					'type' => 'input',
					'size' => 120,
					'eval' => 'trim'
			),
		),
		'year' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_werk.year',
			'config' => array(
					'type' => 'input',
					'size' => 120,
					'eval' => 'trim'
			),
		),
		'technic' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_werk.technic',
			'config' => array(
					'type' => 'input',
					'size' => 120,
					'eval' => 'trim'
			),
		),
		'buyUrl' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_werk.buyUrl',
			'config' => array(
					'type' => 'input',
					'size' => 120,
					'eval' => 'trim'
			),
		),
	),
);

?>