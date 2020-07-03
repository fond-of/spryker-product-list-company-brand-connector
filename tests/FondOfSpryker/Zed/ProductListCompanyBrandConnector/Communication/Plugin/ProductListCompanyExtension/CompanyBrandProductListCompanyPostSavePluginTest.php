<?php

namespace FondOfSpryker\Zed\ProductListCompanyBrandConnector\Communication\ProductListCompanyExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorFacadeInterface;
use FondOfSpryker\Zed\ProductListCompanyBrandConnector\Communication\Plugin\ProductListCompanyExtension\CompanyBrandProductListCompanyPostSavePlugin;
use Generated\Shared\Transfer\ProductListCompanyRelationTransfer;

class CompanyBrandProductListCompanyPostSavePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Communication\Plugin\ProductListCompanyExtension\CompanyBrandProductListCompanyPostSavePlugin
     */
    protected $companyBrandProductListCompanyPostSavePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorFacadeInterface
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
        $this->productListCompanyBrandConnectorFacadeMock = $this->getMockBuilder(ProductListCompanyBrandConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListCompanyRelationTransferMock = $this->getMockBuilder(ProductListCompanyRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBrandProductListCompanyPostSavePlugin = new class (
            $this->productListCompanyBrandConnectorFacadeMock
        ) extends CompanyBrandProductListCompanyPostSavePlugin {
            /**
             * @var \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorFacadeInterface
             */
            protected $productListCompanyBrandConnectorFacade;

            /**
             * @param \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorFacadeInterface $productListCompanyBrandConnectorFacade
             */
            public function __construct(ProductListCompanyBrandConnectorFacadeInterface $productListCompanyBrandConnectorFacade)
            {
                $this->productListCompanyBrandConnectorFacade = $productListCompanyBrandConnectorFacade;
            }

            /**
             * @return \FondOfSpryker\Zed\ProductListCompanyBrandConnector\Business\ProductListCompanyBrandConnectorFacadeInterface
             */
            public function getFacade(): ProductListCompanyBrandConnectorFacadeInterface
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
