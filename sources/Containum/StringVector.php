<?php

declare(strict_types=1);

namespace ArsMnemonica\Containum;

/**
 * String vector.
 */
class StringVector extends Vector {

	/**
	 * Constructor.
	 *
	 * @param string[]|NULL $aItems -- items
	 */
	public function __construct(array $aItems = null) {
		parent::__construct($aItems, 'is_string');
	}
}