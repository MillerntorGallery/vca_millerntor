<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_vcamillerntor_domain_model_ausstellung'] = array(
	'ctrl' => $TCA['tx_vcamillerntor_domain_model_ausstellung']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, start, end, werke, kuenstler',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, description, start, end, werke,kuenstler,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'renderType' => 'selectSingle',
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
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_vcamillerntor_domain_model_ausstellung',
				'foreign_table_where' => 'AND tx_vcamillerntor_domain_model_ausstellung.pid=###CURRENT_PID### AND tx_vcamillerntor_domain_model_ausstellung.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_ausstellung.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'description' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_ausstellung.description',
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
					),
				)
			),
			'defaultExtras' => 'richtext:rte_transform[flag=rte_enabled|mode=ts]',
		),
		'start' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_ausstellung.start',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'end' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_ausstellung.end',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'werke' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_ausstellung.werke',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_vcamillerntor_domain_model_werk',
				'MM' => 'tx_vcamillerntor_ausstellung_werk_mm',
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
									'table' => 'tx_vcamillerntor_domain_model_werk',
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
		'kuenstler' => array(
				'exclude' => 0,
				'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_ausstellung.kuenstler',
				'config' => array(
						'type' => 'select',
						'renderType' => 'selectMultipleSideBySide',
						'foreign_table' => 'tx_vcamillerntor_domain_model_kuenstler',
						'MM' => 'tx_vcamillerntor_ausstellung_kuenstler_mm',
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
	),
);

?>