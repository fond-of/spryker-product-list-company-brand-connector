<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business;

use Generated\Shared\Transfer\ProductListCompanyRelationTransfer;

interface ProductListCompanyBrandConnectorFacadeInterface
{
    /**
     * Specification:
     *  - Save company Brand relations for the given Product List and Company Ids
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductListCompanyRelationTransfer $productListCompanyRelationTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCompanyRelationTransfer
     */
    public function saveCompanyBrandRelationByIdProductListAndCompanyIds(
        ProductListCompanyRelationTransfer $productListCompanyRelationTransfer
    ): ProductListCompanyRelationTransfer;
}
