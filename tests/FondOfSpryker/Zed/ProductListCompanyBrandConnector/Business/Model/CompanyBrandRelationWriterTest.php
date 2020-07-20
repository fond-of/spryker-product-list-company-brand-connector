<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface;
use Generated\Shared\Transfer\BrandRelationTransfer;
use Generated\Shared\Transfer\CompanyBrandRelationTransfer;
use Generated\Shared\Transfer\ProductListCompanyRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class CompanyBrandRelationWriterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface
     */
    protected $productListBrandConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListCompanyBrandConnector\Dependency\Facade\ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface
     */
    protected $brandCompanyFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListCompanyRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListCompanyRelationTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\BrandRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $brandRelationTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBrandRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBrandRelationTransferMock;

    /**
     * @var int
     */
    protected $idProductList;

    /**
     * @var int[]
     */
    protected $companyIds;

    /**
     * @var int[]
     */
    protected $brandIds;

    /**
     * @var \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\Model\CompanyBrandRelationWriter
     */
    protected $companyBrandRelationWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productListBrandConnectorFacadeMock = $this->getMockBuilder(ProductListCompanyBrandConnectorToProductListBrandConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandCompanyFacadeMock = $this->getMockBuilder(ProductListCompanyBrandConnectorToBrandCompanyFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCompanyRelationTransferMock = $this->getMockBuilder(ProductListCompanyRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCompanyRelationTransferMock = $this->getMockBuilder(ProductListCompanyRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->brandRelationTransferMock = $this->getMockBuilder(BrandRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBrandRelationTransferMock = $this->getMockBuilder(CompanyBrandRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idProductList = 1;
        $this->companyIds = [1, 2];
        $this->brandIds = [1];

        $this->companyBrandRelationWriter = new CompanyBrandRelationWriter(
            $this->brandCompanyFacadeMock,
            $this->productListBrandConnectorFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testSaveCompanyBrandRelationByIdProductListAndCompanyIds(): void
    {
        $this->productListCompanyRelationTransferMock->expects($this->atLeastOnce())
            ->method('getCompanyIds')
            ->willReturn($this->companyIds);

        $this->productListCompanyRelationTransferMock->expects($this->atLeastOnce())
            ->method('getIdProductList')
            ->willReturn($this->idProductList);

        $this->productListBrandConnectorFacadeMock->expects($this->atLeastOnce())
            ->method('findProductListBrandRelationByIdProductList')
            ->willReturn($this->brandRelationTransferMock);

        $this->brandRelationTransferMock->expects($this->atLeastOnce())
            ->method('getIdBrands')
            ->willReturn($this->brandIds);

        $this->companyBrandRelationTransferMock->expects($this->atLeastOnce())
            ->method('getIdBrands')
            ->willReturn($this->brandIds);

        $this->brandCompanyFacadeMock->expects($this->atLeastOnce())
            ->method('saveCompanyBrandRelation')
            ->willReturn($this->companyBrandRelationTransferMock);

        $this->brandCompanyFacadeMock->expects($this->atLeastOnce())
            ->method('findCompanyBrandRelationByIdCompany')
            ->willReturn($this->companyBrandRelationTransferMock);

        $productListCompanyRelationTransfer = $this->companyBrandRelationWriter
            ->saveCompanyBrandRelationByIdProductListAndCompanyIds($this->productListCompanyRelationTransferMock);

        $this->assertEquals($this->productListCompanyRelationTransferMock, $productListCompanyRelationTransfer);
    }
}
