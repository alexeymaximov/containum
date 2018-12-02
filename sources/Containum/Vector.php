<?php

declare(strict_types=1);

namespace ArsMnemonica\Containum;

use ArrayAccess;
use Countable;
use InvalidArgumentException;
use IteratorAggregate;
use OutOfBoundsException;

/**
 * Vector.
 */
class Vector implements ArrayAccess, Countable, IteratorAggregate {

	/**
	 * @var array -- values
	 */
	private $_values;

	/**
	 * @var callable|NULL -- value validator
	 */
	private $_valueValidator;

	/**
	 * Assert value.
	 *
	 * @param mixed $aValue -- value
	 *
	 * @throws InvalidArgumentException -- Invalid vector value
	 */
	private function _assertValue($aValue) {
		if ($this->_valueValidator !== null && !($this->_valueValidator)($aValue)) {
			throw new InvalidArgumentException("Invalid vector value");
		}
	}

	/**
	 * Constructor.
	 *
	 * @param array|NULL $aItems -- items
	 * @param callable|NULL $aValueValidator -- value validator
	 */
	public function __construct(array $aItems = null, callable $aValueValidator = null) {
		$this->_values = [];
		$this->_valueValidator = $aValueValidator;
		if ($aItems) {
			foreach ($aItems as $value) {
				$this->_assertValue($value);
				$this->_values[] = $value;
			}
		}
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
	 * @param int $aOffset -- offset
	 *
	 * @return bool -- offset exists
	 *
	 * @throws InvalidArgumentException -- Invalid vector index
	 */
	public function offsetExists($aOffset) {
		if (!is_int($aOffset)) {
			throw new InvalidArgumentException("Invalid vector index");
		}
		return $aOffset >= 0 && $aOffset < count($this->_values);
	}

	/**
	 * Get value at offset.
	 *
	 * @param int $aOffset -- offset
	 *
	 * @return mixed -- value
	 *
	 * @throws InvalidArgumentException -- Invalid vector index
	 * @throws OutOfBoundsException -- Vector index %d out of bounds
	 */
	public function offsetGet($aOffset) {
		if (!is_int($aOffset)) {
			throw new InvalidArgumentException("Invalid vector index");
		}
		if ($aOffset < 0 || $aOffset >= count($this->_values)) {
			throw new OutOfBoundsException("Vector index $aOffset out of bounds");
		}
		return $this->_values[$aOffset];
	}

	/**
	 * Set value at offset.
	 *
	 * @param int|NULL $aOffset -- offset
	 * @param mixed $aValue -- value
	 *
	 * @throws InvalidArgumentException -- Invalid vector index
	 * @throws OutOfBoundsException -- Vector index %d out of bounds
	 */
	public function offsetSet($aOffset, $aValue) {
		if ($aOffset === null) {
			$this->_assertValue($aValue);
			$this->_values[] = $aValue;
		} else {
			if (!is_int($aOffset)) {
				throw new InvalidArgumentException("Invalid vector index");
			}
			if ($aOffset < 0 || $aOffset >= count($this->_values)) {
				throw new OutOfBoundsException("Vector index $aOffset out of bounds");
			}
			$this->_assertValue($aValue);
			$this->_values[$aOffset] = $aValue;
		}
	}

	/**
	 * Unset offset.
	 *
	 * @param int $aOffset -- offset
	 *
	 * @throws InvalidArgumentException -- Invalid vector index
	 * @throws OutOfBoundsException -- Vector index %d out of bounds
	 */
	public function offsetUnset($aOffset) {
		if (!is_int($aOffset)) {
			throw new InvalidArgumentException("Invalid vector index");
		}
		if ($aOffset < 0 || $aOffset >= count($this->_values)) {
			throw new OutOfBoundsException("Vector index $aOffset out of bounds");
		}
		array_splice($this->_values, $aOffset, 1);
	}

	/**
	 * Get items count.
	 *
	 * @return int -- items count
	 */
	public function count() {
		return count($this->_values);
	}

	/**
	 * Get iterator.
	 *
	 * @return VectorIterator -- iterator
	 */
	public function getIterator(): VectorIterator {
		return new VectorIterator($this);
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

	/**
	 * Add values.
	 *
	 * @param array[] $aValues -- values
	 *
	 * @return $this
	 */
	public function add(...$aValues) {
		foreach ($aValues as $value) {
			$this->_assertValue($value);
			$this->_values[] = $value;
		}
		return $this;
	}
}