<?php

/**
 * Google Tag Manager tracking integration for Spryker
 *
 * @author      Jozsef Geng <gengjozsef86@gmail.com>
 */

namespace FondOfSpryker\Yves\GoogleTagManager\Plugin\Provider;

use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\TwigExtension\Dependency\Plugin\TwigPluginInterface;
use Spryker\Yves\Kernel\AbstractPlugin;
use Twig\Environment;

/**
 * @method \FondOfSpryker\Yves\GoogleTagManager\GoogleTagManagerFactory getFactory()
 */
class GoogleTagManagerTwigServiceProvider extends AbstractPlugin implements TwigPluginInterface
{
    public function extend(Environment $twig, ContainerInterface $container): Environment
    {
        $twig->addExtension( $this->getFactory()->createGoogleTagManagerTwigExtension());

        return $twig;
    }
}
