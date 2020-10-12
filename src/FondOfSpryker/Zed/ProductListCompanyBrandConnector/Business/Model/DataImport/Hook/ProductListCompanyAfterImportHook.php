<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\Model\DataImport\Hook;

use FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface;
use FondOfSpryker\Zed\ProductList\Business\ProductListFacadeInterface;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Orm\Zed\BrandCompany\Persistence\FosBrandCompanyQuery;
use Spryker\Zed\DataImport\Business\Model\DataImporterAfterImportInterface;

class ProductListCompanyAfterImportHook implements DataImporterAfterImportInterface
{
    /**
     * @var \FondOfSpryker\Zed\BrandCompany\Business\BrandCompanyFacadeInterface
     */
    protected $brandCompanyFacade;

    /**
     * @var \Spryker\Zed\ProductList\Business\ProductListFacadeInterface
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
    protected function createCompanyBrandRelations()
    {
        $productListCollectionTransfer = $this->productListFacade->getAllProductLists();

        if ($productListCollectionTransfer === null) {
            return null;
        }

        $companyBrandRelations = [];
        foreach ($productListCollectionTransfer->getProductLists() as $productListTransfer) {
            if (count($productListTransfer->getBrandRelation()->getIdBrands()) > 0 &&
                count($productListTransfer->getProductListCompanyRelation()->getCompanyIds()) > 0
            ) {
                $companyBrandRelations = $this
                    ->buildCompanyBrandRelationsForProductListTransfer($productListTransfer, $companyBrandRelations);
            }
        }

        if (count($companyBrandRelations) === 0) {
            return null;
        }

        $this->saveCompanyBrandRelations($companyBrandRelations);
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     * @param array $companyBrandRelations
     *
     * @return array
     */
    protected function buildCompanyBrandRelationsForProductListTransfer(
        ProductListTransfer $productListTransfer,
        array $companyBrandRelations
    ): array {
        foreach ($productListTransfer->getProductListCompanyRelation()->getCompanyIds() as $companyId) {

            if (array_key_exists($companyId, $companyBrandRelations) === false) {
                $companyBrandRelations[$companyId] = $productListTransfer->getBrandRelation()->getIdBrands();
                continue;
            }

            $companyBrandRelations[$companyId] = array_unique(array_merge(
                $companyBrandRelations[$companyId],
                $productListTransfer->getBrandRelation()->getIdBrands()
            ));
        }

        return $companyBrandRelations;
    }

    /**
     * @param array $companyBrandRelations
     */
    protected function saveCompanyBrandRelations(array $companyBrandRelations): void
    {
        foreach ($companyBrandRelations as $idCompany => $brandIds) {
            $this->brandCompanyFacade->saveCompanyBrandRelation(
                (new CompanyBrandRelationTransfer())->setIdCompany($idCompany)->setIdBrands($brandIds)
            );
        }
    }
}
