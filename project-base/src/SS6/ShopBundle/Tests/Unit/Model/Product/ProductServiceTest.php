<?php

namespace SS6\ShopBundle\Tests\Unit\Model\Product;

use PHPUnit_Framework_TestCase;
use SS6\ShopBundle\Model\Pricing\BasePriceCalculation;
use SS6\ShopBundle\Model\Pricing\InputPriceCalculation;
use SS6\ShopBundle\Model\Pricing\PricingSetting;
use SS6\ShopBundle\Model\Pricing\Vat\Vat;
use SS6\ShopBundle\Model\Pricing\Vat\VatData;
use SS6\ShopBundle\Model\Product\Pricing\ProductPriceCalculation;
use SS6\ShopBundle\Model\Product\Pricing\ProductPriceRecalculationScheduler;
use SS6\ShopBundle\Model\Product\Product;
use SS6\ShopBundle\Model\Product\ProductData;
use SS6\ShopBundle\Model\Product\ProductService;

class ProductServiceTest extends PHPUnit_Framework_TestCase {

	public function testEditSchedulesPriceRecalculation() {
		$productPriceCalculationMock = $this->getMockBuilder(ProductPriceCalculation::class)
			->disableOriginalConstructor()
			->getMock();
		$inputPriceCalculationMock = $this->getMockBuilder(InputPriceCalculation::class)
			->disableOriginalConstructor()
			->getMock();
		$basePriceCalculationMock = $this->getMockBuilder(BasePriceCalculation::class)
			->disableOriginalConstructor()
			->getMock();
		$pricingSettingMock = $this->getMockBuilder(PricingSetting::class)
			->disableOriginalConstructor()
			->getMock();
		$productPriceRecalculationSchedulerMock = $this->getMockBuilder(ProductPriceRecalculationScheduler::class)
			->disableOriginalConstructor()
			->getMock();
		$productPriceRecalculationSchedulerMock->expects($this->once())->method('scheduleRecalculatePriceForProduct');

		$productService = new ProductService(
			$productPriceCalculationMock,
			$inputPriceCalculationMock,
			$basePriceCalculationMock,
			$pricingSettingMock,
			$productPriceRecalculationSchedulerMock
		);

		$productData = new ProductData();
		$product = new Product($productData);

		$productService->edit($product, $productData);
	}

	public function testSetInputPriceSchedulesPriceRecalculation() {
		$productPriceCalculationMock = $this->getMockBuilder(ProductPriceCalculation::class)
			->disableOriginalConstructor()
			->getMock();
		$inputPriceCalculationMock = $this->getMockBuilder(InputPriceCalculation::class)
			->disableOriginalConstructor()
			->getMock();
		$basePriceCalculationMock = $this->getMockBuilder(BasePriceCalculation::class)
			->disableOriginalConstructor()
			->getMock();
		$pricingSettingMock = $this->getMockBuilder(PricingSetting::class)
			->disableOriginalConstructor()
			->getMock();
		$productPriceRecalculationSchedulerMock = $this->getMockBuilder(ProductPriceRecalculationScheduler::class)
			->disableOriginalConstructor()
			->getMock();
		$productPriceRecalculationSchedulerMock->expects($this->once())->method('scheduleRecalculatePriceForProduct');

		$productService = new ProductService(
			$productPriceCalculationMock,
			$inputPriceCalculationMock,
			$basePriceCalculationMock,
			$pricingSettingMock,
			$productPriceRecalculationSchedulerMock
		);

		$productData = new ProductData();
		$product = new Product($productData);

		$productService->setInputPrice($product, 100);
	}

