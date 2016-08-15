<?php
namespace Eki\Block\BlockBundle\Tests\Document;

use Eki\Block\BlockBundle\Document\PadBlock;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PadBlockTest extends WebTestCase
{
	/**
	* @test
	*/
	public function generalTest()
	{
		$pad = new PadBlock();
	}

	/**
	* @test
	*/
	public function addDocumentationsTest()
	{
		$block = new PadBlock();
		
		$block->setDocumentation('purpose', 'For bootstrap organization.');
		$block->setDocumentation('help', 'Help');
					
		$this->assertEquals('For bootstrap organization.', $block->getDocumentation('purpose'));
		$this->assertEquals('Help', $block->getDocumentation('help'));
	}
}