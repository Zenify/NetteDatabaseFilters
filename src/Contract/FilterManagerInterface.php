<?php

/**
 * This file is part of Zenify
 * Copyright (c) 2016 Tomas Votruba (http://tomasvotruba.cz)
 */

namespace Zenify\NetteDatabaseFilters\Contract;

use Nette\Database\Table\Selection;


interface FilterManagerInterface
{

	/**
	 * Adds filter.
	 */
	function addFilter(FilterInterface $filter);


	/**
	 * @param Selection $selection
	 * @param string $targetTable
	 * @return Selection
	 */
	function applyFilters(Selection $selection, $targetTable);

}
