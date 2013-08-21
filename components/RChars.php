<?php

require_once __DIR__ . '/RCharBase.php';

/**
 * @author Patrick van Bergen
 */
class RChars extends RCharBase
{
	protected $chars = array();

	protected $not = false;

	/**
	 * Set one or more characters,
	 * either plain characters or escape sequences (like \n)
	 *
	 * @param string $chars
	 */
	public function __construct($chars)
	{
		$this->chars = $chars;
	}

	/**
	 * Match characters _not_ in this set.
	 * This method is called for you by RExpression::notInChars and RGroup::notInChars
	 */
	public function not()
	{
		$this->not = true;
	}

	/**
	 * Add one or more characters,
	 * either plain characters or escape sequences (like \n)
	 *
	 * @param string $chars
	 * @return $this
	 */
	public function char($chars)
	{
		$this->chars .= $chars;
		return $this;
	}

	/**
	 * Match any of \t \n \r \f
	 *
	 * @return $this
	 */
	public function whitespace()
	{
		$this->chars .= '\s';
		return $this;
	}

	/**
	 * Match anything but of \t \n \r \f
	 *
	 * @return $this
	 */
	public function anythingButWhitespace()
	{
		$this->chars .= '\S';
		return $this;
	}

	/**
	 * Match a letter (either uppercase or lowercase): a-z and A-Z
	 *
	 * @return $this
	 */
	public function letter()
	{
		$this->chars .= 'A-Za-z';
		return $this;
	}

	/**
	 * Match a digit (0-9)
	 *
	 * @return $this
	 */
	public function digit()
	{
		$this->chars .= '\d';
		return $this;
	}

	/**
	 * Match any character except a digit (0-9)
	 *
	 * @return $this
	 */
	public function anythingButDigit()
	{
		$this->chars .= '\D';
		return $this;
	}

	/**
	 * Match a letter or digit or underscore character
	 *
	 * @return $this
	 */
	public function wordCharacter()
	{
		$this->chars .= '\w';
		return $this;
	}

	/**
	 * Match anything but a letter or digit or underscore
	 *
	 * @return $this
	 */
	public function anythingButWordCharacter()
	{
		$this->chars .= '\W';
		return $this;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		// characters that should be escaped: ]
		// (the character is not preceded by a \)
		$escapedChars = preg_replace('/(^|[^\\\\])(])/', '\1\\\\\2', $this->chars);

		// characters that should be escaped: \
		// (the \ is not followed by one of the known special characters)
		$escapedChars = preg_replace('/(\\\\)($|[^\\\\abcCdDefnpPrsStwWx\d\\]])/', '\1\1\2', $escapedChars);

		return "[" . ($this->not ? '^' : '') .  $escapedChars . "]" . $this->getModifierString();
	}
}