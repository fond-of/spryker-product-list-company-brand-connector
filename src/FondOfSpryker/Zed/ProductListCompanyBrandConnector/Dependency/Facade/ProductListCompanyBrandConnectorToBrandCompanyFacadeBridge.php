<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade;

use FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacade;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

class ProductListCompanyBrandConnectorToBrandCompanyFacadeBridge implements ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacade
     */
    protected $brandCompanyFacade;

    /**
     * @param \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacade $brandCompanyFacade
     */
    public function __construct(BrandCompanyFacade $brandCompanyFacade)
    {
        $this->brandCompanyFacade = $brandCompanyFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBrandRelationTransfer $companyBrandRelationTransfer
     *
     * @return void
     */
    public function saveCompanyBrandRelation(
        CompanyBrandRelationTransfer $companyBrandRelationTransfer
    ): void {
        $this->brandCompanyFacade->saveCompanyBrandRelation($companyBrandRelationTransfer);
    }
}
