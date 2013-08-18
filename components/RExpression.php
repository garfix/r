<?php

/**
 * @author Patrick van Bergen
 */
class RExpression
{
	/** @var string Modifiers like 'm', 's', and 'i' */
	protected $modifiers = '';

	/** @var array The sequential or alternate elements of the expression */
	protected $elements = array();

	/** @var bool Treat elements as alternatives */
	protected $alt = false;

	/* -- shared with RGroup -- */

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

	/* -- end shared with RGroup -- */

	/**
	 * Expert use: add a modifier by its letter.
	 * See also: http://nl3.php.net/manual/en/reference.pcre.pattern.modifiers.php
	 *
	 * @param $modifier
	 * @return $this
	 */
	public function modify($modifier)
	{
		$this->modifiers .= $modifier;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function modifyCaseInsensitive()
	{
		$this->modifiers .= 'i';
		return $this;
	}

	/**
	 * If used, the character . does not match \n
	 *
	 * @return $this
	 */
	public function modifyAnyCharAcceptsNewlines()
	{
		$this->modifiers .= 's';
		return $this;
	}

	/**
	 * Pattern strings are treated as UTF-8
	 *
	 * @return $this
	 */
	public function modifyTreatAsUnicode()
	{
		$this->modifiers .= 'u';
		return $this;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		$separators = '/#%~`&';
		$delimiter = $this->alt ? '|' : '';

		$exp = implode($delimiter, $this->elements);

		$separator = '/';
		for ($i = 0; $i < strlen($separators); $i++) {
			$separator = $separators[$i];
			if (strpos($exp, $separator) === false) {
				break;
			}
		}

		return $separator . $exp . $separator . $this->modifiers;
	}
}
