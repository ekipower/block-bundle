<?php
namespace Eki\Block\BlockBundle\Tests\Document;

use Eki\Block\BlockBundle\Document\ItemBlock;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ItemBlockTest extends WebTestCase
{
	/**
	* @test
	*/
	public function generalTest()
	{
		$item = new ItemBlock();
	}
	
	/**
	* @test
	*/
	public function addDocumentationsTest()
	{
		$block = new SquareBlock();
		
		$block->setDocumentation('purpose', 'For ezPublish blocking. Item represents content/location.');
		$block->setDocumentation('help', 'Help');
					
		$this->assertEquals('For ezPublish blocking', $block->getDocumentation('purpose'));
		$this->assertEquals('Help', $block->getDocumentation('help'));
	}
	
	/**
	* @test
	*/
	public function addSourcesTest()
	{
		$block = new ItemBlock();
		
		$block->setSource('type', 'ez');
		$block->setSource('name', 'def');
					
		$this->assertEquals('ez', $block->getSource('type'));
		$this->assertEquals('def', $block->getSource('name'));
	}

	/**
	* @test
	*/
	public function addSettingsTest()
	{
		$block = new ItemBlock();
		
		$block->setSetting('source_type', 'ez');
		$block->setSetting('source_name', 'def');
		$block->setSetting('block_item_type', 'campaign');
		$block->setSetting('block_item_view', 'large');
					
		$this->assertEquals('ez', $block->getSetting('source_type'));
		$this->assertEquals('def', $block->getSetting('source_name'));
		$this->assertEquals('campaign', $block->getSetting('block_item_type'));
		$this->assertEquals('large', $block->getSetting('block_item_view'));
	}
}