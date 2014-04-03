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
 * Test case for class \VCA\VcaMillerntor\Domain\Model\Kuenstler.
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
class KuenstlerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \VCA\VcaMillerntor\Domain\Model\Kuenstler
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \VCA\VcaMillerntor\Domain\Model\Kuenstler();
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
	public function getDecriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDecriptionForStringSetsDecription() { 
		$this->fixture->setDecription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDecription()
		);
	}
	
	/**
	 * @test
	 */
	public function getLogoReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setLogoForStringSetsLogo() { 
		$this->fixture->setLogo('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getLogo()
		);
	}
	
	/**
	 * @test
	 */
	public function getWerkReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getWerk()
		);
	}

	/**
	 * @test
	 */
	public function setWerkForIntegerSetsWerk() { 
		$this->fixture->setWerk(12);

		$this->assertSame(
			12,
			$this->fixture->getWerk()
		);
	}
	
}
?>