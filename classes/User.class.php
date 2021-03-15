<?php include_once("classes/common.inc.php");

class  User extends DBO
{
	var $table_name 	= "users";
	var $table_pk 		= "id";

	var $table_columns = array(

		"id" => array(
			"id"	=> "id",
			"rules" => array("required" => true, "number" => true)
		),

		"full_name" => array(
			"id"	=> "full_name",
			"rules" => array("required" => true)
		),

		"email"	=> array(
			"id"	=> "email",
			"rules" => array("email" => true)
		),

		"password"	=> array(
			"id"	=> "password",
			"rules" => array(
				"required" => true,
				"minChar" => 6
			)
		),

	);

	var $join_tables	= "";
	var $join_condition	= "";

	//-- Do not edit below this line -----------------------------------------//

	var $errors = [];

	function __construct($action = "", $data = "")
	{
		$allowed_calls = array("INSERT", "UPDATE", "DELETE");

		if (in_array(strtoupper($action), $allowed_calls))
			$this->{strtolower($action)}($data);
	}

	function insert($data)
	{
		if (!is_array($data)) {
			$_SESSION['validaion_messages'][] = "Insert expects parameter to be array.";
			header('Location: register.php');
		}

		$this->validate($data);
		if (count($this->errors)) {
			$_SESSION['validaion_messages'] = $this->errors;
			header('Location: register.php');
		} else {

			$cols = " ";
			$vals = " ";
			foreach ($data as $col => $val) {
				if (array_key_exists($col, $this->table_columns) && $col != $this->table_pk) {
					$cols .= $col . ", ";
					$vals .= "'" . $val . "', ";
				}
			}

			$query = "insert into " . $this->table_name . " (" . rtrim($cols, ", ") . ") values(" . rtrim($vals, ", ") . ")";
			return $this->dml($query);
		}
	}

	function select($columns = "*", $condition = "1=1")
	{
		$query = "select " . $columns . " from " . $this->table_name . "  where " . $condition;
		return $this->get($query);
	}

	function update($data)
	{
		if (!is_array($data)) {
			$_SESSION['validaion_messages'][] = "Update expects parameter to be array.";
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		if (!array_key_exists($this->table_pk, $data)) {
			$_SESSION['validaion_messages'][] = "Update expects primary key column value to be provided. No primary value recieved.";
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}

		$this->validate($data);
		if (count($this->errors)) {
			$_SESSION['validaion_messages'] = $this->errors;
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		} else {

			$query = "update " . $this->table_name . " set ";
			foreach ($data as $col => $val) {
				if (array_key_exists($col, $this->table_columns) && $col != $this->table_pk)
					$query .= $col . " = '" . $val . "', ";
			}
			$query = rtrim($query, ", ");
			$query .= " where " . $this->table_pk . " = " . $data[$this->table_pk];

			$this->dml($query);
		}
	}

	function delete($ids)
	{
		$query = "delete from " . $this->table_name . " where " . $this->table_pk . " in(" . $ids . ")";
		$this->dml($query);
	}

	function validate($data)
	{
		$validation = new validation();
		$has_errors = false;
		$cols 		= " ";
		$vals		= " ";

		foreach ($data as $col => $val) {
			//If column recieved in post/get belogns to this table
			if (array_key_exists($col, $this->table_columns) && $col != $this->table_pk) {
				//Loop through rules for this column
				foreach ($this->table_columns[$col]["rules"] as $validation_type => $validation_arg) {
					//If this rule has additional arguments
					if ($validation_arg !== true) {

						if (!$validation->$validation_type($val, $validation_arg, $this->table_columns[$col]["id"])) $has_errors = true;
					}
					//If this rule does not require any arguments
					else {

						if (!$validation->$validation_type($val, $this->table_columns[$col]["id"])) $has_errors = true;
					}
				}
			}
		}

		$this->errors = ($has_errors) ? $validation->errors() : [];
		return !$has_errors;
	}
	function logout()
	{
		$_SESSION[$this->session_var_name] = array();
	}
}
