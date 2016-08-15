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
 * Matches a block.
 */
interface TemplateMatcherInterface
{
    /**
     * Matches the $block against a set of matchers.
     *
     * @param \Sonata\BlockBundle\Model\BlockInterface $block
     * @param array $options
     *
     * @return string|null Template name for block
     */
    public function match(BlockInterface $block, array $options = array());
    
    /**
	* Check if the matcher supports for block
	* 
	* @param BlockInterface $block
    * @param array $options
	* 
	* @return bool|null
	*/
    public function support(BlockInterface $block, array $options = array());
}
