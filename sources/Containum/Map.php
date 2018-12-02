<?php

declare(strict_types=1);

namespace ArsMnemonica\Containum;

use ArrayAccess;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use OutOfBoundsException;
use RuntimeException;

/**
 * Map.
 */
class Map implements ArrayAccess, Countable, IteratorAggregate {

	/**
	 * @var array -- keys
	 */
	private $_keys;

	/**
	 * @var array -- values
	 */
	private $_values;

	/**
	 * @var callable|NULL -- key validator
	 */
	private $_keyValidator;

	/**
	 * @var callable|NULL -- value validator
	 */
	private $_valueValidator;

	/**
	 * Assert key.
	 *
	 * @param mixed $aKey -- key
	 *
	 * @throws InvalidArgumentException -- Invalid map key
	 */
	private function _assertKey($aKey) {
		if ($this->_keyValidator !== null && !($this->_keyValidator)($aKey)) {
			throw new InvalidArgumentException("Invalid map key");
		}
	}

	/**
	 * Assert value.
	 *
	 * @param mixed $aValue -- value
	 *
	 * @throws InvalidArgumentException -- Invalid map value
	 */
	private function _assertValue($aValue) {
		if ($this->_valueValidator !== null && !($this->_valueValidator)($aValue)) {
			throw new InvalidArgumentException("Invalid map value");
		}
	}

	/**
	 * Add item.
	 *
	 * @param mixed $aKey -- key
	 * @param mixed $aValue -- value
	 */
	private function _add($aKey, $aValue) {
		$this->_assertKey($aKey);
		$this->_assertValue($aValue);
		$this->_keys[] = $aKey;
		$this->_values[] = $aValue;
	}

	/**
	 * Constructor.
	 *
	 * @param array|NULL $aItems -- items
	 * @param callable|NULL $aKeyValidator -- key validator
	 * @param callable|NULL $aValueValidator -- value validator
	 */
	public function __construct(array $aItems = null, callable $aKeyValidator = null, callable $aValueValidator = null) {
		$this->_keys = [];
		$this->_values = [];
		$this->_keyValidator = $aKeyValidator;
		$this->_valueValidator = $aValueValidator;
		if ($aItems) {
			foreach ($aItems as $key => $value) {
				$this->_add($key, $value);
			}
		}
	}

	/**
	 * Get key.
	 *
	 * @param int $aIndex -- index
	 *
	 * @return mixed -- key
	 *
	 * @throws OutOfBoundsException -- Map index %d out of bounds
	 */
	public function getKey(int $aIndex) {
		if ($aIndex < 0 || $aIndex >= count($this->_keys)) {
			throw new OutOfBoundsException("Map index $aIndex out of bounds");
		}
		return $this->_keys[$aIndex];
	}

	/**
	 * Get value.
	 *
	 * @param int $aIndex -- index
	 *
	 * @return mixed -- value
	 *
	 * @throws OutOfBoundsException -- Map index %d out of bounds
	 */
	public function getValue(int $aIndex) {
		if ($aIndex < 0 || $aIndex >= count($this->_values)) {
			throw new OutOfBoundsException("Map index $aIndex out of bounds");
		}
		return $this->_values[$aIndex];
	}

	/**
	 * Get index of key.
	 *
	 * @param mixed $aKey -- key
	 *
	 * @return int|NULL -- index
	 */
	public function indexOfKey($aKey) {
		if (false !== $index = array_search($aKey, $this->_keys, true)) {
			return $index;
		}
		return null;
	}

	/**
	 * Get index of value.
	 *
	 * @param mixed $aValue -- value
	 *
	 * @return int|NULL -- index
	 */
	public function indexOf($aValue) {
		if (false !== $index = array_search($aValue, $this->_values, true)) {
			return $index;
		}
		return null;
	}

	/**
	 * Whether offset exists or not.
	 *
	 * @param mixed $aOffset -- offset
	 *
	 * @return bool -- offset exists
	 */
	public function offsetExists($aOffset): bool {
		return $this->indexOfKey($aOffset) !== null;
	}

	/**
	 * Get value at offset.
	 *
	 * @param mixed $aOffset -- offset
	 *
	 * @return mixed -- value
	 *
	 * @throws RuntimeException -- Map key not found
	 */
	public function offsetGet($aOffset) {
		if (null !== $index = $this->indexOfKey($aOffset)) {
			return $this->_values[$index];
		}
		throw new RuntimeException("Map key not found");
	}

	/**
	 * Set value ast offset.
	 *
	 * @param mixed $aOffset -- offset
	 * @param mixed $aValue -- value
	 */
	public function offsetSet($aOffset, $aValue) {
		if (null !== $index = $this->indexOfKey($aOffset)) {
			$this->_assertValue($aValue);
			$this->_values[$index] = $aValue;
		} else {
			$this->_add($aOffset, $aValue);
		}
	}

	/**
	 * Unset offset.
	 *
	 * @param mixed $aOffset -- offset
	 *
	 * @throws RuntimeException -- Map key not found
	 */
	public function offsetUnset($aOffset) {
		if (null !== $index = $this->indexOfKey($aOffset)) {
			array_splice($this->_keys, $index, 1);
			array_splice($this->_values, $index, 1);
		}
		throw new RuntimeException("Map key not found");
	}

	/**
	 * Get items count.
	 *
	 * @return int -- items count
	 */
	public function count(): int {
		return count($this->_values);
	}

	/**
	 * Get iterator.
	 *
	 * @return MapIterator -- iterator
	 */
	public function getIterator(): MapIterator {
		return new MapIterator($this);
	}

	/**
	 * Set items.
	 *
	 * @param array $aItems -- items
	 *
	 * @return $this
	 */
	public function set(array $aItems) {
		foreach ($aItems as $key => $value) {
			$this->offsetSet($key, $value);
		}
		return $this;
	}
}