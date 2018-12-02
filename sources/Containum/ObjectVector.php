<?php

declare(strict_types=1);

namespace ArsMnemonica\Containum;

use InvalidArgumentException;

/**
 * Object vector.
 */
class ObjectVector extends Vector {

	/**
	 * @var string|NULL -- base class or interface
	 */
	private $_base;

	/**
	 * Constructor.
	 *
	 * @param object[]|NULL $aItems -- items
	 * @param string|NULL $aBase -- base class or interface
	 *
	 * @throws InvalidArgumentException -- Invalid object vector base
	 */
	public function __construct(array $aItems = null, string $aBase = null) {
		if ($aBase !== null && !class_exists($aBase) && !interface_exists($aBase)) {
			throw new InvalidArgumentException("Invalid object vector base");
		}
		$this->_base = $aBase;
		parent::__construct($aItems, function ($aValue): bool {
			return $this->_base === null ? is_object($aValue) : $aValue instanceof $this->_base;
		});
	}

	/**
	 * Get base class or interface.
	 *
	 * @return string|NULL -- base class or interface
	 */
	public function getBase() {
		return $this->_base;
	}
}