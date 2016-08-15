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
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Abstract Matcher for some blocks.
 */
abstract class AbstractTemplateMatcher implements TemplateMatcherInterface
{
	use ContainerAwareTrait;
	
	/**
	* 
	* @var string
	* 
	*/
	protected $class;
	
	/**
	* 
	* @var string
	* 
	*/
	protected $blockType;
	
	/**
	* 
	* @var array
	* 
	*/
	protected $matchKeys;
	
	public function __construct($class, $blockType, array $matchKeys)
	{
		if (!class_exists($class))
		{
			throw new \LogicException('No class found: '.$class);
		}
		
		$this->class = $class;
		$this->blockType = $blockType;
		$this->matchKeys = $matchKeys;
	}
	
	protected function getConfiguration()
	{
		$key = 'eki_block.blocks.block.'.$this->blockType;
		if ($this->container->hasParameter($key))	
		{
			return $blockParameters = $this->container->getParameter($key);
		}		
		
		return array();
	}

    /**
	* @inheritdoc
	*/
    public function support(BlockInterface $block, array $options = array())
    {
		if ($block instanceof $this->class && $block->getType() === $this->blockType)
			return true;	
	}
	
    /**
	* @inheritdoc
	*/
    public function match(BlockInterface $block, array $options = array())
    {
    	if (!$this->support($block, $options))
    		return;
    		
		if ( !empty($blockParameters = $this->getConfiguration()) && isset($blockParameters['templates']) )
		{
			$templates = $blockParameters['templates'];
			foreach($templates as $templateEntryName => $templateEntry)
			{
				if (!isset($templateEntry['template']))
					continue;
					
				if (isset($templateEntry['match']))
				{
					$matches = $templateEntry['match'];
					
					foreach($this->matchKeys as $matchKey)
					{
						if (!isset($matches[$matchKey]))
							$matches[$matchKey] = null;
					}

					if( true === $this->checkMatching($block, $options, $matches) )
						return $templateEntry['template'];
				}
			}
		}
	}

	/**
	* Check matching
	* 
	* @param BlockInterface  $block
	* @param array $options
	* @param array $matches
	* 
	* @return bool
	*/
	abstract protected function checkMatching(BlockInterface $block, array $options, array $matches);
	
	protected function checkSourceType(BlockInterface $block, array $options, $matchType)
	{
		if (null !== ($type = $block->getSource('type')) )
		{
			return ($matchType === $type);
		}

		return ($matchType === $this->getOption($block, $options, 'source_type'));
	}

	protected function checkSourceName(BlockInterface $block, array $options, $matchName)
	{
		if (null !== ($name = $block->getSource('name')) )
		{
			return ($matchName === $name);
		}

		return ($matchName === $this->getOption($block, $options, 'source_name'));
	}

	protected function getOption(BlockInterface $block, array $options, $name, $default = null)
	{
		if (isset($options[$name]))
			return $options[$name];
			
		return $block->getSetting($name, $default);
	}
}
