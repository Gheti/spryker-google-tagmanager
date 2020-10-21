<?php

namespace FondOfSpryker\Yves\GoogleTagManager\Plugin\VariableBuilder\ProductVariables;

use Exception;
use FondOfSpryker\Yves\GoogleTagManager\Dependency\VariableBuilder\ProductFieldVariableBuilderPluginInterface;
use Generated\Shared\Transfer\GooleTagManagerProductDetailTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Yves\Kernel\AbstractPlugin;

class ProductFieldNamePlugin extends AbstractPlugin implements ProductFieldVariableBuilderPluginInterface
{
    public const NAME_UNTRANSLATED = 'name_untranslated';

    use LoggerTrait;

    /**
     * @param \Generated\Shared\Transfer\GooleTagManagerProductDetailTransfer $gooleTagManagerProductDetailTransfer
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $product
     * @param array $params
     *
     * @return \Generated\Shared\Transfer\GooleTagManagerProductDetailTransfer
     */
    public function handle(
        GooleTagManagerProductDetailTransfer $gooleTagManagerProductDetailTransfer,
        ProductAbstractTransfer $product,
        array $params = []
    ): GooleTagManagerProductDetailTransfer {
        try {
            $gooleTagManagerProductDetailTransfer->setProductName($product->getName());

            if (isset($product->getAttributes()[static::NAME_UNTRANSLATED]) && !empty($product->getAttributes()[static::NAME_UNTRANSLATED])) {
                $gooleTagManagerProductDetailTransfer->setProductName($product->getAttributes()[static::NAME_UNTRANSLATED]);
            }
        } catch (Exception $e) {
            $this->getLogger()->notice(sprintf(
                'GoogleTagManager: attribute %s not found in %s',
                $gooleTagManagerProductDetailTransfer::PRODUCT_NAME,
                self::class
            ), ['product' => json_encode($product)]);
        }

        return $gooleTagManagerProductDetailTransfer;
    }
}
