<?php

namespace FondOfSpryker\Yves\GoogleTagManager\Plugin\Provider;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\TwigExtension\Dependency\Plugin\TwigPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Twig\Environment;

/**
 * @method \FondOfSpryker\Yves\GoogleTagManager\GoogleTagManagerFactory getFactory()
 */
class EnhancedEcommerceTwigServiceProvider extends AbstractPlugin implements TwigPluginInterface
{
    /**
     * @param \Spryker\Service\Container\ContainerInterface $twig
     * @param ContainerInterface $container
     *
     * @return \Twig\Environment
     */
    public function extend(Environment $twig, ContainerInterface $container): Environment
    {
        $twig->addExtension( $this->getFactory()->createEnhancedEcommerceTwigExtension());

        return $twig;
    }
}
