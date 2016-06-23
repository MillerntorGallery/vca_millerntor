<?php
namespace VCA\VcaMillerntor\Utility\Hook;

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \VCA\VcaMillerntor\Domain\Repository\KuenstlerRepository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 fux <sfuchs@projektkater.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Show Plugin Info below Plugin
 *
 * @package vca_millerntor
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 * 
 */
class PluginInfo {

	/**
	 * Params
	 *
	 * @var array
	 */
	public $params;

	/**
	 * Path to the locallang file
	 *
	 * @var string
	 */
	const LLPATH = 'LLL:EXT:vca_millerntor/Resources/Private/Language/locallang_db.xlf:';

	/**
	 * Table information
	 *
	 * @var array
	 */
	public $tableData = array();

	/**
	 * Flexform information
	 *
	 * @var array
	 */
	public $flexformData = array();
	
	/**
	 * kuenstlerRepository
	 *
	 * @var \VCA\VcaMillerntor\Domain\Repository\KuenstlerRepository
	 * @inject
	 */
	protected $kuenstlerRepository;

	public function __construct() {
		/** @var $extbaseObjectManager \TYPO3\CMS\Extbase\Object\ObjectManager */
		$extbaseObjectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		/** @var $kuenstlerRepository \VCA\VcaMillerntor\Domain\Repository\KuenstlerRepository */
		$this->kuenstlerRepository = $extbaseObjectManager->get('VCA\\VcaMillerntor\\Domain\\Repository\\KuenstlerRepository');
		
		$querySettings = $extbaseObjectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
		$querySettings->setStoragePageIds(array(4));
		$this->kuenstlerRepository->setDefaultQuerySettings($querySettings);
	}
	
	/**
	 * Main Function
	 *
	 * @param array $params
	 * @param object $pObj
	 * @return string
	 */
	public function getInfo($params = array(), $pObj) {
		// settings
		$result = '';
		$this->flexformData = \TYPO3\CMS\Core\Utility\GeneralUtility::xml2array($params['row']['pi_flexform']);
			// if flexform data is found
		$actions = $this->getFieldFromFlexform('switchableControllerActions', 'sDEF');

		if (!empty($actions)) {
			$actionList = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(';', $actions);
			// translate the first action into its translation
			$actionTranslationKey = strtolower(str_replace('->', '_', $actionList[0]));
			$actionTranslation = $GLOBALS['LANG']->sL(self::LLPATH . 'flexforms_general.mode.' . $actionTranslationKey);
			if (!$actionTranslation ){
				$actionTranslation = $actionTranslationKey;
			}

			$result .= '<pre>' . $actionTranslation . '</pre>';
		} else {
		}

		if (is_array($this->flexformData)) {

			switch ($actionTranslationKey) {
				case 'kuenstler_insertrecord':
					$this->getKuenstlerDetailSettings();
				break;
				
				default:
					$this->tableData[] = array(
							'default:'.$actionTranslationKey,
							$actionTranslationKey.$actions
					);
					break;
					
			}
		}

		$result .= $this->renderSettingsAsTable();

		return $result;
	}

	protected function getKuenstlerDetailSettings(){
		$settings = $this->getFieldFromFlexform('settings.displayItem', 'sDEF');
		if (!empty($settings)) {
			foreach(explode(',', $settings) as $setting){
				$kuenstler = $this->kuenstlerRepository->findOneByUid($setting);
				//$kuenstlers = $this->kuenstlerRepository->findAll();
				//print_r($kuenstlers);
				if(true || $kuenstler instanceof VCA\VcaMillerntor\Domain\Model\Kuenstler ) {
					$this->tableData[] = array(
							'Kuenstler: ',
							$kuenstler->getName()
					);
				}
				
			}
		}
	}

	protected function getShareClassDetailSettings(){
		$settings = $this->getFieldFromFlexform('settings.shareClassContentParts', 'main');
		
		if (!empty($settings)) {
			foreach(explode(',', $settings) as $setting){
				$this->tableData[] = array(
					$GLOBALS['LANG']->sL(self::LLPATH . 'flexformProduct.settings.shareClassContentParts'),
					$GLOBALS['LANG']->sL(self::LLPATH . 'flexformProduct.settings.content.' . strtolower($setting))
				);
			}
		}
		
		$settings = $this->getFieldFromFlexform('settings.disableHeader', 'main');
		if (!empty($settings)) {
			$value = $GLOBALS['LANG']->sL(self::LLPATH . 'flexformProduct.settings.disableHeader.yes');
		} else {
			$value = $GLOBALS['LANG']->sL(self::LLPATH . 'flexformProduct.settings.disableHeader.no');
		}
		$this->tableData[] = array(
				$GLOBALS['LANG']->sL(self::LLPATH . 'flexformProduct.settings.disableHeader'),
				$value
		);
	}

	/**
	 * Get field value from flexform configuration,
	 * including checks if flexform configuration is available
	 *
	 * @param string $key name of the key
	 * @param string $sheet name of the sheet
	 * @return string|NULL if nothing found, value if found
	 */
	protected function getFieldFromFlexform($key, $sheet = 'sDEF') {
		$flexform = $this->flexformData;
		if (isset($flexform['data'])) {
			$flexform = $flexform['data'];
			if (is_array($flexform) && is_array($flexform[$sheet]) && is_array($flexform[$sheet]['lDEF'])
				&& is_array($flexform[$sheet]['lDEF'][$key]) && isset($flexform[$sheet]['lDEF'][$key]['vDEF'])
			) {
				return $flexform[$sheet]['lDEF'][$key]['vDEF'];
			}
		}

		return NULL;
	}

	/**
	 * Render the settings as table for Web>Page module
	 * System settings are displayed in mono font
	 *
	 * @return string
	 */
	protected function renderSettingsAsTable() {
		if (count($this->tableData) == 0) {
			return '';
		}

		$content = '';
		foreach ($this->tableData as $line) {
			$content .= '<strong>' . $line[0] . ':</strong>' . ' ' .$line[1] . '<br />';
		}

		return '<pre>' . $content . '</pre>';
	}

}
