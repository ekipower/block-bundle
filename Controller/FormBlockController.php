<?php
/**
 * This file is part of the Ekipower eZ Website package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\Block\BlockBundle\Controller;

use Eki\Block\BlockBundle\Events;
use Eki\Block\BlockBundle\Matcher\TemplateMatcherAwareTrait;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;

class FormBlockController extends Controller
{
	use TemplateMatcherAwareTrait;
	
	/**
	* 
	* @var EventDispatcherInterface
	* 
	*/
	protected $dispatcher;
	
	public function setDispatcher(EventDispatcherInterface $dispatcher)
	{
		$this->dispatcher = $dispatcher;
		
		return $this;
	}
	
    /**
     * Action that is referenced in an ActionBlock.
     *
     * @param BlockInterface        $block
     * @param BlockContextInterface $blockContext
     *
     * @return Response the response
     */
    public function form(BlockInterface $block, BlockContextInterface $blockContext)
    {
    	$request = $this->getRequest();
    	
    	$form = $this->getForm($blockContext);
    	
    	$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) 
		{
        	$this->doSucessForm($form, $blockContext);

			return new RedirectResponse($this->getRequest()->headers->get('referer'));
    	}

		$template = $blockContext->getTemplate();
		if ( empty($template) && null !== $this->templateMatcher )
		{
			$template = $this->templateMatcher->match($block, $blockContext->getSettings());
		}

        return $this->render($template, array(
            'block' => $block,
            'form' => $form->createView(),
            'settings' => $blockContext->getSettings(),
        ));
    }

	protected function getForm(BlockContextInterface $blockContext)
	{
        $settings = $blockContext->getSettings();
        if ( empty($settings['form_type']) ) 
        {
            $this->get('logger')->debug(sprintf(
                    'FormBlock with id "%s" is missing a required setting: form_type',
                    $blockContext->getBlock()->getId()
                ));

            return array();
        }

		$options = array();
		if (isset($settings['data_class']))
		{
			$options['data_class'] = $settings['data_class'];
		}
		return $this->createForm($settings['form_type'], null, $options);
	}
	
	protected function doSuccessForm(FormInterface $form, BlockContextInterface $blockContext)
	{
		$this->dispatcher->dispatcher(
			Events::FORM_ACTION_BLOCK,
			new GenericEvent(
				$form->getData(),
				array(
					'block' => $blockContext->getBlock(),
					'settings' => $blockContext->getSettings()
				)
			)
		);
	}
}
