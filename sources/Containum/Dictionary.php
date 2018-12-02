<?php

declare(strict_types=1);

namespace ArsMnemonica\Containum;

/**
 * Dictionary.
 */
class Dictionary extends Hash {

	/**
	 * Constructor.
	 *
	 * @param array|NULL $aItems -- items
	 */
	public function __construct(array $aItems = null) {
		parent::__construct($aItems, 'is_string');
	}
}