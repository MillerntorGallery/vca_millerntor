<?php
namespace VCA\VcaMillerntor\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 fux <sfuchs@projektkater.de>
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
 *
 *
 * @package vca_millerntor
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class KuenstlerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * kuenstlerRepository
	 *
	 * @var \VCA\VcaMillerntor\Domain\Repository\KuenstlerRepository
	 * @inject
	 */
	protected $kuenstlerRepository;
	/**
	 * ausstellungRepository
	 *
	 * @var \VCA\VcaMillerntor\Domain\Repository\AusstellungRepository
	 * @inject
	 */
	protected $ausstellungRepository;
	/**
	 * categoryRepository
	 *
	 * @var TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		if(isset($this->settings['showAusstellung']) && intval($this->settings['showAusstellung']) > 0) {
			//only list artists selected by ausstellung
			$kuenstlers = $this->kuenstlerRepository->findAllByAusstellung($this->settings['showAusstellung']);
			$view_variables['ausstellung'] = $this->ausstellungRepository->findOneByUid($this->settings['showAusstellung']);
		} else {
			$kuenstlers = $this->kuenstlerRepository->findAll();
			/*
			foreach ($kuenstlers as $index=>$kuenstler) {
				$kuenstlers[$index]->years = $kuenstler->getAusstellungsYears();
			}
			*/
			$view_variables['years'] = $this->setupYearsList($kuenstlers);
			
				
		}
		
		if(isset($this->settings['showCategory']) && intval($this->settings['showCategory']) > 0 ) {
			foreach($kuenstlers as $kuenstler) {
				$cats = $kuenstler->getCategories();
				foreach($cats as $cat) {
					if($cat->getUid() == intval($this->settings['showCategory']) ) {
						$cat_kuenstler[$kuenstler->getUid()] = $kuenstler;
					}
				}
			}
			$kuenstlers = $cat_kuenstler;
			$view_variables['category'] = $this->categoryRepository->findOneByUid($this->settings['showCategory']);
		} else {
			$view_variables['categories'] = $this->setupCategoryList($kuenstlers);
		}
		
		//print_r($chars);
		
		$view_variables['kuenstlers'] = $kuenstlers;
		$view_variables['selected_categories'] = $this->settings['showCategory'];
		$view_variables['alphabet'] = $this->setupAlphabetList($kuenstlers);
		
		$this->view->assign('view_variables', $view_variables);
	}
	
	/**
	 * TODO: find out availible years by kuenstler
	 * @param unknown $kuenstlers
	 * @return multitype:string
	 */
	public function setupYearsList($kuenstlers = array()) {
		
		
		
		return array('2013','2014','2015','2016');
	}
	/**
	 * TODO: find out availible categories by kuenstler
	 * @param unknown $kuenstlers
	 * @return multitype:string
	 */
	public function setupCategoryList($kuenstlers = array()) {
		/*
			foreach ($kuenstlers as $index=>$kuenstler) {
			$kuenstlers[$index]->years = $kuenstler->getAusstellungsYears();
			}
			*/
		return array(1=>'Art',2=>'Music',3=>'Education',4=>'Cultur');
	}
	
	public function setupAlphabetList(&$kuenstlers = array()) {
		//setup alphabetical index
		
		$normalizeChars = array(
				'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
				'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
				'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
				'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
				'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
				'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
				'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
				'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T',
		);
		
		$chars = array();
		foreach($kuenstlers as $index=>$artist) {
			//echo $artist->getName();
			//$char = strtoupper(substr($artist->getName(),0,1));
			$char = mb_substr($artist->getName(),0,1,'utf-8');
			$char = strtr($char, $normalizeChars);
			$char = strtoupper($char);
			$kuenstlers[$index]->normName = $char;
			//$char = utf8_encode($char);
			//$char = iconv('UTF-8', 'ASCII//TRANSLIT', $char);
			$chars[$char]++;
		}
		return $chars;
	}

	/**
	 * action teaser
	 *
	 * @return void
	 */
	public function teaserAction() {
		$kuenstlers = $this->kuenstlerRepository->findAll();
		/*
		if($this->settings['flexform']['switchableControllerActions']=='Teaser.html') {
			$this->view->setTemplatePathAndFilename(
					'typo3conf/ext/' .
					$this->request->getControllerExtensionKey() .
					'/Resources/Private/Templates/Kuenstler/Teaser.html'
			);
		}
		*/
		$this->view->assign('kuenstlers', $kuenstlers);
	}
	/**
	 * action show
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Kuenstler $kuenstler
	 * @return void
	 */
	public function showAction(\VCA\VcaMillerntor\Domain\Model\Kuenstler $kuenstler) {
		$GLOBALS['TSFE']->page['title'] = $kuenstler->getName();
		$GLOBALS['TSFE']->indexedDocTitle = $kuenstler->getName();
		
		$this->view->assign('kuenstler', $kuenstler);
	}
	/**
	 * action insertRecord
	 *
	 * @return void
	 */
	public function insertRecordAction() {
		if(isset($this->settings['displayItem'])) {
		
			$uid = $this->settings['displayItem'];
			$this->view->assign('kuenstler', $this->kuenstlerRepository->findOneByUid($uid));
		} else {
			//TODO: stop displaying view
		}
	}

	/**
	 * action new
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Kuenstler $newKuenstler
	 * @dontvalidate $newKuenstler
	 * @return void
	 */
	public function newAction(\VCA\VcaMillerntor\Domain\Model\Kuenstler $newKuenstler = NULL) {
		$this->view->assign('newKuenstler', $newKuenstler);
	}

	/**
	 * action create
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Kuenstler $newKuenstler
	 * @return void
	 */
	public function createAction(\VCA\VcaMillerntor\Domain\Model\Kuenstler $newKuenstler) {
		$this->kuenstlerRepository->add($newKuenstler);
		$this->flashMessageContainer->add('Your new Kuenstler was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Kuenstler $kuenstler
	 * @return void
	 */
	public function editAction(\VCA\VcaMillerntor\Domain\Model\Kuenstler $kuenstler) {
		$this->view->assign('kuenstler', $kuenstler);
	}

	/**
	 * action update
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Kuenstler $kuenstler
	 * @return void
	 */
	public function updateAction(\VCA\VcaMillerntor\Domain\Model\Kuenstler $kuenstler) {
		$this->kuenstlerRepository->update($kuenstler);
		$this->flashMessageContainer->add('Your Kuenstler was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Kuenstler $kuenstler
	 * @return void
	 */
	public function deleteAction(\VCA\VcaMillerntor\Domain\Model\Kuenstler $kuenstler) {
		$this->kuenstlerRepository->remove($kuenstler);
		$this->flashMessageContainer->add('Your Kuenstler was removed.');
		$this->redirect('list');
	}

}
?>