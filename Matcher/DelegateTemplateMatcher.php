<?php
/**
 * This file is part of the Ekipower eZ Website package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\Block\BlockBundle\Matcher;

use Sonata\BlockBundle\Model\BlockInterface;

/**
 * Abstract Matcher for some blocks.
 */
class DelegateTemplateMatcher implements TemplateMatcherInterface
{
	/**
	* 
	* @var TemplateMatcherInterface[]
	* 
	*/
	protected $matchers = array();

	/**
	* Add a matcher
	* 
	* @param TemplateMatcherInterface $matcher
	* @param string $key
	* 
	* @return
	*/
	public function addMatcher(TemplateMatcherInterface $matcher, $key)
	{
		if (isset($this->matchers[$key]))
		{
			throw new \LogicException('Matcher with key '.$key.' already exists.');
		}
		
		$this->matchers[$key] = $matcher;
	}
	
    /**
	* @inheritdoc
	*/
    public function match(BlockInterface $block, array $options = array())
    {
    	foreach($this->matchers as $key => $matcher)
    	{
			if (!$matcher->support($block, $options))
				continue;
				
			if (null !== ($template = $matcher->match($block, $options)) )
			{
				return $template;
			}
		} 
	}
	
    /**
	* @inheritdoc
	*/
    public function support(BlockInterface $block, array $options = array())
	{
    	foreach($this->matchers as $key => $matcher)
    	{
			if ($matcher->support($block, $options))
				return true;
		}
	}		
}
