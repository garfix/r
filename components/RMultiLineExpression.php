<?php

require_once __DIR__ . '/RExpression.php';

/**
 * @author Patrick van Bergen
 */
class RMultiLineExpression extends RExpression
{
	public function __construct()
	{
		$this->modify('m');
	}

	/**
	 * @return $this
	 */
	public function startOfString()
	{
		$this->elements[] = '\A';
		return $this;
	}

	/**
	 * @return $this
	 */
	public function endOfString()
	{
		$this->elements[] = '\Z';
		return $this;
	}

	/**
	 * @return $this
	 */
	public function endOfStringOrNewlineAtEnd()
	{
		$this->elements[] = '\z';
		return $this;
	}

	/**
	 * @return $this
	 */
	public function startOfStringOrLine()
	{
		$this->elements[] = '^';
		return $this;
	}

	/**
	 * @return $this
	 */
	public function endOfStringOrLine()
	{
		$this->elements[] = '$';
		return $this;
	}
}
