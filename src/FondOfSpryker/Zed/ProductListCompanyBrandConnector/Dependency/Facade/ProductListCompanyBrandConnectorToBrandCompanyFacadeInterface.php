<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade;

use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

interface ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     */
    public function saveCompanyBrandRelation(
        CompanyBrandRelationTransfer $companyBrandRelationTransfer
    ): void;
}
