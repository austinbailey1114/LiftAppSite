<?php

/**
* 
*/
class SucessPresenter
{
	private $data;
	function __construct($data)
	{
		$this->data = $data;
		$array = array(
			"success" => true,
			"data" => $data
		);
	}
}