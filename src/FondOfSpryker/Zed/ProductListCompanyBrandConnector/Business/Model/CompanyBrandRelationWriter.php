<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\Model;

use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;
use Generated\Shared\Transfer\ProductListCompanyRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class CompanyBrandRelationWriter implements CompanyBrandRelationWriterInterface
{
    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Business\Model\BrandCompanyRelationReaderInterface
     */
    protected $brandCompanyFacade;

    /**
     * @var \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface
     */
    protected $productListBrandConnectorFacade;

    /**
     * @param \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface $brandCompanyFacade
     * @param \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface $productListBrandConnectorFacade
     */
    public function __construct(
        ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface $brandCompanyFacade,
        ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface $productListBrandConnectorFacade
    ) {
        $this->brandCompanyFacade = $brandCompanyFacade;
        $this->productListBrandConnectorFacade = $productListBrandConnectorFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCompanyRelationTransfer $productListCompanyRelationTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListCompanyRelationTransfer
     */
    public function saveCompanyBrandRelationByIdProductListAndCompanyIds(
        ProductListCompanyRelationTransfer $productListCompanyRelationTransfer
    ): ProductListCompanyRelationTransfer {

        if (count($productListCompanyRelationTransfer->getCompanyIds()) === 0
            || $productListCompanyRelationTransfer->getIdProductList() === null) {
            return $productListCompanyRelationTransfer;
        }

        $productListTransfer = (new ProductListTransfer())
            ->setIdProductList($productListCompanyRelationTransfer->getIdProductList());
        $brandRelationTransfer = $this->productListBrandConnectorFacade
            ->findProductListBrandRelationByIdProductList($productListTransfer);

        if (count($brandRelationTransfer->getIdBrands()) === 0) {
            return $productListCompanyRelationTransfer;
        }

        $this->saveCompanyBrandRelations(
            $productListCompanyRelationTransfer->getCompanyIds(),
            $brandRelationTransfer->getIdBrands()
        );

        return $productListCompanyRelationTransfer;
    }

    /**
     * @param int[] $companyIds
     * @param int[] $brandIds
     *
     * @return void
     */
    protected function saveCompanyBrandRelations(
        array $companyIds,
        array $brandIds
    ): void {
        foreach ($companyIds as $idCompany) {
            $brandIds = array_unique(array_merge($brandIds, $this->findCurrentCompanyBrandIds($idCompany)));
            $this->brandCompanyFacade->saveCompanyBrandRelation(
                (new CompanyBrandRelationTransfer())
                    ->setIdCompany($idCompany)
                    ->setIdBrands($brandIds)
            );
        }
    }

    /**
     * @param int $idCustomer
     *
     * @return int[]
     */
    protected function findCurrentCompanyBrandIds(int $idCompany): array
    {
        $companyBrandRelationTransfer = (new CompanyBrandRelationTransfer())->setIdCompany($idCompany);
        $currentCompanyBrandRelationTransfer =
            $this->brandCompanyFacade->findCompanyBrandRelationByIdCompany($companyBrandRelationTransfer);

        if (count($companyBrandRelationTransfer->getIdBrands()) === 0) {
            return [];
        }

        return $currentCompanyBrandRelationTransfer->getIdBrands();
    }
}
