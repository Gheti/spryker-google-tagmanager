<?php

namespace FondOfSpryker\Yves\GoogleTagManager\Twig;

use Spryker\Shared\Twig\TwigExtension;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Twig\TwigFunction;

class EnhancedEcommerceTwigExtension extends TwigExtension
{
    public const FUNCTION_ENHANCED_ECOMMERCE = 'enhancedEcommerce';

    /**
     * @var \FondOfSpryker\Yves\GoogleTagManager\Plugin\EnhancedEcommerce\EnhancedEcommercePageTypePluginInterface[]
     */
    protected $plugin;

    public function __construct(array $plugin)
    {
        $this->plugin = $plugin;
    }

    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            $this->createEnhancedEcommerceFunction(),
        ];
    }

    /**
     * @return \Twig\TwigFunction
     */
    protected function createEnhancedEcommerceFunction(): TwigFunction
    {
            return new TwigFunction(
                static::FUNCTION_ENHANCED_ECOMMERCE,
                [$this, 'renderEnhancedEcommerce'],
                [
                    'is_safe' => ['html'],
                    'needs_environment' => true,
                ]
            );
    }

    /**
     * @param \Twig\Environment $twig
     * @param string $page
     * @param \Symfony\Component\HttpFoundation\Request|null $request
     * @param array $params
     *
     * @throws
     *
     * @return string
     */
    public function renderEnhancedEcommerce(Environment $twig, string $page, ?Request $request, array $params = []): string
    {
        if (array_key_exists($page, $this->plugin)) {
            return $this->plugin[$page]->handle($twig, $request, $params);
        }

        return '';
    }

    /**
     * @return string
     */
    protected function getEnhancedMicrodateTemplateName(): string
    {
        return '@GoogleTagManager/partials/enhanced-ecommerce.twig';
    }
}
