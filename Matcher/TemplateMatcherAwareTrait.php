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

use Eki\Block\BlockBundle\Matcher\TemplateMatcherInterface;

/**
 * Template matcher aware trait.
 */
trait TemplateMatcherAwareTrait
{
	/**
	* 
	* @var TemplateMatcherInterface
	* 
	*/
	protected $templateMatcher;
	
	public function setTemplateMatcher(TemplateMatcherInterface $templateMatcher = null)
	{
		$this->templateMatcher = $templateMatcher;
		
		return $this;
	}
}
