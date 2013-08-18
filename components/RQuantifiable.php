<?php

/**
 * @author Patrick van Bergen
 */
class RQuantifiable
{
	protected $greed = 'greedy';

	protected $min = 1;

	protected $max = 1;

	/**
	 * @return $this
	 */
	public function optional()
	{
		$this->min = 0;
		$this->max = 1;
		return $this;
	}

	/**
	 * @param $min
	 * @param $max
	 * @return $this
	 */
	public function interval($min, $max)
	{
		$this->min = $min;
		$this->max = $max;
		return $this;
	}

	/**
	 * @param $min
	 * @return $this
	 */
	public function atLeast($min)
	{
		$this->min = $min;
		$this->max = null;
		return $this;
	}

	/**
	 * @param $min
	 * @return $this
	 */
	public function times($min)
	{
		$this->min = $min;
		$this->max = $min;
		return $this;
	}

	/**
	 * @param $max
	 * @return $this
	 */
	public function atMost($max)
	{
		$this->min = $max == 0 ? 0 : 1;
		$this->max = $max;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function oneOrMore()
	{
		$this->min = 1;
		$this->max = null;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function asFewAsPossible()
	{
		$this->greed = 'lazy';
		return $this;
	}

	/**
	 * @return $this
	 */
	public function asMuchAsPossibleWhileStillMatching()
	{
		$this->greed = 'greedy';
		$this->max = null;
		return $this;
	}

	/**
	 * @return $this
	 */
	public function asMuchAsPossible()
	{
		$this->greed = 'possessive';
		$this->max = null;
		return $this;
	}

	/**
	 * @return string
	 */
	protected function getModifierString()
	{
		if ($this->min == 0) {
			if ($this->max == 0) {
				$exp = "{0}";
			} elseif ($this->max == 1) {
				$exp = "?";
			} elseif ($this->max === 0) {
				$exp = "*";
			} else {
				$exp = "{" . $this->min . "," . $this->max . "}";
			}
		} elseif ($this->min == 1) {
			if ($this->max == 1) {
				$exp = "";
			} elseif ($this->max === null) {
				$exp = "+";
			} else {
				$exp = "{" . $this->min . "," . $this->max . "}";
			}

		} else {
			$exp = "{" . $this->min . "," . $this->max . "}";
		}

		if ($this->greed == 'possessive') {
			$exp .= '+';
		} elseif ($this->greed == 'lazy') {
			$exp .= '?';
		}

		return $exp;
	}
}