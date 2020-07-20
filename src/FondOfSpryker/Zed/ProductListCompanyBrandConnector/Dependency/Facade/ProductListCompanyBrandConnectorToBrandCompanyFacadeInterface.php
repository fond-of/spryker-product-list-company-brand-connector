<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade;

use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

interface ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    public function saveCompanyBrandRelation(
        CompanyBrandRelationTransfer $companyBrandRelationTransfer
    ): CompanyBrandRelationTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    public function findCompanyBrandRelationByIdCompany(
        CompanyBrandRelationTransfer $companyBrandRelationTransfer
    ): CompanyBrandRelationTransfer;
}
