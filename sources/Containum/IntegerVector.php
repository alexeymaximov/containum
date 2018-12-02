<?php

declare(strict_types=1);

namespace ArsMnemonica\Containum;

/**
 * Integer vector.
 */
class IntegerVector extends NumericVector {

	/**
	 * Value validator.
	 *
	 * @param mixed $aValue -- value
	 *
	 * @return bool -- value is valid
	 */
	public function __valueValidator($aValue): bool {
		return is_int($aValue);
	}
}