<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Communication\ProductListCompanyExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorFacade;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Communication\Plugin\ProductListCompanyExtension\CompanyBrandProductListCompanyPostSavePlugin;
use Generated\Shared\Transfer\ProductListCompanyRelationTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class CompanyBrandProductListCompanyPostSavePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Communication\Plugin\ProductListCompanyExtension\CompanyBrandProductListCompanyPostSavePlugin
     */
    protected $companyBrandProductListCompanyPostSavePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorFacade
     */
    protected $productListCompanyBrandConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ProductListCompanyRelationTransfer
     */
    protected $productListCompanyRelationTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->productListCompanyBrandConnectorFacadeMock = $this->getMockBuilder(ProductListCompanyBrandConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCompanyRelationTransferMock = $this->getMockBuilder(ProductListCompanyRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBrandProductListCompanyPostSavePlugin = new class (
            $this->productListCompanyBrandConnectorFacadeMock
        ) extends CompanyBrandProductListCompanyPostSavePlugin {
            /**
             * @var \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorFacade
             */
            protected $productListCompanyBrandConnectorFacade;

            /**
             * @param \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorFacade $productListCompanyBrandConnectorFacade
             */
            public function __construct(ProductListCompanyBrandConnectorFacade $productListCompanyBrandConnectorFacade)
            {
                $this->productListCompanyBrandConnectorFacade = $productListCompanyBrandConnectorFacade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->productListCompanyBrandConnectorFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testPost(): void
    {
        $this->productListCompanyBrandConnectorFacadeMock->expects($this->atLeastOnce())
            ->method('saveCompanyBrandRelationByIdProductListAndCompanyIds')
            ->with($this->productListCompanyRelationTransferMock)
            ->willReturn($this->productListCompanyRelationTransferMock);

        $this->assertInstanceOf(
            ProductListCompanyRelationTransfer::class,
            $this->companyBrandProductListCompanyPostSavePlugin->postSave(
                $this->productListCompanyRelationTransferMock
            )
        );
    }
}
