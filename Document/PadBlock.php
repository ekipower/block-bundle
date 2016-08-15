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

use Eki\Block\BlockBundle\Model\AppearanceInterface;
use Eki\Block\BlockBundle\Model\AppearanceTrait;
use Eki\Block\BlockBundle\Model\DocumentationInterface;
use Eki\Block\BlockBundle\Model\DocumentationTrait;

use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\ContainerBlock;

class PadBlock extends ContainerBlock implements AppearanceInterface, DocumentationInterface
{
	use AppearanceTrait, DocumentationTrait;

	/**
	* 
	* @var string
	* 
	*/
	protected $title;
	
    public function getType()
    {
        return 'eki.block.pad';
    }
    
    public function getTitle()
    {
		return $this->title;
	}
	
	public function setTitle($title)
	{
		$this->title = $title;
		
		return $this;
	}
}
