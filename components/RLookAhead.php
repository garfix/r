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
	 * @return $this
	 */
	public function negative()
	{
		$this->positive = false;
		return $this;
	}

	protected function getPrefix()
	{
		return $this->positive ? '?=' : '?!';
	}
}
