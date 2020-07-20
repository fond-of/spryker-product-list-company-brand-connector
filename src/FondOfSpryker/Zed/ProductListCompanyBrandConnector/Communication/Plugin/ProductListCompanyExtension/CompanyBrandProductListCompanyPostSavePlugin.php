<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Communication\Plugin\ProductListCompanyExtension;

use FondOfSpryker\Zed\ProductListCompanyExtension\Dependency\Plugin\ProductListCompanyPostSavePluginInterface;
use Generated\Shared\Transfer\ProductListCompanyRelationTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorFacadeInterface getFacade()
 */
class CompanyBrandProductListCompanyPostSavePlugin extends AbstractPlugin implements ProductListCompanyPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductListCompanyRelationTransfer $productListCompanyRelationTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCompanyRelationTransfer
     */
    public function postSave(
        ProductListCompanyRelationTransfer $productListCompanyRelationTransfer
    ): ProductListCompanyRelationTransfer {
        return $this
            ->getFacade()
            ->saveCompanyBrandRelationByIdProductListAndCompanyIds($productListCompanyRelationTransfer);
    }
}
