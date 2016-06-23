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

	/**
	 * Array of flash messages (params) array[][status,title,message]
	 *
	 * @var array
	 */
	protected $messageArray = array();

	/**
	 * Array of configuration values (params) array[][key=>value]
	 *
	 * @var array
	 */
	protected $configurationArray = array();

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
		$this->configurationArray = array(
			'ausstellungUid'=>'4',
			'categoryUid'=>'1',
			'imagePath' => '/media/2015/artists_web/',	
			'csvPath' => '/artistmg5.csv'	
		);
		
		$this->databaseConnection = $GLOBALS['TYPO3_DB'];

		$this->resourceFactory = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\ResourceFactory');

	}

	/**
	 * Main update function called by the extension manager.
	 *
	 * @return string
	 */
	public function main() {
		if (t3lib_div::_POST('update_submit') != '') {
			$this->configurationArray['imagePath'] = t3lib_div::_POST('imagePath');
			$this->configurationArray['ausstellungUid'] = t3lib_div::_POST('ausstellungUid');
			$this->processUpdates();
			$content = '<b>Update durchgeführt</b>';
		} else if (t3lib_div::_POST('insert_submit') != '') {
			$this->configurationArray['csvPath'] = t3lib_div::_POST('csvPath');
			$this->configurationArray['ausstellungUid'] = t3lib_div::_POST('ausstellungUid');
			$this->processInserts();
			$content = '<b>Inserts durchgeführt</b>';
		} else {
			$content = $this->generateForm();
		}
		
		
		return $this->generateOutput($content);
	}
	
	/**
	 * Shows a formular.
	 *
	 * @return string
	 */
	protected function generateForm() {
		return
		'<form action="' . t3lib_div::getIndpEnv('REQUEST_URI') . '" method="POST">' .
		'<h2>Update</h2>' .
		'<p>This script will do the following:</p>' .
		'<ul >' .
		'<li>Search for images in folder: <input type="text" style="width:300px;" name="imagePath" value="'.$this->configurationArray['imagePath'].'" /></li>' .
		'<li>Update Artists by Ausstellungs-ID: <input type="text" name="ausstellungUid" value="'.$this->configurationArray['ausstellungUid'].'" /></li>' .
		'</ul>' .
		'<p><b>Warning!</b> Images will be added</p>' .
		'<br />' .
		'<input type="submit" name="update_submit" value="Update" />'.
		'<br />' .
		'<h2>Insert</h2>' .
		'<p>This script will do the following:</p>' .
		'<ul >' .
		'<li>Search for csv file at: <input type="text" style="width:300px;" name="csvPath" value="'.$this->configurationArray['csvPath'].'" /></li>' .
		'<li>Insert Artists by Ausstellungs-ID: <input type="text" name="ausstellungUid" value="'.$this->configurationArray['ausstellungUid'].'" /></li>' .
		'<li>Insert Artists with Category-ID: <input type="text" name="categoryUid" value="'.$this->configurationArray['categoryUid'].'" /></li>' .
		'</ul>' .
		'<p><b>Warning!</b> Artists will be added</p>' .
		'<br />' .
		
		'<input type="submit" name="insert_submit" value="Insert" />'.
		'</form>';
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
	 * The actual update function. Add your update task in here.
	 *
	 * @return void
	 */
	protected function processInserts() {

		$this->insertArtists();
	}

	protected function insertArtists() {
	
		$artists = $this->getArtistsNames();
		//$csvFile = $this->getCSVFile();
		
		$table = 'tx_vcamillerntor_domain_model_kuenstler';
		
		$row_count = 1;
		if(file_exists(PATH_site.$this->configurationArray['csvPath'])) {
		if (($handle = fopen(PATH_site.$this->configurationArray['csvPath'], "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 4000, ";", '"')) !== FALSE) {
				$num = count($data);
				
				$result = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $table, ' LOWER(name) LIKE ("'.strtolower($data[0]).'") AND sys_language_uid=0');
				if(! $result )
				{
					//die('Could not enter data: ' . mysql_error());
				} else {
					if ($GLOBALS['TYPO3_DB']->sql_num_rows($result) == 0) {
		
						//INSERT
						$retval = $GLOBALS['TYPO3_DB']->exec_INSERTquery($table, 
								array(
										'name' => $data[0], 
										'decription' => $data[4],
										'url' => $data[1],
										'facebook' => $data[2],
										'other' => $data[3],
										'pid' => '4',
										'tstamp' => 'TIMESTAMP(NOW())',
										'crdate' => 'TIMESTAMP(NOW())' 
								));
						if(! $retval )
						{
							//die('Could not enter data: ' . mysql_error());
						}
						$uid = $GLOBALS['TYPO3_DB']->sql_insert_id();
						//insert category relation
						$retcat = $GLOBALS['TYPO3_DB']->exec_INSERTquery('sys_category_record_mm',
								array(
										'uid_local' => $this->configurationArray['categoryUid'],
										'uid_foreign' => $uid,
										'tablenames' => $table,
										'fieldname' => 'categories',
										'sorting' => '0',
										'sorting_foreign' => '0'
								));
						$this->messageArray[] = array(FlashMessage::OK, 'Insert: '.$uid, $data[0]);
		
					} else {
						//UPDATE
						while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result)) {
							$retval = $GLOBALS['TYPO3_DB']->exec_UPDATEquery($table, 'uid='.$row['uid'], 
									array(
											'decription' => $data[4], 
											'url' => $data[1],
											'facebook' => $data[2],
											'other' => $data[3]
							
									));
							if(! $retval )
							{
								//die('Could not enter data: ' . mysql_error());
							}
		
							
							$uid = $row['uid'];
							$this->messageArray[] = array(FlashMessage::OK, 'Update: '.$uid, $row['name']);
		
						}
					}
		
					//create translation
					//search translation
					$result_trans = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $table, ' LOWER(name) LIKE ("'.strtolower($data[0]).'") AND sys_language_uid=1');
					if(! $result_trans )
					{
						//die('Could not find translation data: ' . mysql_error());
					} else {
						if ($GLOBALS['TYPO3_DB']->sql_num_rows($result_trans) == 0) {
		
							//INSERT new translation
							$retval_trans = $GLOBALS['TYPO3_DB']->exec_INSERTquery($table,
									array(
											'name' => $data[0],
											'decription' => $data[5],
											'sys_language_uid' => '1',
											'pid' => '4',
											'l10n_parent' => $uid,
											'tstamp' => 'TIMESTAMP(NOW())',
											'crdate' => 'TIMESTAMP(NOW())'
									));
							if(! $retval_trans )
							{
								//die('Could not enter data: ' . mysql_error());
							}
							$uid_trans = $GLOBALS['TYPO3_DB']->sql_insert_id();
		
								
								
						} else {
							//UPDATE translation
							while ($row_trans = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($result_trans)) {
								$retval = $GLOBALS['TYPO3_DB']->exec_UPDATEquery($table, 'uid='.$row_trans['uid'],
										array(
												'decription' => $data[5]
										));
								if(! $retval_trans )
								{
									//die('Could not enter data: ' . mysql_error());
								}
								$uid_trans = $row_trans['uid'];
							}
						}
					}
						
				}
				 
				//SET Gallery 
				//
				// Already set?
				$res_gal = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', 'tx_vcamillerntor_ausstellung_kuenstler_mm', ' uid_local='.$this->configurationArray['ausstellungUid'].' AND uid_foreign='.$uid);
				if ($GLOBALS['TYPO3_DB']->sql_num_rows($res_gal) == 0) {
					$retval = $GLOBALS['TYPO3_DB']->exec_INSERTquery('tx_vcamillerntor_ausstellung_kuenstler_mm',
							array(
									'uid_local' => $this->configurationArray['ausstellungUid'],
									'uid_foreign' => $uid
							));
				}
				$row_count++;
			}
			fclose($handle);
		} else {
			$this->messageArray[] = array(FlashMessage::WARNING, 'fopen', 'not found: '.$this->configurationArray['csvPath']);
		}
		} else {
			$this->messageArray[] = array(FlashMessage::WARNING, 'file_exists', 'not found: '.$this->configurationArray['csvPath']);
		}
		
		
		$this->messageArray[] = array(FlashMessage::WARNING, 'Finished', 'Records verarbeitet: '.$row_count);
		
	}
	
	/**
	 * Get csv data
	 *
	 * @return \TYPO3\CMS\Core\Resource\Folder|void
	 * @throws \Exception
	 */
	protected function getCSVFile() {
		if ($this->artistCSVObject === NULL) {
	
			$storage = $this->resourceFactory->getDefaultStorage();
			if (!$storage) {
				throw new \Exception('No default storage set!');
			}
			try {
				$this->artistCSVObject = $storage->retrieveFileOrFolderObject($this->configurationArray['csvPath']);
				
			} catch (\TYPO3\CMS\Core\Resource\Exception\FolderDoesNotExistException $exception) {
				//$this->artistImageFolder = $storage->createFolder($this->configurationArray['imagePath']);
			}
		}
		return $this->artistCSVObject;
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

		$file_arr = array();
		foreach($filesInSubFolder as $file) {
			//$message = 'Migrated ' . $processedImages . ' category images';
			//$name
			$name = str_replace(array(' ','-','.','_'),array('','','',''),strtolower($file->getName()));
			$uid = $file->getUid();
			$file_arr[$uid] = $name;
			//if($name == $arter['noblank'])
			$message = 'File';
			$status = FlashMessage::INFO;
				
			//$this->messageArray[] = array($status, $name, $message);
		}
		$count_artists = 0;
		$count_artists_found = 0;
		$count_artists_notfound = 0;
		
		foreach($artists as $arter) {
			$count_artists++;
			$found = false;
			$found_key = 0;
			$found_value = '';
			foreach($file_arr as $file_key=>$file_val) {
				$found = preg_match("/" . preg_quote($arter['noblank']) . "/i", $file_val);
				$found_key = $file_key;
				$found_value = $file_val;
				
				if($found) break;
			}
			
			if($found && $found_key > 0) {
				//sort old references higher
				$res = $GLOBALS['TYPO3_DB']->exec_UPDATEquery( 
						'sys_file_reference'
						, 'uid_foreign = '.$arter['uid']
						, array('sorting_foreign' => 'sorting_foreign + 1')
						, array('sorting_foreign')
				);
				// $res : richtige Syntax, das kann aber auch heißen dass trotzdem keine Datensätze verändert wurden. daher:
				$cnt = $GLOBALS['TYPO3_DB']->sql_affected_rows();
				
				//insert reference
				
				$data = array();
				$data['sys_file_reference']['NEW'.$found_key] = array(
					'uid_local' => $found_key,
					'uid_foreign' => $arter['uid'], // uid of your content record
					'tablenames' => 'tx_vcamillerntor_domain_model_kuenstler',
					'fieldname' => 'logo',
					'pid' => 4, // parent id of the parent page
					'table_local' => 'sys_file',
					'sorting_foreign' => '-1',	
				);
				$data['tx_vcamillerntor_domain_model_kuenstler'][$arter['uid']] = array('logo' => 'NEW'.$found_key); // set to the number of images?
				 
				/** @var \TYPO3\CMS\Core\DataHandling\DataHandler $tce */
				$tce = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\DataHandling\DataHandler'); // create TCE instance
				$tce->start($data, array());					 
				$tce->process_datamap();
				
				$message = $arter['noblank'].' found '.$found_value;
				if ($tce->errorLog) {
				    $message .= 'TCE->errorLog:'.t3lib_utility_Debug::viewArray($tce->errorLog);
				} else {
					if($cnt > 0) {
						$message .= '<br>earlyer images incremended: '.$cnt;
					}
				    $message .= '<br>image changed <br>'.t3lib_utility_Debug::viewArray($data);
				}
				
				
				
				
				$status = FlashMessage::OK;
				$count_artists_found++;
			} else {
				$message = $arter['noblank'].' not found';
				$status = FlashMessage::WARNING;
				$count_artists_notfound++;
			}
			$this->messageArray[] = array($status, $arter['name'], $message);	
		}
		
		$this->messageArray[] = array(FlashMessage::ERROR, 'COUNT', 'Working with '.$count_artists.' artists');
		$this->messageArray[] = array(FlashMessage::ERROR, 'COUNT found', ' '.$count_artists_found.' artists found');
		$this->messageArray[] = array(FlashMessage::ERROR, 'COUNT not found', ' '.$count_artists_notfound.' artists NOT found');
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
				$this->artistImageFolder = $storage->getFolder($this->configurationArray['imagePath']);
			} catch (\TYPO3\CMS\Core\Resource\Exception\FolderDoesNotExistException $exception) {
				$this->artistImageFolder = $storage->createFolder($this->configurationArray['imagePath']);
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
		$artistsQuery = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid,name', 'tx_vcamillerntor_domain_model_kuenstler LEFT JOIN tx_vcamillerntor_ausstellung_kuenstler_mm as mm ON tx_vcamillerntor_domain_model_kuenstler.uid=mm.uid_foreign', 'tx_vcamillerntor_domain_model_kuenstler.deleted=0 AND tx_vcamillerntor_domain_model_kuenstler.sys_language_uid=0 AND mm.uid_local='.$this->configurationArray['ausstellungUid']);
		while ($artistRow = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($artistsQuery)) {
			$artists[$artistRow['uid']] = array('uid'=>$artistRow['uid'],'name'=>$artistRow['name'],'noblank'=>str_replace(array(' ','&','.','-'),array('','','',''),strtolower($artistRow['name'])));
			/*			
			$message = 'Artist';
			$status = FlashMessage::INFO;
			$this->messageArray[] = array($status, $artistRow['name'], $message);
			*/
		}	
		return $artists;
	}

	/**
	 * Generates output by using flash messages
	 *
	 * @return string
	 */
	protected function generateOutput($output = '') {
		
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
