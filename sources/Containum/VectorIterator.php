<?php

declare(strict_types=1);

namespace ArsMnemonica\Containum;

use Iterator;

/**
 * Vector iterator.
 */
class VectorIterator implements Iterator {

	/**
	 * @var Vector -- vector
	 */
	private $_vector;

	/**
	 * @var int -- cursor
	 */
	private $_cursor;

	/**
	 * Constructor.
	 *
	 * @param Vector $aVector -- vector
	 */
	public function __construct(Vector $aVector) {
		$this->_vector = $aVector;
		$this->_cursor = 0;
	}

	/**
	 * Get current value.
	 *
	 * @return mixed -- current value
	 */
	public function current() {
		return $this->valid() ? $this->_vector[$this->_cursor] : null;
	}

	/**
	 * Move cursor forward to next item.
	 */
	public function next() {
		if ($this->valid()) {
			$this->_cursor++;
		}
	}

	/**
	 * Set cursor to first item.
	 */
	public function rewind() {
		$this->_cursor = 0;
	}

	/**
	 * Get current key.
	 *
	 * @return int|NULL -- current key
	 */
	public function key() {
		return $this->valid() ? $this->_cursor : null;
	}

	/**
	 * Whether is cursor valid or not.
	 *
	 * @return bool -- cursor is valid
	 */
	public function valid(): bool {
		return $this->_cursor >= 0 && $this->_cursor < count($this->_vector);
	}
}