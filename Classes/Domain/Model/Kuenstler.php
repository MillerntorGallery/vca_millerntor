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
class Kuenstler extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * name
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * decription
	 *
	 * @var \string
	 */
	protected $decription;

	/**
	 * logo
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	protected $logo;

	/**
	 * werk
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Werk>
	 */
	protected $werk;
	
	/**
	 * website of artist
	 *
	 * @var \string
	 */
	protected $url;

	/**
	 * email of artist
	 *
	 * @var \string
	 */
	protected $kontaktEmail;

	/**
	 * facebook of artist
	 *
	 * @var \string
	 */
	protected $kontaktFb;

	/**
	 * twitter of artist
	 *
	 * @var \string
	 */
	protected $kontaktTw;

	/**
	 * instgram of artist
	 *
	 * @var \string
	 */
	protected $kontaktIg;

	/**
	 * other link of artist
	 *
	 * @var \string
	 */
	protected $kontaktOther;

	/**
	 * __construct
	 *
	 * @return Kuenstler
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
		$this->werk = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->logo = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the decription
	 *
	 * @return \string $decription
	 */
	public function getDecription() {
		return $this->decription;
	}

	/**
	 * Sets the decription
	 *
	 * @param \string $decription
	 * @return void
	 */
	public function setDecription($decription) {
		$this->decription = $decription;
	}

	/**
	 * Returns the url of website
	 *
	 * @return \string $url
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * Sets the url
	 *
	 * @param \string $url
	 * @return void
	 */
	public function setUrl($url) {
		$this->url = $url;
	}
	
	/**
	 * Returns the url of website
	 *
	 * @return \string $kontaktEmail
	 */
	public function getKontaktEmail() {
		return $this->kontaktEmail;
	}

	/**
	 * Sets the kontaktEmail
	 *
	 * @param \string $kontaktEmail
	 * @return void
	 */
	public function setKontaktEmail($kontaktEmail) {
		$this->kontaktEmail = $kontaktEmail;
	}
	/**
	 * Returns the facebook
	 *
	 * @return \string $kontaktFb
	 */
	public function getKontaktFb() {
		return $this->kontaktFb;
	}

	/**
	 * Sets the kontaktFb
	 *
	 * @param \string $kontaktFb
	 * @return void
	 */
	public function setKontaktFb($kontaktFb) {
		$this->kontaktFb = $kontaktFb;
	}
	/**
	 * Returns the url of website
	 *
	 * @return \string $kontaktTw
	 */
	public function getKontaktTw() {
		return $this->kontaktTw;
	}

	/**
	 * Sets the kontaktTw
	 *
	 * @param \string $kontaktTw
	 * @return void
	 */
	public function setKontaktTw($kontaktTw) {
		$this->kontaktTw = $kontaktTw;
	}
	/**
	 * Returns the url of website
	 *
	 * @return \string $kontaktIg
	 */
	public function getKontaktIg() {
		return $this->kontaktIg;
	}

	/**
	 * Sets the kontaktIg
	 *
	 * @param \string $kontaktIg
	 * @return void
	 */
	public function setKontaktIg($kontaktIg) {
		$this->kontaktIg = $kontaktIg;
	}
	/**
	 * Returns the url of website
	 *
	 * @return \string $kontaktOther
	 */
	public function getKontaktOther() {
		return $this->kontaktOther;
	}

	/**
	 * Sets the kontaktOther
	 *
	 * @param \string $kontaktOther
	 * @return void
	 */
	public function setKontaktOther($kontaktOther) {
		$this->kontaktOther = $kontaktOther;
	}

	/**
	 * Returns the logo
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $logo
	 */
	public function getLogo() {
		//return $this->logo;
		$imageFiles = array();
		/** @var \TYPO3\CMS\Extbase\Domain\Model\FileReference $logo */
		foreach ($this->logo as $image) {
			$imageFiles[] = $image->getOriginalResource()->toArray();
		}
		return $imageFiles;
	}

	/**
	 * Sets the logo
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $logo
	 * @return void
	 */
	public function setLogo($logo) {
		$this->logo = $logo;
	}
	/**
	 * Adds a Media element
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $logo
	 * @return void
	 */
	public function addLogo(\TYPO3\CMS\Extbase\Domain\Model\FileReference $logo) {
		$this->logo->attach($logo);
	}
	
	/**
	 * Removes a Media element
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $mediaToRemove The Kuenstler to be removed
	 * @return void
	 */
	public function removeLogo(\TYPO3\CMS\Extbase\Domain\Model\FileReference $mediaToRemove) {
		$this->logo->detach($mediaToRemove);
	}
	

	/**
	 * Returns the werk
	 *
	 * \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Werk> $werk
	 */
	public function getWerk() {
		return $this->werk;
	}

	/**
	 * Sets the werk
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Werk> $werk
	 * @return void
	 */
	public function setWerk(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $werk) {
		$this->werk = $werk;
	}

}
?>