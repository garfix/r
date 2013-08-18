<?php

require_once __DIR__ . '/RCharBase.php';

/**
 * @author Patrick van Bergen
 */
class RAnyChar extends RCharBase
{
	/**
	 * @return string
	 */
	public function __toString()
	{
		return "." . $this->getModifierString();
	}
}