<?php

class Statement {
	/*
	* generically build an array of data with only one id parameter.
	* $mysqli is an sqli object, $sql is the statement, and $id is
	* the id of the user
	*/
	function getData($mysqli, $sql, $id) {
		//create and execute statement
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param('i', $id);
		$stmt->execute();

		//build array with generic data
		$result = $stmt->get_result();
		$data = array();
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}

		return $data;
	}
}