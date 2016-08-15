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
 * Matches for item block.
 */
class ItemBlockTemplateMatcher extends AbstractTemplateMatcher
{
	/**
	* Constructor
	*/
	public function __construct()
	{
		parent::__construct(
			"Eki\\Block\\BlockBundle\\Document\\ItemBlock",
			"eki.block.item",
			array('source_type', 'source_name', 'type', 'view')
		);
	}

	/**
	* @inheritdoc
	*/
	protected function checkMatching(BlockInterface $block, array $options, array $matches)
	{
//var_dump('=============== block '.$block->getId().' ====================='); var_dump('<br>');
//var_dump('//// options /////');  var_dump('<br>');
//var_dump($options);  var_dump('<br>');
//var_dump('//// matches /////'); var_dump('<br>');
//var_dump($matches);  var_dump('<br>');
		
		//return
		$ret =
			$this->checkSourceType($block, $options, $matches['source_type']) &&
			$this->checkSourceName($block, $options, $matches['source_name']) &&
			$this->checkAppearanceType($block, $options, $matches['type']) &&
			$this->checkAppearanceView($block, $options, $matches['view'])
		;
		
if ($ret === true)
{
	var_dump('checkMatching TRUE');	   var_dump('<br>');
}

return $ret;
	}
	
	private function checkAppearanceView(BlockInterface $block, array $options, $matchView)
	{
		return ($matchView === $this->getOption($block, $options, 'block_item_view'));
	}

	private function checkAppearanceType(BlockInterface $block, array $options, $matchType)
	{
		return ($matchType === $this->getOption($block, $options, 'block_item_type'));
	}
}
