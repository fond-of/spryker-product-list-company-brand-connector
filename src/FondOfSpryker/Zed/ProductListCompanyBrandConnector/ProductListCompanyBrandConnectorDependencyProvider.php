<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector;

use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToBrandCompanyFacadeBridge;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class ProductListCompanyBrandConnectorDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_BRAND_COMPANY = 'FACADE_BRAND_COMPANY';
    public const FACADE_PRODUCT_LIST = 'FACADE_PRODUCT_LIST';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addBrandCompanyFacade($container);
        $container = $this->addProductListFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addBrandCompanyFacade(Container $container): Container
    {
        $container[static::FACADE_BRAND_COMPANY] = static function (Container $container) {
            return new ProductListCompanyBrandConnectorToBrandCompanyFacadeBridge(
                $container->getLocator()->brandCompany()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListFacade(Container $container): Container
    {
        $container[static::FACADE_PRODUCT_LIST] = static function (Container $container) {
            return new ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeBridge(
                $container->getLocator()->productListBrandConnector()->facade()
            );
        };

        return $container;
    }
}
