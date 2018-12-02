<?php

declare(strict_types=1);

namespace ArsMnemonica\Containum;

/**
 * Cardinal vector.
 */
class CardinalVector extends IntegerVector {

	/**
	 * Value validator.
	 *
	 * @param mixed $aValue -- value
	 *
	 * @return bool -- value is valid
	 */
	public function __valueValidator($aValue): bool {
		return is_int($aValue) && $aValue >= 0;
	}
}