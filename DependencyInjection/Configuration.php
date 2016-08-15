<?php
/**
 * This file is part of the Ekipower eZ Website package.
 *
 * (c) Ekipower
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */ 

namespace Eki\Block\BlockBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle.
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('eki_block');

        $rootNode
            ->children()
                ->arrayNode('blocks')
                	->useAttributeAsKey('block')
                	->prototype('array')
            			->children()
            				->scalarNode('type')->cannotBeEmpty()->end()
            				->arrayNode('templates')
		                    	->useAttributeAsKey('template_match_entry')
								->prototype('array')
			            			->addDefaultsIfNotSet()
			            			->children()
			            				->scalarNode('description')->end()
			            				->scalarNode('template')->isRequired()->end()
			            				->arrayNode('options')
			            					->prototype('variable')->end()
			            				->end()
			            				->arrayNode('match')
			            					->requiresAtLeastOneElement()
			            					->prototype('variable')->end()
			            				->end()
			            			->end()
								->end()
            				->end()
            			->end()
                	->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
