<?php

require_once __DIR__ . '/RExpression.php';

/**
 * @author Patrick van Bergen
 */
class RSingleLineExpression extends RExpression
{
	/**
	 * @return $this
	 */
	public function startOfString()
	{
		$this->elements[] = '^';
		return $this;
	}

	/**
	 * @return $this
	 */
	public function endOfString()
	{
		$this->elements[] = '$';
		return $this;
	}
}