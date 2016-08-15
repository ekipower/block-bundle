<?php
/**
 * This file is part of the Ekipower eZ Website package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\Block\BlockBundle\Model;

trait SourceTrait
{
	/**
	* 
	* @var array
	* 
	*/
	protected $sources = array();
	
	public function getSources()
	{
		return $this->sources;
	}
	
	public function setSources(array $sources = array())
	{
		$this->sources = $sources;
		
		return $this;
	}
	
	public function setSource($name, $value)
	{
		$this->sources[$name] = $value;
		
		return $this;
	}
	
	public function getSource($name, $default = null)
	{
		return isset($this->sources[$name]) ? $this->sources[$name] : $default;
	}
}
