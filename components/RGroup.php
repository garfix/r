<?php

require_once __DIR__ . '/RQuantifiable.php';

/**
 * @author Patrick van Bergen
 */
class RGroup extends RQuantifiable
{
	protected $name;

	/** @var  array */
	protected $elements = array();

	/** @var bool Treat elements as alternatives */
	protected $alt = false;

	/** @var bool Capture? */
	protected $capture = true;

	/**
	 * @param $args
	 */
	public function __construct($name = null)
	{
		$this->name = $name;
	}

	/* -- shared with RExpression -- */

	/**
	 * Turn this group into a set of alternatives (or)
	 *
	 * @return $this
	 */
	public function oneOfThese()
	{
		$this->alt = true;
		return $this;
	}

	/**
	 * Match a string of plain text.
	 *
	 * @param string $text
	 * @return $this
	 */
	public function text($text)
	{
		$escape = preg_replace('/([\\\\\\^\\$\\.\\[\\]\\|\\(\\)\\?\\*\\+\\{\\}])/', '\\\\$1', $text);

		$this->elements[] = $escape;
		return $this;
	}

	/**
	 * Add an expression as it would be typed in a regular expression.
	 *
	 * @param string $expression
	 * @return $this
	 */
	public function raw($expression)
	{
		$this->elements[] = $expression;
		return $this;
	}

	/**
	 * Match one of the characters specified in $Chars.
	 *
	 * @param RChars $Chars
	 * @return $this
	 */
	public function inChars(RChars $Chars)
	{
		$this->elements[] = $Chars;
		return $this;
	}

	/**
	 * Match one of the characters _not_ specified in $Chars.
	 *
	 * @param RChars $Chars
	 * @return $this
	 */
	public function notInChars(RChars $Chars)
	{
		$Chars->not();
		$this->elements[] = $Chars;
		return $this;
	}

	/**
	 * Match one of the characters specified in $Chars.
	 * Alternative wording for self::inChars() to express the fact that
	 * you will be using just a single character.
	 *
	 * @param RCharBase $Chars Either RAnyChar or RChars
	 * @return $this
	 */
	public function char(RCharBase $Chars)
	{
		$this->elements[] = $Chars;
		return $this;
	}

	/**
	 * On the one side of the cursor is a word character (letter, digit, or underscore),
	 * on the other side a non-word character.
	 *
	 * @return $this
	 */
	public function wordBoundary()
	{
		$this->elements[] = '\b';
		return $this;
	}

	/**
	 * The cursor is not at a @see RChars::wordBoundary
	 *
	 * @return $this
	 */
	public function anythingButWordBoundary()
	{
		$this->elements[] = '\B';
		return $this;
	}

	/**
	 * Start a subpattern.
	 *
	 * @param RGroup $Group
	 * @return $this
	 */
	public function group(RGroup $Group)
	{
		$this->elements[] = $Group;
		return $this;
	}

	/**
	 * Assert that the expression $LookAhead is matched _after_ the cursor,
	 * but do not "eat" it.
	 *
	 * @param RLookAhead $LookAhead
	 * @return $this;
	 */
	public function lookAhead(RLookAhead $LookAhead)
	{
		$this->elements[] = $LookAhead;
		return $this;
	}

	/**
	 * Assert that the expression $LookBehind is matched _before_ the cursor,
	 * but do not "eat" it.
	 *
	 * @param RLookBehind $LookBehind
	 * @return $this;
	 */
	public function lookBehind(RLookBehind $LookBehind)
	{
		$this->elements[] = $LookBehind;
		return $this;
	}

	/**
	 * Convenience method to match 1 or more whitespace characters.
	 *
	 * @return $this
	 */
	public function whitespace()
	{
		$this->elements[] = '\\s+';
		return $this;
	}

	/**
	 * Convenience method to match 0 or more whitespace characters.
	 *
	 * @return $this
	 */
	public function optionalWhitespace()
	{
		$this->elements[] = '\\s*';
		return $this;
	}

	/**
	 * Match the same characters as matched by the $index-th subpattern (group).
	 *
	 * @param int $index The index of a captured group the the expression
	 * @return $this
	 */
	public function backReference($index)
	{
		$this->elements[] = '\\' . $index;
		return $this;
	}

	/* -- end shared with RExpression -- */

	/**
	 * Asserts start of line.
	 *
	 * @return $this
	 */
	public function startOfLine()
	{
		$this->elements[] = '^';
		return $this;
	}

	/**
	 * Asserts end of line.
	 *
	 * @return $this
	 */
	public function endOfLine()
	{
		$this->elements[] = '$';
		return $this;
	}

	/**
	 * Make this group 'non-capturing', i.e. it will not end up in the search results.
	 *
	 * @return RGroup
	 */
	public function dontCapture()
	{
		$this->capture = false;
		return $this;
	}

	/**
	 * Returns the prefix of the expression, based on its type.
	 *
	 * @return string
	 */
	protected function getPrefix()
	{
		if (!$this->capture) {
			return "?:";
		} elseif (is_null($this->name)) {
			return "";
		} else {
			return "?P<{$this->name}>";
		}
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		$delimiter = $this->alt ? '|' : '';

		return "(" . $this->getPrefix() . implode($delimiter, $this->elements) . ")" . $this->getModifierString();
	}
}