<?php

declare(strict_types=1);

namespace ArsMnemonica\Containum;

/**
 * Numeric vector.
 */
class NumericVector extends Vector {

	/**
	 * Value validator.
	 *
	 * @param mixed $aValue -- value
	 *
	 * @return bool -- value is valid
	 */
	public function __valueValidator($aValue): bool {
		return is_int($aValue) || is_float($aValue);
	}

	/**
	 * Constructor.
	 *
	 * @param float[]|NULL $aItems -- items
	 */
	public function __construct(array $aItems = null) {
		parent::__construct($aItems, [$this, '__valueValidator']);
	}
}