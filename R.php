<?php

require_once __DIR__ . '/components/RText.php';
require_once __DIR__ . '/components/RChars.php';
require_once __DIR__ . '/components/RAnyChar.php';
require_once __DIR__ . '/components/RGroup.php';
require_once __DIR__ . '/components/RSingleLineExpression.php';
require_once __DIR__ . '/components/RMultiLineExpression.php';
require_once __DIR__ . '/components/RLookAhead.php';
require_once __DIR__ . '/components/RLookBehind.php';

/**
 * Factory class for several R objects.
 *
 * @author Patrick van Bergen
 */
class R
{
	/**
	 * @return RSingleLineExpression
	 */
	public static function expression()
	{
		return new RSingleLineExpression();
	}

	/**
	 * @return RMultiLineExpression
	 */
	public static function multiLineExpression()
	{
		return new RMultiLineExpression();
	}

	/**
	 * @param string $name
	 * @return RGroup
	 */
	public static function group($name = null)
	{
		return new RGroup($name);
	}

	/**
	 * @return RLookAhead
	 */
	public static function lookAhead()
	{
		return new RLookAhead();
	}

	/**
	 * @return RLookBehind
	 */
	public static function lookBehind()
	{
		return new RLookBehind();
	}

	/**
	 * @return RAnyChar
	 */
	public static function anyChar()
	{
		return new RAnyChar();
	}

	/**
	 * @param $text
	 * @return RText
	 */
	public static function text($text)
	{
		return new RText($text);
	}

	/**
	 * @param string $chars
	 * @return RChars
	 */
	public static function chars($chars = '')
	{
		return new RChars($chars);
	}

}