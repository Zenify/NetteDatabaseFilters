<?php

namespace Zenify\NetteDatabaseFilters\Tests\DI;

use Nette\Database\Context;
use Nette\DI\Container;
use PHPUnit_Framework_Assert;
use PHPUnit_Framework_TestCase;
use Zenify\NetteDatabaseFilters\Contract\FilterManagerInterface;
use Zenify\NetteDatabaseFilters\Database\SmartContext;
use Zenify\NetteDatabaseFilters\Tests\ContainerFactory;


final class NetteDatabaseFiltersExtensionMultipleContextTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @var Container
	 */
	private $container;


	protected function setUp()
	{
		$this->container = (new ContainerFactory)->createWithConfig(__DIR__ . '/../config/multiple-context.neon');
	}


	public function testContextWasReplaced()
	{
		foreach ($this->container->findByType(Context::class) as $databaseContextServiceName) {
			$databaseContextService = $this->container->getService($databaseContextServiceName);
			$this->assertInstanceOf(SmartContext::class, $databaseContextService);
		}

		$this->assertCount(2, $this->container->findByType(Context::class));
	}


	public function testFilterManagerWasSet()
	{
		foreach ($this->container->findByType(SmartContext::class) as $databaseContextServiceName) {
			$databaseContextService = $this->container->getService($databaseContextServiceName);

			$this->assertInstanceOf(
				FilterManagerInterface::class,
				PHPUnit_Framework_Assert::getObjectAttribute($databaseContextService, 'filterManager')
			);
		}
	}

}
