<?php

require_once __DIR__ . '/RExpression.php';

/**
 * @author Patrick van Bergen
 */
class RSingleLineExpression extends RExpression
{
	/**
	 * Asserts that cursor is at the start of the string.
	 *
	 * @return $this
	 */
	public function startOfString()
	{
		$this->elements[] = '^';
		return $this;
	}

	/**
	 * Asserts that cursor is at the end of the string.
	 *
	 * @return $this
	 */
	public function endOfString()
	{
		$this->elements[] = '$';
		return $this;
	}
}