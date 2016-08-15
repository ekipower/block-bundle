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
 * Matches for square block.
 */
class FormBlockTemplateMatcher extends AbstractTemplateMatcher
{
	/**
	* Constructor
	*/
	public function __construct()
	{
		parent::__construct(
			"Eki\\Block\\BlockBundle\\Document\\FormBlock",
			"cmf.block.action",
			array('form_type', 'view_type')
		);
	}

	/**
	* @inheritdoc
	*/
	protected function checkMatching(BlockInterface $block, array $options, array $matches)
	{
		return
			$matches['form_type'] === $block->getSetting('form_type') && 
			$matches['view_type'] === $block->getSetting('view_type')
		;
	}
}
