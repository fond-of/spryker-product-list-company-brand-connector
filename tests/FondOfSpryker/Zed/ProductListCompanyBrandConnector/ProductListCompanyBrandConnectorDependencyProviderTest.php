<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface;
use FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToBrandCompanyFacadeBridge;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class ProductListCompanyBrandConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListCompanyBrandConnector\ProductListCompanyBrandConnectorDependencyProvider
     */
    protected $productListCompanyBrandConnectorDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface
     */
    protected $brandCompanyFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'offsetSet', 'offsetGet', 'set', 'get'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCompanyFacadeMock = $this->getMockBuilder(BrandCompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListBrandConnectorFacadeMock = $this->getMockBuilder(ProductListBrandConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCompanyBrandConnectorDependencyProvider = new ProductListCompanyBrandConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->withConsecutive(['brandCompany'], ['productListBrandConnector'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects($this->atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturnOnConsecutiveCalls(
                $this->brandCompanyFacadeMock,
                $this->productListBrandConnectorFacadeMock
            );

        $this->assertEquals(
            $this->containerMock,
            $this->productListCompanyBrandConnectorDependencyProvider->provideBusinessLayerDependencies($this->containerMock)
        );

        $this->assertInstanceOf(
            ProductListCompanyBrandConnectorToBrandCompanyFacadeBridge::class,
            $this->containerMock[ProductListCompanyBrandConnectorDependencyProvider::FACADE_BRAND_COMPANY]
        );

        $this->assertInstanceOf(
            ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeBridge::class,
            $this->containerMock[ProductListCompanyBrandConnectorDependencyProvider::FACADE_PRODUCT_LIST]
        );
    }
}