	public function testChangeVatSchedulesPriceRecalculation() {
		$productPriceCalculationMock = $this->getMockBuilder(ProductPriceCalculation::class)
			->disableOriginalConstructor()
			->getMock();
		$inputPriceCalculationMock = $this->getMockBuilder(InputPriceCalculation::class)
			->disableOriginalConstructor()
			->getMock();
		$basePriceCalculationMock = $this->getMockBuilder(BasePriceCalculation::class)
			->disableOriginalConstructor()
			->getMock();
		$pricingSettingMock = $this->getMockBuilder(PricingSetting::class)
			->disableOriginalConstructor()
			->getMock();
		$productPriceRecalculationSchedulerMock = $this->getMockBuilder(ProductPriceRecalculationScheduler::class)
			->disableOriginalConstructor()
			->getMock();
		$productPriceRecalculationSchedulerMock->expects($this->once())->method('scheduleRecalculatePriceForProduct');

		$productService = new ProductService(
			$productPriceCalculationMock,
			$inputPriceCalculationMock,
			$basePriceCalculationMock,
			$pricingSettingMock,
			$productPriceRecalculationSchedulerMock
		);

		$productData = new ProductData();
		$product = new Product($productData);

		$vatData = new VatData();
		$vat = new Vat($vatData);

		$productService->changeVat($product, $vat);
	}

	public function testDeleteNotVariant() {
		$productPriceCalculationMock = $this->getMock(ProductPriceCalculation::class, null, [], '', false);
		$inputPriceCalculationMock = $this->getMock(InputPriceCalculation::class, null, [], '', false);
		$basePriceCalculationMock = $this->getMock(BasePriceCalculation::class, null, [], '', false);
		$pricingSettingMock = $this->getMock(PricingSetting::class, null, [], '', false);
		$productPriceRecalculationSchedulerMock = $this->getMock(ProductPriceRecalculationScheduler::class, null, [], '', false);

		$productService = new ProductService(
			$productPriceCalculationMock,
			$inputPriceCalculationMock,
			$basePriceCalculationMock,
			$pricingSettingMock,
			$productPriceRecalculationSchedulerMock
		);

		$productData = new ProductData();
		$product = new Product($productData);

		$this->assertNull($productService->delete($product));
	}

	public function testDeleteVariant() {
		$productPriceCalculationMock = $this->getMock(ProductPriceCalculation::class, null, [], '', false);
		$inputPriceCalculationMock = $this->getMock(InputPriceCalculation::class, null, [], '', false);
		$basePriceCalculationMock = $this->getMock(BasePriceCalculation::class, null, [], '', false);
		$pricingSettingMock = $this->getMock(PricingSetting::class, null, [], '', false);
		$productPriceRecalculationSchedulerMock = $this->getMock(ProductPriceRecalculationScheduler::class, null, [], '', false);

		$productService = new ProductService(
			$productPriceCalculationMock,
			$inputPriceCalculationMock,
			$basePriceCalculationMock,
			$pricingSettingMock,
			$productPriceRecalculationSchedulerMock
		);

		$productData = new ProductData();
		$mainVariant = new Product($productData);
		$variant = new Product($productData);
		$mainVariant->setVariants([$variant]);

		$this->assertSame($mainVariant, $productService->delete($variant));
	}

	public function testDeleteMainVariant() {
		$productPriceCalculationMock = $this->getMock(ProductPriceCalculation::class, null, [], '', false);
		$inputPriceCalculationMock = $this->getMock(InputPriceCalculation::class, null, [], '', false);
		$basePriceCalculationMock = $this->getMock(BasePriceCalculation::class, null, [], '', false);
		$pricingSettingMock = $this->getMock(PricingSetting::class, null, [], '', false);
		$productPriceRecalculationSchedulerMock = $this->getMock(ProductPriceRecalculationScheduler::class, null, [], '', false);

		$productService = new ProductService(
			$productPriceCalculationMock,
			$inputPriceCalculationMock,
			$basePriceCalculationMock,
			$pricingSettingMock,
			$productPriceRecalculationSchedulerMock
		);

		$productData = new ProductData();
		$mainVariant = new Product($productData);
		$variant = new Product($productData);
		$mainVariant->setVariants([$variant]);

		$this->assertNull($productService->delete($mainVariant));
		$this->assertFalse($variant->isVariant());
	}

}
