<?php
/**
 * This file is part of the Ekipower eZ Website package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\Block\BlockBundle\Document;

use Eki\Block\BlockBundle\Document\SquareBlock;

use Eki\Block\BlockBundle\Model\DocumentationInterface;
use Eki\Block\BlockBundle\Model\DocumentationTrait;
use Eki\Block\BlockBundle\Model\SourceInterface;
use Eki\Block\BlockBundle\Model\SourceTrait;

use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\AbstractBlock;

class ItemBlock extends AbstractBlock implements DocumentationInterface, SourceInterface
{
	use DocumentationTrait, SourceTrait;

    /**
	* 
	* @var array
	* 
	*/
    protected $props = array();

    /**
	* 
	* @var array
	* 
	*/
    protected $params = array();
    
    /**
	* 
	* @var int
	* 
	*/
    protected $priority;
    
    public function getType()
    {
        return 'eki.block.item';
    }

	public function getProps()
	{
		return $this->props;
	}
	
	public function setProps(array $props = array())
	{
		$this->props = $props;
		
		return $this;
	}
	
	public function setProp($name, $value)
	{
		$this->props[$name] = $value;
		
		return $this;
	}
	
	public function getProp($name, $default = null)
	{
		return isset($this->props[$name]) ? $this->props[$name] : $default;
	}

	public function getParams()
	{
		return $this->params;
	}
	
	public function setParams(array $params = array())
	{
		$this->params = $params;
		
		return $this;
	}
	
	public function setParam($name, $value)
	{
		$this->param[$name] = $value;
		
		return $this;
	}
	
	public function getParam($name, $default = null)
	{
		return isset($this->params[$name]) ? $this->params[$name] : $default;
	}

	public function getPriority()
	{
		return $this->priority;
	}
	
	public function setPriority($priority)
	{
		$this->priority = $priority;
		
		return $this;
	}
}
