<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade;

use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListTransfer
     */
    public function findProductListBrandRelationByIdProductList(
        ProductListTransfer $productListTransfer
    ): ProductListTransfer;
}
