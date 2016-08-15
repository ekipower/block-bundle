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

trait AppearanceTrait
{
	/**
	* 
	* @var array
	* 
	*/
	protected $appearances = array();
	
	public function getAppearances()
	{
		return $this->appearances;
	}
	
	public function setAppearances(array $appearances = array())
	{
		$this->appearances = $appearances;
		
		return $this;
	}
	
	public function setAppearance($name, $value)
	{
		$this->appearances[$name] = $value;
		
		return $this;
	}
	
	public function getAppearance($name, $default = null)
	{
		return isset($this->appearances[$name]) ? $this->appearances[$name] : $default;
	}
}
