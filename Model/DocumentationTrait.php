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

trait DocumentationTrait
{
	/**
	* 
	* @var array
	* 
	*/
	protected $documentations = array();
	
	public function getDocumentations()
	{
		return $this->documentations;
	}
	
	public function setDocumentations(array $documentations = array())
	{
		$this->documentations = $documentations;
		
		return $this;
	}
	
	public function setDocumentation($name, $value)
	{
		$this->documentations[$name] = $value;
		
		return $this;
	}
	
	public function getDocumentation($name, $default = null)
	{
		return isset($this->documentations[$name]) ? $this->documentations[$name] : $default;
	}
}
