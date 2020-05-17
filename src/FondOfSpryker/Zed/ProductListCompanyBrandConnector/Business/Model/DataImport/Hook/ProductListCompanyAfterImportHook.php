<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\Model\DataImport\Hook;

use FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface;
use FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;
use Orm\Zed\BrandCompany\Persistence\FosBrandCompanyQuery;
use Spryker\Zed\DataImport\Business\Model\DataImporterAfterImportInterface;

class ProductListCompanyAfterImportHook implements DataImporterAfterImportInterface
{
    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface
     */
    protected $brandCompanyFacade;

    /**
     * @var \FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    protected $productListFacade;

    /**
     * @param \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface $brandCompanyFacade
     * @param \FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface $productListFacade
     */
    public function __construct(
        BrandCompanyFacadeInterface $brandCompanyFacade,
        ProductListFacadeInterface $productListFacade
    ) {
        $this->brandCompanyFacade = $brandCompanyFacade;
        $this->productListFacade = $productListFacade;
    }

    /**
     * @return void
     */
    public function afterImport(): void
    {
        $this->rebuildRelations();
    }

    /**
     * @return void
     */
    protected function rebuildRelations(): void
    {
        $this->deleteCompanyBrandRelations();
        $this->createCompanyBrandRelations();
    }

    /**
     * @return int
     */
    protected function deleteCompanyBrandRelations(): int
    {
        return FosBrandCompanyQuery::create()->doDeleteAll();
    }

    /**
     * @return void
     */
    protected function createCompanyBrandRelations(): void
    {
        $productListCollectionTransfer = $this->productListFacade->getAllProductLists();

        foreach ($productListCollectionTransfer->getProductLists() as $productListTransfer) {
            if (
                count($productListTransfer->getBrandRelation()->getIdBrands()) > 0 &&
                count($productListTransfer->getProductListCompanyRelation()->getCompanyIds()) > 0
            ) {
                $this->saveCompanyBrandRelations(
                    $productListTransfer->getProductListCompanyRelation()->getCompanyIds(),
                    $productListTransfer->getBrandRelation()->getIdBrands()
                );
            }
        }
    }

    /**
     * @param array $companyIds
     * @param array $brandIds
     *
     * @return void
     */
    protected function saveCompanyBrandRelations(array $companyIds, array $brandIds): void
    {
        foreach ($companyIds as $idCompany) {
            $this->brandCompanyFacade->saveCompanyBrandRelation(
                (new CompanyBrandRelationTransfer())->setIdCompany($idCompany)->setIdBrands($brandIds)
            );
        }
    }
}
