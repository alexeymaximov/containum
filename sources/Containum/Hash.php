<?php

declare(strict_types=1);

namespace ArsMnemonica\Containum;

/**
 * Hash.
 */
class Hash extends Map {

	/**
	 * Constructor.
	 *
	 * @param array|NULL $aItems -- items
	 * @param callable|NULL $aValueValidator -- value validator
	 */
	public function __construct(array $aItems = null, callable $aValueValidator = null) {
		parent::__construct($aItems, 'is_string', $aValueValidator);
	}
}