<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_vcamillerntor_domain_model_galerie'] = array(
	'ctrl' => $TCA['tx_vcamillerntor_domain_model_galerie']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, adresse, austellungen',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, adresse, austellungen,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_vcamillerntor_domain_model_galerie',
				'foreign_table_where' => 'AND tx_vcamillerntor_domain_model_galerie.pid=###CURRENT_PID### AND tx_vcamillerntor_domain_model_galerie.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_galerie.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'adresse' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_galerie.adresse',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'austellungen' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:tx_vcamillerntor_domain_model_galerie.austellungen',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_vcamillerntor_domain_model_ausstellung',
				'MM' => 'tx_vcamillerntor_galerie_ausstellung_mm',
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
										'table' => 'tx_vcamillerntor_domain_model_ausstellung',
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