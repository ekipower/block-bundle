<?php
namespace Eki\Block\BlockBundle\Tests\Document;

use Eki\Block\BlockBundle\Document\ZoneBlock;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ZoneBlockTest extends WebTestCase
{
	/**
	* @test
	*/
	public function generalTest()
	{
		$zone = new ZoneBlock();
	}

	/**
	* @test
	*/
	public function addDocumentationsTest()
	{
		$block = new ZoneBlock();
		
		$block->setDocumentation('purpose', 'For bootstrap organization.');
		$block->setDocumentation('help', 'Help');
					
		$this->assertEquals('For bootstrap organization.', $block->getDocumentation('purpose'));
		$this->assertEquals('Help', $block->getDocumentation('help'));
	}
}