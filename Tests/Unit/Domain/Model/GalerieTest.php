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
 * Test case for class \VCA\VcaMillerntor\Domain\Model\Galerie.
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
class GalerieTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \VCA\VcaMillerntor\Domain\Model\Galerie
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \VCA\VcaMillerntor\Domain\Model\Galerie();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setNameForStringSetsName() { 
		$this->fixture->setName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getName()
		);
	}
	
	/**
	 * @test
	 */
	public function getAdresseReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setAdresseForStringSetsAdresse() { 
		$this->fixture->setAdresse('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getAdresse()
		);
	}
	
	/**
	 * @test
	 */
	public function getAustellungenReturnsInitialValueForAusstellung() { 
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getAustellungen()
		);
	}

	/**
	 * @test
	 */
	public function setAustellungenForObjectStorageContainingAusstellungSetsAustellungen() { 
		$austellungen = new \VCA\VcaMillerntor\Domain\Model\Ausstellung();
		$objectStorageHoldingExactlyOneAustellungen = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneAustellungen->attach($austellungen);
		$this->fixture->setAustellungen($objectStorageHoldingExactlyOneAustellungen);

		$this->assertSame(
			$objectStorageHoldingExactlyOneAustellungen,
			$this->fixture->getAustellungen()
		);
	}
	
	/**
	 * @test
	 */
	public function addAustellungenToObjectStorageHoldingAustellungen() {
		$austellungen = new \VCA\VcaMillerntor\Domain\Model\Ausstellung();
		$objectStorageHoldingExactlyOneAustellungen = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$objectStorageHoldingExactlyOneAustellungen->attach($austellungen);
		$this->fixture->addAustellungen($austellungen);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneAustellungen,
			$this->fixture->getAustellungen()
		);
	}

	/**
	 * @test
	 */
	public function removeAustellungenFromObjectStorageHoldingAustellungen() {
		$austellungen = new \VCA\VcaMillerntor\Domain\Model\Ausstellung();
		$localObjectStorage = new \TYPO3\CMS\Extbase\Persistence\Generic\ObjectStorage();
		$localObjectStorage->attach($austellungen);
		$localObjectStorage->detach($austellungen);
		$this->fixture->addAustellungen($austellungen);
		$this->fixture->removeAustellungen($austellungen);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getAustellungen()
		);
	}
	
}
?>