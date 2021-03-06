<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade;

use FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface;
use Generated\Shared\Transfer\BrandRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeBridge implements ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface
{
    /**
     * @var \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface
     */
    protected $productListBrandConnectorFacade;

    /**
     * @param \FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorFacadeInterface $productListBrandConnectorFacade
     */
    public function __construct(ProductListBrandConnectorFacadeInterface $productListBrandConnectorFacade)
    {
        $this->productListBrandConnectorFacade = $productListBrandConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return \Generated\Shared\Transfer\BrandRelationTransfer
     */
    public function findProductListBrandRelationByIdProductList(
        ProductListTransfer $productListTransfer
    ): BrandRelationTransfer {
        return $this->productListBrandConnectorFacade->findProductListBrandRelationByIdProductList($productListTransfer);
    }
}
