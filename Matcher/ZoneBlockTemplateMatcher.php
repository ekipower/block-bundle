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
 * Matches for zone block.
 */
class ZoneBlockTemplateMatcher extends AbstractTemplateMatcher
{
	/**
	* Constructor
	*/
	public function __construct()
	{
		parent::__construct(
			"Eki\\Block\\BlockBundle\\Document\\ZoneBlock",
			"eki.block.zone",
			array('type', 'view')
		);
	}

	/**
	* @inheritdoc
	*/
	protected function checkMatching(BlockInterface $block, array $options, array $matches)
	{
		return
			$matches['type'] === $block->getAppearance('type') &&
			$matches['view'] === $block->getAppearance('view')
		;
	}
}
