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
class AusstellungController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * ausstellungRepository
	 *
	 * @var \VCA\VcaMillerntor\Domain\Repository\AusstellungRepository
	 * @inject
	 */
	protected $ausstellungRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$ausstellungs = $this->ausstellungRepository->findAll();
		$this->view->assign('ausstellungs', $ausstellungs);
	}

	/**
	 * action show
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Ausstellung $ausstellung
	 * @return void
	 */
	public function showAction(\VCA\VcaMillerntor\Domain\Model\Ausstellung $ausstellung) {
		$this->view->assign('ausstellung', $ausstellung);
	}

	/**
	 * action new
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Ausstellung $newAusstellung
	 * @dontvalidate $newAusstellung
	 * @return void
	 */
	public function newAction(\VCA\VcaMillerntor\Domain\Model\Ausstellung $newAusstellung = NULL) {
		$this->view->assign('newAusstellung', $newAusstellung);
	}

	/**
	 * action create
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Ausstellung $newAusstellung
	 * @return void
	 */
	public function createAction(\VCA\VcaMillerntor\Domain\Model\Ausstellung $newAusstellung) {
		$this->ausstellungRepository->add($newAusstellung);
		$this->flashMessageContainer->add('Your new Ausstellung was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Ausstellung $ausstellung
	 * @return void
	 */
	public function editAction(\VCA\VcaMillerntor\Domain\Model\Ausstellung $ausstellung) {
		$this->view->assign('ausstellung', $ausstellung);
	}

	/**
	 * action update
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Ausstellung $ausstellung
	 * @return void
	 */
	public function updateAction(\VCA\VcaMillerntor\Domain\Model\Ausstellung $ausstellung) {
		$this->ausstellungRepository->update($ausstellung);
		$this->flashMessageContainer->add('Your Ausstellung was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Ausstellung $ausstellung
	 * @return void
	 */
	public function deleteAction(\VCA\VcaMillerntor\Domain\Model\Ausstellung $ausstellung) {
		$this->ausstellungRepository->remove($ausstellung);
		$this->flashMessageContainer->add('Your Ausstellung was removed.');
		$this->redirect('list');
	}

}
?>