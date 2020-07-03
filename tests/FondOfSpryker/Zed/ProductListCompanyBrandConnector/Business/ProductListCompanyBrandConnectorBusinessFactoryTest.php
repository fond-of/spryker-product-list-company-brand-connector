<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\Model\CompanyBrandRelationWriter;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\ProductListCompanyBrandConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductListCompanyBrandConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorBusinessFactory
     */
    protected $productListCompanyBrandConnectorBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToBrandProductFacadeInterface
     */
    protected $productListBrandConnectorToBrandProductFacadeInterfaceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Dependency\Facade\ProductListBrandConnectorToProductListFacadeInterface
     */
    protected $productListBrandConnectorToProductListFacadeInterfaceMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCompanyBrandConnectorToBrandCompanyFacadeInterfaceMock = $this->getMockBuilder(ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCompanyBrandConnectorToProductListBrandConnectorFacadeInterfaceMock = $this->getMockBuilder(ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCompanyBrandConnectorBusinessFactory = new ProductListCompanyBrandConnectorBusinessFactory();
        $this->productListCompanyBrandConnectorBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCompanyBrandRelationWriter(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [ProductListCompanyBrandConnectorDependencyProvider::FACADE_BRAND_COMPANY],
                [ProductListCompanyBrandConnectorDependencyProvider::FACADE_PRODUCT_LIST]
            )->willReturnOnConsecutiveCalls(
                $this->productListCompanyBrandConnectorToBrandCompanyFacadeInterfaceMock,
                $this->productListCompanyBrandConnectorToProductListBrandConnectorFacadeInterfaceMock
            );

        $this->assertInstanceOf(
            CompanyBrandRelationWriter::class,
            $this->productListCompanyBrandConnectorBusinessFactory->createCompanyBrandRelationWriter()
        );
    }
}
