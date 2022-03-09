<?php

namespace FondOfSpryker\Yves\GoogleTagManager\Model\DataLayer;

use FondOfSpryker\Client\TaxProductConnector\TaxProductConnectorClient;
use FondOfSpryker\Shared\GoogleTagManager\GoogleTagManagerConstants;
use Generated\Shared\Transfer\GooleTagManagerProductDetailTransfer;
use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface;

class ProductVariableBuilder
{
    /**
     * @var \Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface
     */
    protected $moneyPlugin;

    /**
     * @var \FondOfSpryker\Client\TaxProductConnector\TaxProductConnectorClient
     */
    protected $taxProductConnectorClient;

    /**
     * @var array|\FondOfSpryker\Yves\GoogleTagManager\Plugin\VariableBuilder\VariableBuilderPluginInterface[]
     */
    protected $productVariableBuilderPlugins;

    /**
     * @param \Spryker\Shared\Money\Dependency\Plugin\MoneyPluginInterface $moneyPlugin
     */
    public function __construct(MoneyPluginInterface $moneyPlugin) {
        $this->moneyPlugin = $moneyPlugin;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductViewTransfer $product
     *
     * @return array
     */
    public function getVariables(ProductAbstractTransfer $product): array
    {
        $gooleTagManagerProductDetailTransfer = (new GooleTagManagerProductDetailTransfer())
            ->setProductId($product->getIdProductAbstract())
            ->setProductName($this->getProductName($product))
            ->setProductSku($product->getSku());

        return $gooleTagManagerProductDetailTransfer->toArray(true, true);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $product
     *
     * @return float
     */
    protected function getProductTax(ProductAbstractTransfer $product): float
    {
        $productAbstract = $this->taxProductConnectorClient->getTaxAmountForProduct($product);

        if ($productAbstract->getTaxAmount() > 0) {
            return $this->moneyPlugin->convertIntegerToDecimal(
                $productAbstract->getTaxAmount()
            );
        }

        return 0;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $product
     *
     * @return string
     */
    protected function getProductName(ProductAbstractTransfer $product): string
    {
        if (!array_key_exists(GoogleTagManagerConstants::NAME_UNTRANSLATED, $product->getAttributes())) {
            return $product->getName();
        }

        if (!$product->getAttributes()[GoogleTagManagerConstants::NAME_UNTRANSLATED]) {
            return $product->getName();
        }

        return $product->getAttributes()[GoogleTagManagerConstants::NAME_UNTRANSLATED];
    }
}
