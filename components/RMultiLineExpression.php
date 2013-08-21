<?php

require_once __DIR__ . '/RExpression.php';

/**
 * Special construct for multiline expressions
 * so as to be able to create more correct start- and end-function names
 *
 * @author Patrick van Bergen
 */
class RMultiLineExpression extends RExpression
{
	public function __construct()
	{
		$this->modify('m');
	}

	/**
	 * Asserts that cursor is at the start of the string.
	 *
	 * @return $this
	 */
	public function startOfString()
	{
		$this->elements[] = '\A';
		return $this;
	}

	/**
	 * Asserts that cursor is at the end of the string.
	 *
	 * @return $this
	 */
	public function endOfString()
	{
		$this->elements[] = '\Z';
		return $this;
	}

	/**
	 * Asserts that cursor is at the end of the string or just before a newline which is the last character.
	 *
	 * @return $this
	 */
	public function endOfStringOrNewlineAtEnd()
	{
		$this->elements[] = '\z';
		return $this;
	}

	/**
	 * Asserts that cursor is at the start of the string or of a line.
	 *
	 * @return $this
	 */
	public function startOfStringOrLine()
	{
		$this->elements[] = '^';
		return $this;
	}

	/**
	 * Asserts that cursor is at the end of the string or of a line.
	 *
	 * @return $this
	 */
	public function endOfStringOrLine()
	{
		$this->elements[] = '$';
		return $this;
	}
}
