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

use Eki\Symfony\Helper\Extension\ExtensionHelper;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Finder\Finder;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Definition; 

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class EkiBlockExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
		$loader = new YamlFileLoader($container, new FileLocator( __DIR__ . '/../Resources/config' ));
        $loader->load( 'parameters.yml' );
        $loader->load( 'services.yml' );

    	$processor = new Processor();
        $configuration = $this->getConfiguration( $configs, $container );
        $config = $processor->processConfiguration( $configuration, $configs );

        if (isset($config['blocks']))
        {
        	$allBlocks = array();
			foreach($config['blocks'] as $blockKey => $blockParams)
			{
				$blockType = $blockParams['type'];
				if (!isset($allBlocks[$blockType]))
				{
					$allBlocks[$blockType] = $blockParams;
				}
				else
				{
					array_unshift($allBlocks[$blockType], $blockParams);
				}
			}
			
			foreach($allBlocks as $type => $blockParamsForType)
			{
				$container->setParameter('eki_block.blocks.block.'.$type, $blockParamsForType);
			}
		}
    }
    
    /**
     * Automatically imports ...
     *
     * @param ContainerBuilder $container
     */
    public function prepend( ContainerBuilder $container )
    {
        ExtensionHelper::prependExtension($this, $container, 'sonata_block', null, true);
	}
}
