<?php
namespace VCA\VcaMillerntor\Domain\Model;

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
class Galerie extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * name
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * adresse
	 *
	 * @var \string
	 */
	protected $adresse;

	/**
	 * austellungen
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Ausstellung>
	 */
	protected $austellungen;

	/**
	 * __construct
	 *
	 * @return Galerie
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->austellungen = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the name
	 *
	 * @return \string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param \string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the adresse
	 *
	 * @return \string $adresse
	 */
	public function getAdresse() {
		return $this->adresse;
	}

	/**
	 * Sets the adresse
	 *
	 * @param \string $adresse
	 * @return void
	 */
	public function setAdresse($adresse) {
		$this->adresse = $adresse;
	}

	/**
	 * Adds a Ausstellung
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Ausstellung $austellungen
	 * @return void
	 */
	public function addAustellungen(\VCA\VcaMillerntor\Domain\Model\Ausstellung $austellungen) {
		$this->austellungen->attach($austellungen);
	}

	/**
	 * Removes a Ausstellung
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Ausstellung $austellungenToRemove The Ausstellung to be removed
	 * @return void
	 */
	public function removeAustellungen(\VCA\VcaMillerntor\Domain\Model\Ausstellung $austellungenToRemove) {
		$this->austellungen->detach($austellungenToRemove);
	}

	/**
	 * Returns the austellungen
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Ausstellung> $austellungen
	 */
	public function getAustellungen() {
		return $this->austellungen;
	}

	/**
	 * Sets the austellungen
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Ausstellung> $austellungen
	 * @return void
	 */
	public function setAustellungen(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $austellungen) {
		$this->austellungen = $austellungen;
	}

}
?>