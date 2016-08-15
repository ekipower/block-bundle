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

use Symfony\Cmf\Bundle\BlockBundle\Block\ContainerBlockService;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\BlockRendererInterface;
use Sonata\BlockBundle\Block\BlockServiceInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SquareBlockService extends ContainerBlockService
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

        // merge block settings with default settings
        $settings = $blockContext->getSettings();
        $resolver = new OptionsResolver();
        $resolver->setDefaults($settings);
        $settings = $resolver->resolve($block->getSettings());

        if ($block->getEnabled()) 
        {
			$template = $settings['template'];
			if ($this->templateMatcher !== null)
			{
				if ( null !== ($tpl = $this->templateMatcher->match($block)) )
					$template = $tpl;
			}
			
            return $this->renderResponse($template, array(
                'block' => $block,
                'settings' => $settings,
            ), $response);
        }

        return $response;
    }
}
