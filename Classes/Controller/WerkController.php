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
class WerkController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * werkRepository
	 *
	 * @var \VCA\VcaMillerntor\Domain\Repository\WerkRepository
	 * @inject
	 */
	protected $werkRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$werks = $this->werkRepository->findAll();
		$this->view->assign('werks', $werks);
	}

	/**
	 * action show
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Werk $werk
	 * @return void
	 */
	public function showAction(\VCA\VcaMillerntor\Domain\Model\Werk $werk) {
		$this->view->assign('werk', $werk);
	}
	/**
	 * action insertRecord
	 *
	 * @return void
	 */
	public function insertRecordAction() {
		if(isset($this->settings['displayItem'])) {
	
			$uid = $this->settings['displayItem'];
			$this->view->assign('werk', $this->werkRepository->findOneByUid($uid));
		} else {
			//TODO: stop displaying view
		}
	}
	/**
	 * action new
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Werk $newWerk
	 * @dontvalidate $newWerk
	 * @return void
	 */
	public function newAction(\VCA\VcaMillerntor\Domain\Model\Werk $newWerk = NULL) {
		$this->view->assign('newWerk', $newWerk);
	}

	/**
	 * action create
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Werk $newWerk
	 * @return void
	 */
	public function createAction(\VCA\VcaMillerntor\Domain\Model\Werk $newWerk) {
		$this->werkRepository->add($newWerk);
		$this->flashMessageContainer->add('Your new Werk was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Werk $werk
	 * @return void
	 */
	public function editAction(\VCA\VcaMillerntor\Domain\Model\Werk $werk) {
		$this->view->assign('werk', $werk);
	}

	/**
	 * action update
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Werk $werk
	 * @return void
	 */
	public function updateAction(\VCA\VcaMillerntor\Domain\Model\Werk $werk) {
		$this->werkRepository->update($werk);
		$this->flashMessageContainer->add('Your Werk was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Werk $werk
	 * @return void
	 */
	public function deleteAction(\VCA\VcaMillerntor\Domain\Model\Werk $werk) {
		$this->werkRepository->remove($werk);
		$this->flashMessageContainer->add('Your Werk was removed.');
		$this->redirect('list');
	}

}
?>