<?php
namespace Eki\Block\BlockBundle\Tests\Document;

use Eki\Block\BlockBundle\Document\SquareBlock;
use Eki\Block\BlockBundle\Document\ItemBlock;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SquareBlockTest extends WebTestCase
{
	/**
	* @test
	*/
	public function generalTest()
	{
		$block = new SquareBlock();
	}

	/**
	* @test
	*/
	public function canAddItemsTest()
	{
		$block = new SquareBlock();
		
		$item1 = new ItemBlock();
		$block->addChild($item1);
		
		$item2 = new ItemBlock();
		$block->addChild($item2);
		
		$this->assertTrue($block->hasChildren());
		$this->assertCount(2, $block->getChildren());
	}

	/**
	* @test
	*/
	public function addDocumentationsTest()
	{
		$block = new SquareBlock();
		
		$block->setDocumentation('purpose', 'For ezPublish blocking');
		$block->setDocumentation('help', 'Help');
					
		$this->assertEquals('For ezPublish blocking', $block->getDocumentation('purpose'));
		$this->assertEquals('Help', $block->getDocumentation('help'));
	}
	
	/**
	* @test
	*/
	public function addSourcesTest()
	{
		$block = new SquareBlock();
		
		$block->setSource('type', 'ez');
		$block->setSource('name', 'def');
					
		$this->assertEquals('ez', $block->getSource('type'));
		$this->assertEquals('def', $block->getSource('name'));
	}

	/**
	* @test
	*/
	public function addAppearancesTest()
	{
		$block = new SquareBlock();
		
		$block->setAppearance('type', 'list');
		$block->setAppearance('view', 'default');
					
		$this->assertEquals('list', $block->getAppearance('type'));
		$this->assertEquals('default', $block->getAppearance('view'));
	}
}