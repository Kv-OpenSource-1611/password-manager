<?php

/*****************************
 *
 *	equalto
 *	compare
 *	required
 *	alphanum
 *	email
 *	url
 *	regexp
 *  min
 *
 *
 */


class Validation
{
    var $errors = array();
    function minChar($input, $value, $id = "some input")
    {
        if (strlen($input) >= $value)
            return true;
        else
            $this->errors[] = "$id must be more then $value";
        return false;
    }


    function equalto($input, $values, $id = "some input")
    {
        $vals = explode(",", $values);
        foreach ($vals as $val) {
            if ($input == $val)
                return true;
        }

        $this->errors[] = "Inappropriate value for $id.";
        return false;
    }
    //equal to compare
    function compare($input1, $input2, $id = "Some inputs")
    {
        if ($input1 == $input2)
            return true;
        else
            $this->errors[] = ucfirst(ucwords(str_replace('_', ' ', $id))) . " do not match as required.";

        return false;
    }

    function required($input, $id = "Some input")
    {
        if (isset($input)) {
            if ($input != "") {
                return true;
            } else {
                $this->errors[] = ucfirst(ucwords(str_replace('_', ' ', $id))) . " is Required.";
                return false;
            }
        } else {
            $this->errors[] = ucfirst(ucwords(str_replace('_', ' ', $id))) . " is missing.";
            return false;
        }
    }

    function alpha($input, $id = "Some input")
    {
        if (ctype_alpha($input))
            return true;
        else
            $this->errors[] = ucfirst(ucwords(str_replace('_', ' ', $id))) . " needs to be only alphabests.";

        return false;
    }

    function alphanum($input, $id = "Some input")
    {
        if (ctype_alnum($input))
            return true;
        else
            $this->errors[] = ucfirst(ucwords(str_replace('_', ' ', $id))) . " needs to be alphanumeric values.";

        return false;
    }

    //number digit
    function number($input, $id = "some input")
    {
        if (is_numeric($input))
            return true;
        else
            $this->errors[] = "Required numeric value for $id.";

        return false;
    }

    function email($input, $id = "email")
    {
        if (preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$^", $input))
            return true;
        else
            $this->errors[] = "Inappropriate $id value.";

        return false;
    }

    function url($input, $id = "Some input")
    {
        $url = filter_var($input, FILTER_SANITIZE_URL);
        if (filter_var($url, FILTER_VALIDATE_URL) !== false) {
            return true;
        } else {
            $this->errors[] = "Invalid $id value.";
            return false;
        }
    }

    function errors($delimiter = "<br>")
    {
        // return implode($delimiter, $this->errors);
        return  $this->errors;
    }
}
