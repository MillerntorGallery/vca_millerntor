<?php
/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Update class for the extension manager.
 *
 * @package TYPO3
 * @subpackage tx_vcamillerntor
 */
class ext_update {

	const ARTIST_FOLDER_IMAGES = '/media/2015/artists/';

	/**
	 * Array of flash messages (params) array[][status,title,message]
	 *
	 * @var array
	 */
	protected $messageArray = array();

	/**
	 * @var \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected $databaseConnection;

	/**
	 * @var \TYPO3\CMS\Core\Resource\ResourceFactory
	 */
	protected $resourceFactory;

	/**
	 * @var \TYPO3\CMS\Core\Resource\Folder
	 */
	protected $artistImageFolder;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->databaseConnection = $GLOBALS['TYPO3_DB'];

		$this->resourceFactory = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\ResourceFactory');

	}

	/**
	 * Main update function called by the extension manager.
	 *
	 * @return string
	 */
	public function main() {
		$this->processUpdates();
		return $this->generateOutput();
	}

	/**
	 * Called by the extension manager to determine if the update menu entry
	 * should by showed.
	 *
	 * @return bool
	 * @todo find a better way to determine if update is needed or not.
	 */
	public function access() {
		return TRUE;
	}

	/**
	 * The actual update function. Add your update task in here.
	 *
	 * @return void
	 */
	protected function processUpdates() {

		$this->updateArtistImages();
	}





	/**
	 * Migrate news_category.image (CSV) to sys_category.images (sys_file_reference)
	 *
	 * @return void
	 */
	protected function updateArtistImages() {
		
		$artists = $this->getArtistsNames();
		
		$folder = $this->getArtistImageFolder();
		
		$filesInSubFolder = $folder->getFiles();

		$filearr = array();
		foreach($filesInSubFolder as $file) {
			//$message = 'Migrated ' . $processedImages . ' category images';
			//$name
			$name = str_replace(' ','',strtolower($file->getName()));
			$uid = $file->getUid();
			$file_arr[$uid] = $name;
			//if($name == $arter['noblank'])
			$message = 'File';
			$status = FlashMessage::INFO;
				
			$this->messageArray[] = array($status, $name, $message);
		}
		
		foreach($artists as $arter) {
			$found = false;
			$artistFound = preg_match("/(" . implode(self::$forbidden_name,"|") . ")/i", $arter);
			
			$message = 'xx';
			$status = FlashMessage::INFO;
			
			$this->messageArray[] = array($status, $name, $message);
				
		}
		
	}

	/**
	 * Get Artist Image folder
	 *
	 * @return \TYPO3\CMS\Core\Resource\Folder|void
	 * @throws \Exception
	 */
	protected function getArtistImageFolder() {
		if ($this->artistImageFolder === NULL) {

			$storage = $this->resourceFactory->getDefaultStorage();
			if (!$storage) {
				throw new \Exception('No default storage set!');
			}
			try {
				$this->artistImageFolder = $storage->getFolder(self::ARTIST_FOLDER_IMAGES);
			} catch (\TYPO3\CMS\Core\Resource\Exception\FolderDoesNotExistException $exception) {
				$this->artistImageFolder = $storage->createFolder(self::ARTIST_FOLDER_IMAGES);
			}
		}
		return $this->artistImageFolder;
	}

	/**
	 * Get Artists by name
	 *
	 * @return array|void
	 */
	protected function getArtistsNames() {
		$artists = array();
		$artistsQuery = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid,name', 'tx_vcamillerntor_domain_model_kuenstler', 'deleted=0 AND sys_language_uid=0');
		while ($artistRow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($artistsQuery)) {
			$artists[$artistRow['uid']] = array('uid'=>$artistRow['uid'],'name'=>$artistRow['name'],'noblank'=>str_replace(' ','',strtolower($artistRow['name'])));
			$message = 'Artist';
			$status = FlashMessage::INFO;
			
			$this->messageArray[] = array($status, $artistRow['name'], $message);
		}	
		return $artists;
	}

	/**
	 * Generates output by using flash messages
	 *
	 * @return string
	 */
	protected function generateOutput() {
		$output = '';
		foreach ($this->messageArray as $messageItem) {
			/** @var \TYPO3\CMS\Core\Messaging\FlashMessage $flashMessage */
			$flashMessage = GeneralUtility::makeInstance(
				'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
				$messageItem[2],
				$messageItem[1],
				$messageItem[0]);
			$output .= $flashMessage->render();
		}
		return $output;
	}

}
