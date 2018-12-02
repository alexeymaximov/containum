<?php

declare(strict_types=1);

namespace ArsMnemonica\Containum;

/**
 * Data structures.
 */
final class containum {

	/**
	 * Create cardinal vector.
	 *
	 * @param int[] $aValues -- values
	 *
	 * @return CardinalVector -- cardinal vector
	 */
	public static function cardinals(int ...$aValues): CardinalVector {
		return new CardinalVector($aValues);
	}

	/**
	 * Create dictionary.
	 *
	 * @param array|NULL $aItems -- items
	 *
	 * @return Dictionary -- dictionary
	 */
	public static function dictionary(array $aItems = null): Dictionary {
		return new Dictionary($aItems);
	}

	/**
	 * Create hash.
	 *
	 * @param callable|NULL $aValueValidator -- value validator
	 * @param string[]|NULL $aItems -- items
	 *
	 * @return Hash -- hash
	 */
	public static function hash(callable $aValueValidator = null, array $aItems = null): Hash {
		return new Hash($aItems, $aValueValidator);
	}

	/**
	 * Create integer vector.
	 *
	 * @param int[] $aValues -- values
	 *
	 * @return IntegerVector -- integer vector
	 */
	public static function integers(int ...$aValues): IntegerVector {
		return new IntegerVector($aValues);
	}

	/**
	 * Create map.
	 *
	 * @param callable|NULL $aKeyValidator -- key validator
	 * @param callable|NULL $aValueValidator -- value validator
	 * @param array|NULL $aItems -- items
	 *
	 * @return Map -- map
	 */
	public static function map(callable $aKeyValidator = null, callable $aValueValidator = null, array $aItems = null): Map {
		return new Map($aItems, $aKeyValidator, $aValueValidator);
	}

	/**
	 * Create numeric vector.
	 *
	 * @param float[] $aValues -- values
	 *
	 * @return NumericVector -- numeric vector
	 */
	public static function numbers(float ...$aValues): NumericVector {
		return new NumericVector($aValues);
	}

	/**
	 * Create object vector.
	 *
	 * @param string|NULL $aBase -- base class or interface
	 * @param array|NULL $aItems -- items
	 *
	 * @return ObjectVector -- object vector
	 */
	public static function objects(string $aBase = null, array $aItems = null): ObjectVector {
		return new ObjectVector($aItems, $aBase);
	}

	/**
	 * Create string vector.
	 *
	 * @param string[] $aValues -- values
	 *
	 * @return StringVector -- string vector
	 */
	public static function strings(string ...$aValues): StringVector {
		return new StringVector($aValues);
	}

	/**
	 * Create vector.
	 *
	 * @param callable|NULL $aValueValidator -- value validator
	 * @param array|NULL $aItems -- items
	 *
	 * @return Vector -- vector
	 */
	public static function vector(callable $aValueValidator = null, array $aItems = null): Vector {
		return new Vector($aItems, $aValueValidator);
	}
}