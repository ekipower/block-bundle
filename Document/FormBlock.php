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

use Symfony\Cmf\Bundle\BlockBundle\Doctrine\Phpcr\ActionBlock;

/**
 * Block to display a form.
 */
class FormBlock extends ActionBlock
{
    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'cmf.block.action';
    }

    /**
     * Returns the default action name.
     *
     * @return string
     */
    public function getDefaultActionName()
    {
        return 'eki.block.controller.form_block:form';
    }
}
