<?php
/**
 * This file is part of the Ekipower eZ Website package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\Block\BlockBundle\Block;

use Eki\Block\BlockBundle\Matcher\TemplateMatcherInterface;
use Eki\Block\BlockBundle\Matcher\TemplateMatcherAwareTrait;

use Symfony\Cmf\Bundle\BlockBundle\Block\SimpleBlockService;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\BlockRendererInterface;
use Sonata\BlockBundle\Block\BlockServiceInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemBlockService extends SimpleBlockService
{
	use TemplateMatcherAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        if (!$response) {
            $response = new Response();
        }

		$block = $blockContext->getBlock();
		
        if ($block->getEnabled()) 
        {
			$template = $blockContext->getTemplate();
			if ($this->templateMatcher !== null)
			{
				if ( null !== ($tpl = $this->templateMatcher->match($block, $blockContext->getSettings())) )
					$template = $tpl;
			}

            $response = $this->renderResponse($template, array('block' => $block), $response);
        }

        return $response;
    }
}
