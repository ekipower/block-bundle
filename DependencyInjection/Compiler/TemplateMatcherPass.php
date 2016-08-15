<?php
/**
 * This file is part of the Ekipower eZ Website package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\Block\BlockBundle\DependencyInjection\Compiler;

use InvalidArgumentException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use \ReflectionClass;

class TemplateMatcherPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
    	$delegateTemplateMatcherId = 'eki_block.delegate.template_matcher';
        if (!$container->hasDefinition($delegateTemplateMatcherId)) {
            return;
        }

		$delegateTemplateMatcherDefinition = $container->getDefinition($delegateTemplateMatcherId);

        foreach ($container->findTaggedServiceIds('eki_block.template_matcher') as $serviceId => $tags) 
        {
            foreach ($tags as $tag) 
            {
                if (!isset($tag['key'])) {
                    throw new InvalidArgumentException(
                        "The service tag 'eki_block.template_matcher' requires an 'key' attribute"
                    );
                }

		        if ($container->hasDefinition($tag['key'])) 
		        {
		        	$blockServiceDef = $container->getDefinition($tag['key']);
		        	$class = $blockServiceDef->getClass();
		        	if ( preg_match("/^%(.+)%$/", $class, $matches) )
		        	{
		        		$class = $container->getParameter($matches[1]);
					}
		        	$reflectionClass = new ReflectionClass($class);
		        	
		        	if ( $reflectionClass->hasMethod('setTemplateMatcher') )
		        	{
						$blockServiceDef->addMethodCall(
							'setTemplateMatcher',
							[new Reference($delegateTemplateMatcherId)]
						);
					}
		        }
		        
                $delegateTemplateMatcherDefinition->addMethodCall(
                	'addMatcher',
                	[new Reference($serviceId), $tag['key']]
                );
            }
        }
    }
}
