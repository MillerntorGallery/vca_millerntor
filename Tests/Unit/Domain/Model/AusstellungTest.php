<?php

namespace VCA\VcaMillerntor\Tests;
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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \VCA\VcaMillerntor\Domain\Model\Ausstellung.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage millerntor
 *
 * @author fux <sfuchs@projektkater.de>
 */
class AusstellungTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \VCA\VcaMillerntor\Domain\Model\Ausstellung
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \VCA\VcaMillerntor\Domain\Model\Ausstellung();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() { 
		$this->fixture->setTitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTitle()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getStartReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setStartForDateTimeSetsStart() { }
	
	/**
	 * @test
	 */
	public function getEndReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setEndForDateTimeSetsEnd() { }
	
	/**
	 * @test
	 */
	public function getWerkeReturnsInitialValueForWerk() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getWerke()
		);
	}

	/**
	 * @test
	 */
	public function setWerkeForObjectStorageContainingWerkSetsWerke() { 
		$werke = new \VCA\VcaMillerntor\Domain\Model\Werk();
		$objectStorageHoldingExactlyOneWerke = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneWerke->attach($werke);
		$this->fixture->setWerke($objectStorageHoldingExactlyOneWerke);

		$this->assertSame(
			$objectStorageHoldingExactlyOneWerke,
			$this->fixture->getWerke()
		);
	}
	
	/**
	 * @test
	 */
	public function addWerkeToObjectStorageHoldingWerke() {
		$werke = new \VCA\VcaMillerntor\Domain\Model\Werk();
		$objectStorageHoldingExactlyOneWerke = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneWerke->attach($werke);
		$this->fixture->addWerke($werke);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneWerke,
			$this->fixture->getWerke()
		);
	}

	/**
	 * @test
	 */
	public function removeWerkeFromObjectStorageHoldingWerke() {
		$werke = new \VCA\VcaMillerntor\Domain\Model\Werk();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($werke);
		$localObjectStorage->detach($werke);
		$this->fixture->addWerke($werke);
		$this->fixture->removeWerke($werke);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getWerke()
		);
	}
	
}
?>