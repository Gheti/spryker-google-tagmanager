<?php

namespace FondOfSpryker\Yves\GoogleTagManager\Plugin\VariableBuilder\TransactionProductVariables;

use FondOfSpryker\Yves\GoogleTagManager\Dependency\VariableBuilder\TransactionProductFieldPluginInterface;
use Generated\Shared\Transfer\GooleTagManagerTransactionProductTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Yves\Kernel\AbstractPlugin;

/**
 * @method \FondOfSpryker\Yves\GoogleTagManager\GoogleTagManagerFactory getFactory()
 */
class TransactionProductFieldQuantityPlugin extends AbstractPlugin implements TransactionProductFieldPluginInterface
{
    public const FIELD_NAME = 'quantity';

    /**
     * @param \Generated\Shared\Transfer\GooleTagManagerTransactionProductTransfer $gooleTagManagerTransactionProductTransfer
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param array $params
     *
     * @return \Generated\Shared\Transfer\GooleTagManagerTransactionProductTransfer
     */
    public function handle(
        GooleTagManagerTransactionProductTransfer $gooleTagManagerTransactionProductTransfer,
        ItemTransfer $itemTransfer,
        array $params = []
    ): GooleTagManagerTransactionProductTransfer {
        return $gooleTagManagerTransactionProductTransfer->setQuantity($itemTransfer->getQuantity());
    }
}