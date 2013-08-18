<?php

/**
 * @author Patrick van Bergen
 */
class RText
{
	protected $text = '';

	/**
	 * @param $args
	 */
	public function __construct($text)
	{
		$this->text = $text;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return str_replace(array('\\', '?', ), array('\\\\', '\?'), $this->text);
#todo: others
	}
}