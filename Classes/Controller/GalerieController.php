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
class GalerieController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * galerieRepository
	 *
	 * @var \VCA\VcaMillerntor\Domain\Repository\GalerieRepository
	 * @inject
	 */
	protected $galerieRepository;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$galeries = $this->galerieRepository->findAll();
		$this->view->assign('galeries', $galeries);
	}

	/**
	 * action show
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Galerie $galerie
	 * @return void
	 */
	public function showAction(\VCA\VcaMillerntor\Domain\Model\Galerie $galerie) {
		$this->view->assign('galerie', $galerie);
	}

	/**
	 * action new
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Galerie $newGalerie
	 * @dontvalidate $newGalerie
	 * @return void
	 */
	public function newAction(\VCA\VcaMillerntor\Domain\Model\Galerie $newGalerie = NULL) {
		$this->view->assign('newGalerie', $newGalerie);
	}

	/**
	 * action create
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Galerie $newGalerie
	 * @return void
	 */
	public function createAction(\VCA\VcaMillerntor\Domain\Model\Galerie $newGalerie) {
		$this->galerieRepository->add($newGalerie);
		$this->flashMessageContainer->add('Your new Galerie was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Galerie $galerie
	 * @return void
	 */
	public function editAction(\VCA\VcaMillerntor\Domain\Model\Galerie $galerie) {
		$this->view->assign('galerie', $galerie);
	}

	/**
	 * action update
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Galerie $galerie
	 * @return void
	 */
	public function updateAction(\VCA\VcaMillerntor\Domain\Model\Galerie $galerie) {
		$this->galerieRepository->update($galerie);
		$this->flashMessageContainer->add('Your Galerie was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Galerie $galerie
	 * @return void
	 */
	public function deleteAction(\VCA\VcaMillerntor\Domain\Model\Galerie $galerie) {
		$this->galerieRepository->remove($galerie);
		$this->flashMessageContainer->add('Your Galerie was removed.');
		$this->redirect('list');
	}

}
?>