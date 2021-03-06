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
	 * normName
	 *
	 * @var \string
	 * @validate NotEmpty
	 */
	//protected $normName;

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
	 * @cascade remove
	 */
	protected $logo;

	/**
	 * werk
	 * @lazy
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Werk>
	 */
	protected $werk;
	
	/**
	 * ausstellung
	 * @lazy
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Ausstellung>
	 */
	protected $ausstellung;
	
	/**
	 * years
	 *
	 * @var \array
	 */
	protected $years;
	
	/**
	 * Categories
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
	 */
	protected $categories;
	
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
	protected $email;

	/**
	 * facebook of artist
	 *
	 * @var \string
	 */
	protected $facebook;

	/**
	 * twitter of artist
	 *
	 * @var \string
	 */
	protected $twitter;

	/**
	 * instgram of artist
	 *
	 * @var \string
	 */
	protected $instagram;

	/**
	 * video url of artist
	 *
	 * @var \string
	 */
	protected $video;

	/**
	 * other link of artist
	 *
	 * @var \string
	 */
	protected $other;

	/**
	 * URL regex match
	 *
	 * @var \string
	 */
	protected $_urlMatcher = "/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/";

	/**
	 * _languageUid
	 * @var int
	 */
	protected $_languageUid;

	/**
	 * @param int $_languageUid
	 * @return void
	 */
	public function set_languageUid($_languageUid) {
	    $this->_languageUid = $_languageUid;
	}

	/**
	 * @return int
	 */
	public function get_languageUid() {
	    return $this->_languageUid;
	}

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
		$this->ausstellung = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->logo = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->categories = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}


	/**
	 * Returns the name
	 *
	 * @return \string $name
	 */
	public function getName() {
		return ucfirst($this->name);
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
	 * Returns the normailzed name
	 *
	 * @return \string $normName
	 */
	/*public function getNormName() {
		return ucfirst($this->normName);
	}*/
	
	/**
	 * Sets and normailze the name
	 *
	 * @param \string $name
	 * @return void
	 */
	/*public function setNormName($name) {
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
		$this->normName = strtr($name, $normalizeChars);
	}*/

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
	 * @return \string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param \string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}
	/**
	 * Returns the facebook
	 *
	 * @return \string $facebook
	 */
	public function getFacebook() {
		if(empty($this->facebook )) {
			return $this->facebook;
		}
		else if(preg_match($this->_urlMatcher,$this->facebook)) {
			return $this->facebook;
		} else {
			return "https://www.facebook.com/".$this->facebook;
		}
		
	}

	/**
	 * Sets the facebook
	 *
	 * @param \string $facebook
	 * @return void
	 */
	public function setFacebook($facebook) {
		$this->facebook = $facebook;
	}
	/**
	 * Returns the url of website
	 *
	 * @return \string $twitter
	 */
	public function getTwitter() {
		if(empty($this->twitter )) {
			return $this->twitter;
		}
		else if(preg_match($this->_urlMatcher,$this->twitter)) {
			return $this->twitter;	
		} else {
			return "https://www.twitter.com/".$this->twitter;
		}
	}

	/**
	 * Sets the twitter
	 *
	 * @param \string $twitter
	 * @return void
	 */
	public function setTwitter($twitter) {
		$this->twitter = $twitter;
	}
	/**
	 * Returns the url of website
	 *
	 * @return \string $instagram
	 */
	public function getInstagram() {
		if(empty($this->instagram )) {
			return $this->instagram;
		}
		else if(preg_match($this->_urlMatcher,$this->instagram)) {
			return $this->instagram;	
		} else {
			return "https://www.instagram.com/".$this->instagram;
		}
	}

	/**
	 * Sets the instagram
	 *
	 * @param \string $instagram
	 * @return void
	 */
	public function setInstagram($instagram) {
		$this->instagram = $instagram;
	}
	/**
	 * Returns the url of website
	 *
	 * @return \string $other
	 */
	public function getOther() {
		return $this->other;
	}

	/**
	 * Sets the other
	 *
	 * @param \string $other
	 * @return void
	 */
	public function setOther($other) {
		$this->other = $other;
	}

	/**
	 * Returns the video url of artist
	 *
	 * @return \string $video
	 */
	public function getVideo() {
		return $this->video;
	}

	/**
	 * Sets the video url
	 *
	 * @param \string $video
	 * @return void
	 */
	public function setVideo($video) {
		$this->video = $video;
	}

	/**
	 * Returns the logo
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $logo
	 */
	public function getLogo() {
		return $this->logo;
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
	
	/**
	 * Returns the ausstellung
	 *
	 * \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\VCA\VcaMillerntor\Domain\Model\Ausstellung> $ausstellung
	 */
	public function getAusstellung() {
		return $this->ausstellung;
	}
	
	public function getYears() {
		foreach ($this->getAusstellung() as $ausstellung) {
			$this->years[] = $ausstellung->getStart()->format('Y');
		}
		return $this->years;
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
	 * Adds a Category
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
	 * @return void
	 */
	public function addCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category) {
		$this->categories->attach($category);
	}
	
	/**
	 * Removes a Category
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\Category $categoryToRemove The Category to be removed
	 * @return void
	 */
	public function removeCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $categoryToRemove) {
		$this->categories->detach($categoryToRemove);
	}
	
	/**
	 * Returns the categories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category> $categories
	 */
	public function getCategories() {
		return $this->categories;
	}
	
	/**
	 * Sets the categories
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category> $categories
	 * @return void
	 */
	public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories) {
		$this->categories = $categories;
	}

}
?>