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
	 * @param $args
	 */
	public function __construct($chars)
	{
		$this->chars = $chars;
	}

	public function not()
	{
		$this->not = true;
	}

	/**
	 * @param $char
	 * @return RChars
	 */
	public function char($char)
	{
		$this->chars .= $char;
		return $this;
	}

	/**
	 * Any of \t \n \r \f
	 *
	 * @param $char
	 * @return RChars
	 */
	public function whitespace()
	{
		$this->chars .= '\s';
		return $this;
	}

	/**
	 * Anything but of \t \n \r \f
	 *
	 * @param $char
	 * @return RChars
	 */
	public function anythingButWhitespace()
	{
		$this->chars .= '\S';
		return $this;
	}

	/**
	 * Letter: a-z and A-Z
	 *
	 * @return RChars
	 */
	public function letter()
	{
		$this->chars .= 'A-Za-z';
		return $this;
	}

	/**
	 * 0-9
	 *
	 * @return RChars
	 */
	public function digit()
	{
		$this->chars .= '\d';
		return $this;
	}

	/**
	 * Any character except 0-9
	 *
	 * @return RChars
	 */
	public function anythingButDigit()
	{
		$this->chars .= '\D';
		return $this;
	}

	/**
	 * Letter or digit or underscore
	 *
	 * @return RChars
	 */
	public function wordCharacter()
	{
		$this->chars .= '\w';
		return $this;
	}

	/**
	 * Anything but letter or digit or underscore
	 *
	 * @return RChars
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