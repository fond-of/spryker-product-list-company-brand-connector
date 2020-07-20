<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;

class ProductListCompanyBrandConnectorToBrandCompanyFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface
     */
    protected $brandCompanyFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBrandRelationTransfer
     */
    protected $companyBrandRelationTransfer;

    /**
     * @var \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToBrandCompanyFacadeBridge
     */
    protected $productListCompanyBrandConnectorToBrandCompanyFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->brandCompanyFacadeMock = $this->getMockBuilder(BrandCompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBrandRelationTransfer = $this->getMockBuilder(CompanyBrandRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCompanyBrandConnectorToBrandCompanyFacadeBridge = new ProductListCompanyBrandConnectorToBrandCompanyFacadeBridge(
            $this->brandCompanyFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testSaveCompanyBrandRelation(): void
    {
        $this->assertInstanceOf(
            CompanyBrandRelationTransfer::class,
            $this->productListCompanyBrandConnectorToBrandCompanyFacadeBridge->saveCompanyBrandRelation(
                $this->companyBrandRelationTransfer
            )
        );
    }

    /**
     * @return void
     */
    public function testFindCompanyBrandRelationByIdCompany(): void
    {
        $this->assertInstanceOf(
            CompanyBrandRelationTransfer::class,
            $this->productListCompanyBrandConnectorToBrandCompanyFacadeBridge->findCompanyBrandRelationByIdCompany(
                $this->companyBrandRelationTransfer
            )
        );
    }
}
