<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\Model;

use Generated\Shared\Transfer\ProductListCompanyRelationTransfer;

interface CompanyBrandRelationWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListCompanyRelationTransfer $productListCompanyRelationTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCompanyRelationTransfer
     */
    public function saveCompanyBrandRelationByIdProductListAndCompanyIds(
        ProductListCompanyRelationTransfer $productListCompanyRelationTransfer
    ): ProductListCompanyRelationTransfer;
}
