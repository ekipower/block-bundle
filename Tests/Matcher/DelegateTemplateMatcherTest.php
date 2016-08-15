<?php
namespace Eki\Block\BlockBundle\Tests\Matcher;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ItemBlockTest extends WebTestCase
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
    	$this->client = $this->createClient();
    }
	
	/**
	* @test
	*/
	public function hasDelegateMatcherTest()
	{
		$this->assertTrue($this->client->getContainer()->has('eki_block.delegate.template_matcher'));

		$delegateTemplateMatcher = $this->client->getContainer()->get('eki_block.delegate.template_matcher');
	}

	/**
	* @test
	*/
	public function templateFormBlockMatcherTest()
	{
		
	}
}