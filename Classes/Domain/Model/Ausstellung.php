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
class Ausstellung extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * description
	 *
	 * @var \string
	 */
	protected $description;

	/**
	 * start
	 *
	 * @var \DateTime
	 * @validate NotEmpty
	 */
	protected $start;

	/**
	 * end
	 *
	 * @var \DateTime
	 */
	protected $end;

	/**
	 * werke
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Werk>
	 */
	protected $werke;
	
	/**
	 * kuenstler
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Kuenstler>
	 */
	protected $kuenstler;
	
	/**
	 * __construct
	 *
	 * @return Ausstellung
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
		$this->werke = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->kuenstler = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return \string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param \string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the description
	 *
	 * @return \string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param \string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the start
	 *
	 * @return \DateTime $start
	 */
	public function getStart() {
		return $this->start;
	}

	/**
	 * Sets the start
	 *
	 * @param \DateTime $start
	 * @return void
	 */
	public function setStart($start) {
		$this->start = $start;
	}

	/**
	 * Returns the end
	 *
	 * @return \DateTime $end
	 */
	public function getEnd() {
		return $this->end;
	}

	/**
	 * Sets the end
	 *
	 * @param \DateTime $end
	 * @return void
	 */
	public function setEnd($end) {
		$this->end = $end;
	}

	/**
	 * Adds a Werk
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Werk $werke
	 * @return void
	 */
	public function addWerke(\VCA\VcaMillerntor\Domain\Model\Werk $werke) {
		$this->werke->attach($werke);
	}

	/**
	 * Removes a Werk
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Werk $werkeToRemove The Werk to be removed
	 * @return void
	 */
	public function removeWerke(\VCA\VcaMillerntor\Domain\Model\Werk $werkeToRemove) {
		$this->werke->detach($werkeToRemove);
	}

	/**
	 * Returns the werke
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Werk> $werke
	 */
	public function getWerke() {
		return $this->werke;
	}

	/**
	 * Sets the werke
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Werk> $werke
	 * @return void
	 */
	public function setWerke(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $werke) {
		$this->werke = $werke;
	}
	/**
	 * Adds a Kuenstler
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Kuenstler $kuenstler
	 * @return void
	 */
	public function addKuenstler(\VCA\VcaMillerntor\Domain\Model\Kuenstler $kuenstler) {
		$this->kuenstler->attach($kuenstler);
	}

	/**
	 * Removes a Kuenstler
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Kuenstler $kuenstlerToRemove The Kuenstler to be removed
	 * @return void
	 */
	public function removeKuenstler(\VCA\VcaMillerntor\Domain\Model\Kuenstler $kuenstlerToRemove) {
		$this->kuenstler->detach($kuenstlerToRemove);
	}

	/**
	 * Returns the Kuenstler
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Kuenstler> $kuenstler
	 */
	public function getKuenstler() {
		return $this->kuenstler;
	}

	/**
	 * Sets the kuenstler
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Kuenstler> $kuenstler
	 * @return void
	 */
	public function setKuenstler(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $kuenstler) {
		$this->kuenstler = $kuenstler;
	}

}
?>