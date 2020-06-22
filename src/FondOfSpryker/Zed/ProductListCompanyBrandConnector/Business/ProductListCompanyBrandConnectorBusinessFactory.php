<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business;

use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\Model\CompanyBrandRelationWriter;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\Model\CompanyBrandRelationWriterInterface;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\ProductListCompanyBrandConnectorDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

class ProductListCompanyBrandConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\Model\CompanyBrandRelationWriterInterface
     */
    public function createCompanyBrandRelationWriter(): CompanyBrandRelationWriterInterface
    {
        return new CompanyBrandRelationWriter(
            $this->getBrandCompanyFacade(),
            $this->getProductListFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface
     */
    protected function getBrandCompanyFacade(): ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface
    {
        return $this->getProvidedDependency(ProductListCompanyBrandConnectorDependencyProvider::FACADE_BRAND_COMPANY);
    }

    /**
     * @return \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface
     */
    protected function getProductListFacade(): ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface
    {
        return $this->getProvidedDependency(ProductListCompanyBrandConnectorDependencyProvider::FACADE_PRODUCT_LIST);
    }
}
