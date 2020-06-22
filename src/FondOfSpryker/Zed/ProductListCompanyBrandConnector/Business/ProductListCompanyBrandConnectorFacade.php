<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business;

use Generated\Shared\Transfer\ProductListCompanyRelationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorBusinessFactory getFactory()
 */
class ProductListCompanyBrandConnectorFacade extends AbstractFacade implements ProductListCompanyBrandConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListCompanyRelationTransfer $productListCompanyRelationTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCompanyRelationTransfer
     */
    public function saveCompanyBrandRelationByIdProductListAndCompanyIds(
        ProductListCompanyRelationTransfer $productListCompanyRelationTransfer
    ): ProductListCompanyRelationTransfer {
        return $this->getFactory()
            ->createCompanyBrandRelationWriter()
            ->saveCompanyBrandRelationByIdProductListAndCompanyIds($productListCompanyRelationTransfer);
    }
}
