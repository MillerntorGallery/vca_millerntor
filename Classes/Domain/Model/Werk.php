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
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	protected $media;

	/**
	 * artist
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Kuenstler>
	 */
	protected $artist;
	/**
	 * ausstellung
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Ausstellung>
	 */
	protected $ausstellung;
	
	/**
	 * material
	 *
	 * @var \string
	 */
	protected $material;

	/**
	 * sizes
	 *
	 * @var \string
	 */
	protected $sizes;

	/**
	 * year
	 *
	 * @var \string
	 */
	protected $year;

	/**
	 * technic
	 *
	 * @var \string
	 */
	protected $technic;

	/**
	 * buyUrl
	 *
	 * @var \string
	 */
	protected $buyUrl;

	/**
	 * __construct
	 *
	 * @return Werk
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
		//print_r($this->media);
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
		$this->media = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	public function getMedia() {
		$imageFiles = array();
		/** @var \TYPO3\CMS\Extbase\Domain\Model\FileReference $image */
		foreach ($this->media as $image) {
			$imageFiles[] = $image->getOriginalResource()->toArray();
		}
		return $imageFiles;
		//return $this->media;
		//return explode(',', $this->media);
		/*return 'lala';
		if (!is_object($this->media)){
			return null;
		} elseif ($this->media instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy) {
			$this->media->_loadRealInstance();
		}
		return $this->media->getOriginalResource();
		*/
	}

	/**
	 * Sets the media
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $media
	 * @return void
	 */
	public function setMedia($media) {
		$this->media = $media;
	}
	/**
	 * Adds a Media element
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $media
	 * @return void
	 */
	public function addMedia(\TYPO3\CMS\Extbase\Domain\Model\FileReference $media) {
		$this->media->attach($media);
	}
	
	/**
	 * Removes a Media element
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $mediaToRemove The Kuenstler to be removed
	 * @return void
	 */
	public function removeMedia(\TYPO3\CMS\Extbase\Domain\Model\FileReference $mediaToRemove) {
		$this->media->detach($mediaToRemove);
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
	/**
	 * Adds a Ausstellung
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Ausstellung $ausstellung
	 * @return void
	 */
	public function addAusstellung(\VCA\VcaMillerntor\Domain\Model\Ausstellung $ausstellung) {
		$this->ausstellung->attach($ausstellung);
	}

	/**
	 * Removes a Ausstellung
	 *
	 * @param \VCA\VcaMillerntor\Domain\Model\Ausstellung $ausstellungToRemove The Ausstellung to be removed
	 * @return void
	 */
	public function removeAusstellung(\VCA\VcaMillerntor\Domain\Model\Ausstellung $ausstellungToRemove) {
		$this->ausstellung->detach($ausstellungToRemove);
	}

	/**
	 * Returns the ausstellung
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Ausstellung> $ausstellung
	 */
	public function getAusstellung() {
		return $this->ausstellung;
	}

	/**
	 * Sets the ausstellung
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Ausstellung> $ausstellung
	 * @return void
	 */
	public function setAusstellung(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $ausstellung) {
		$this->ausstellung = $ausstellung;
	}
	
	/**
	 * Returns the material
	 *
	 * @return \string $material
	 */
	public function getMaterial() {
		return $this->material;
	}
	
	/**
	 * Sets the material
	 *
	 * @param \string $material
	 * @return void
	 */
	public function setMaterial($material) {
		$this->material = $material;
	}
	
	/**
	 * Returns the year
	 *
	 * @return \string $year
	 */
	public function getYear() {
		return $this->year;
	}
	
	/**
	 * Sets the year
	 *
	 * @param \string $year
	 * @return void
	 */
	public function setYear($year) {
		$this->year = $year;
	}
	
	/**
	 * Returns the technic
	 *
	 * @return \string $technic
	 */
	public function getTechnic() {
		return $this->technic;
	}
	
	/**
	 * Sets the technic
	 *
	 * @param \string $technic
	 * @return void
	 */
	public function setTechnic($technic) {
		$this->technic = $technic;
	}
	
	/**
	 * Returns the buyUrl
	 *
	 * @return \string $buyUrl
	 */
	public function getBuyUrl() {
		return $this->buyUrl;
	}
	
	/**
	 * Sets the buyUrl
	 *
	 * @param \string $buyUrl
	 * @return void
	 */
	public function setBuyUrl($buyUrl) {
		$this->buyUrl = $buyUrl;
	}
	
	/**
	 * Returns the sizes
	 *
	 * @return \string $sizes
	 */
	public function getSizes() {
		return $this->sizes;
	}
	
	/**
	 * Sets the sizes
	 *
	 * @param \string $sizes
	 * @return void
	 */
	public function setSizes($sizes) {
		$this->sizes = $sizes;
	}
	

}
?>