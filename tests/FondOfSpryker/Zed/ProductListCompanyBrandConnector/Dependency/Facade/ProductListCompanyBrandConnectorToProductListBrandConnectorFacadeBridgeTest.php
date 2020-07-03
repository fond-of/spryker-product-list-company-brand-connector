<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface;
use Generated\Shared\Transfer\BrandRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface
     */
    protected $brandCompanyFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeBridge
     */
    protected $productListCompanyBrandConnectorToProductListBrandConnectorFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface
     */
    protected $productListBrandConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListTransfer
     */
    protected $productListTransfer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListBrandConnectorFacadeMock = $this->getMockBuilder(ProductListBrandConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransfer = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCompanyBrandConnectorToProductListBrandConnectorFacadeBridge =
            new ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeBridge($this->productListBrandConnectorFacadeMock);
    }

    /**
     * @return void
     */
    public function testFindProductListBrandRelationByIdProductList(): void
    {
        $this->assertInstanceOf(
            BrandRelationTransfer::class,
            $this->productListCompanyBrandConnectorToProductListBrandConnectorFacadeBridge
                ->findProductListBrandRelationByIdProductList($this->productListTransfer)
        );
    }
}
