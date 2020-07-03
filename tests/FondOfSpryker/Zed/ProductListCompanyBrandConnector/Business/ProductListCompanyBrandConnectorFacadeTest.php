<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\Model\CompanyBrandRelationWriterInterface;
use Generated\Shared\Transfer\ProductListCompanyRelationTransfer;

class ProductListCompanyBrandConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorFacade
     */
    protected $productListCompanyBrandConnectorFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListBrandConnector\Business\ProductListBrandConnectorBusinessFactory
     */
    protected $productListBrandConnectorBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListCompanyRelationTransfer
     */
    protected $productListCompanyBrandRelationTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\Model\CompanyBrandRelationWriterInterface
     */
    protected $companyBrandRelationWriterMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListCompanyBrandConnectorBusinessFactoryMock = $this->getMockBuilder(ProductListCompanyBrandConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCompanyBrandRelationTransferMock = $this->getMockBuilder(ProductListCompanyRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBrandRelationWriterMock = $this->getMockBuilder(CompanyBrandRelationWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCompanyBrandConnectorFacade = new ProductListCompanyBrandConnectorFacade();
        $this->productListCompanyBrandConnectorFacade->setFactory($this->productListCompanyBrandConnectorBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testSaveCompanyBrandRelationByIdProductListAndCompanyIds(): void
    {
        $this->productListCompanyBrandConnectorBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createCompanyBrandRelationWriter')
            ->willReturn($this->companyBrandRelationWriterMock);

        $this->companyBrandRelationWriterMock->expects($this->atLeastOnce())
            ->method('saveCompanyBrandRelationByIdProductListAndCompanyIds')
            ->with($this->productListCompanyBrandRelationTransferMock)
            ->willReturn($this->productListCompanyBrandRelationTransferMock);

        $this->assertEquals(
            $this->productListCompanyBrandRelationTransferMock,
            $this->productListCompanyBrandConnectorFacade->saveCompanyBrandRelationByIdProductListAndCompanyIds(
                $this->productListCompanyBrandRelationTransferMock
            )
        );
    }
}
