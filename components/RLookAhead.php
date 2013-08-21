<?php

require_once __DIR__ . '/RGroup.php';

/**
 * @author Patrick van Bergen
 */
class RLookAhead extends RGroup
{
	private $positive = true;

	public function __construct()
	{
	}

	/**
	 * Do _not_ match the contents of this look ahead.
	 *
	 * @return $this
	 */
	public function negative()
	{
		$this->positive = false;
		return $this;
	}

	/**
	 * Returns the prefix of the expression, based on its type.
	 *
	 * @return string
	 */
	protected function getPrefix()
	{
		return $this->positive ? '?=' : '?!';
	}
}
