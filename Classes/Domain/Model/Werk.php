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
class Werk extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

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
	 * media
	 *
	 * @var \string
	 */
	protected $media;

	/**
	 * artist
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Kuenstler>
	 */
	protected $artist;

	/**
	 * __construct
	 *
	 * @return Werk
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
		$this->artist = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the media
	 *
	 * @return \string $media
	 */
	public function getMedia() {
		//return $this->media;
		return explode(',', $this->media);
	}

	/**
	 * Sets the media
	 *
	 * @param \string $media
	 * @return void
	 */
	public function setMedia($media) {
		$this->media = $media;
	}

	/**
	 * Adds a Kuenstler
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Kuenstler $artist
	 * @return void
	 */
	public function addArtist(\VCA\VcaMillerntor\Domain\Model\Kuenstler $artist) {
		$this->artist->attach($artist);
	}

	/**
	 * Removes a Kuenstler
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Kuenstler $artistToRemove The Kuenstler to be removed
	 * @return void
	 */
	public function removeArtist(\VCA\VcaMillerntor\Domain\Model\Kuenstler $artistToRemove) {
		$this->artist->detach($artistToRemove);
	}

	/**
	 * Returns the artist
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Kuenstler> $artist
	 */
	public function getArtist() {
		return $this->artist;
	}

	/**
	 * Sets the artist
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Kuenstler> $artist
	 * @return void
	 */
	public function setArtist(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $artist) {
		$this->artist = $artist;
	}

}
?>