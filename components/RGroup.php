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
	 * @param $text
	 * @return $this
	 */
	public function text($text)
	{
		$this->elements[] = $text;
		return $this;
	}

	/**
	 * @param RChars $Chars
	 * @return $this
	 */
	public function inChars(RChars $Chars)
	{
		$this->elements[] = $Chars;
		return $this;
	}

	/**
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
	 * @param RCharBase $Chars
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
	 * The cursor is not at a @see RGroup::wordBoundary
	 *
	 * @return $this
	 */
	public function anythingButWordBoundary()
	{
		$this->elements[] = '\B';
		return $this;
	}

	/**
	 * @param RGroup $Group
	 * @return $this
	 */
	public function group(RGroup $Group)
	{
		$this->elements[] = $Group;
		return $this;
	}

	/**
	 * @param RLookAhead $LookAhead
	 * @return $this;
	 */
	public function lookAhead(RLookAhead $LookAhead)
	{
		$this->elements[] = $LookAhead;
		return $this;
	}

	/**
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
	 * @return $this
	 */
	public function whitespace()
	{
		$this->elements[] = '\\s+';
		return $this;
	}

	/**
	 * Convenience method to match 0 or more whitespace characters.
	 * @return $this
	 */
	public function optionalWhitespace()
	{
		$this->elements[] = '\\s*';
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
	 * Asserts start of line.
	 *
	 * @return $this
	 */
	public function endOfLine()
	{
		$this->elements[] = '$';
		return $this;
	}

	/**
	 * Make this group 'non-capturing', i.e. it will not end up in the match results.
	 *
	 * @return RGroup
	 */
	public function dontCapture()
	{
		$this->capture = false;
		return $this;
	}

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