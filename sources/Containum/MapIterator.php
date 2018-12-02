<?php

declare(strict_types=1);

namespace ArsMnemonica\Containum;

use Iterator;

/**
 * Map iterator.
 */
class MapIterator implements Iterator {

	/**
	 * @var Map -- map
	 */
	private $_map;

	/**
	 * @var int -- cursor
	 */
	private $_cursor;

	/**
	 * Constructor.
	 *
	 * @param Map $aMap -- map
	 */
	public function __construct(Map $aMap) {
		$this->_map = $aMap;
		$this->_cursor = 0;
	}

	/**
	 * Get current value.
	 *
	 * @return mixed -- current value
	 */
	public function current() {
		return $this->valid() ? $this->_map->getValue($this->_cursor) : null;
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
	 * @return mixed -- current key
	 */
	public function key() {
		return $this->valid() ? $this->_map->getKey($this->_cursor) : null;
	}

	/**
	 * Whether is cursor valid or not.
	 *
	 * @return bool -- cursor is valid
	 */
	public function valid(): bool {
		return $this->_cursor >= 0 && $this->_cursor < count($this->_map);
	}
}