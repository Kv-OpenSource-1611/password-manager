<?php

class DBO
{
    private $host    = "localhost";
    private $user    = "root";
    private $pass    = "";
    private $db     = "core_php_test";

    function dml($query)
    {
        $link = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or die(mysqli_connect_error());
        mysqli_query($link, $query) or die(mysqli_error($link));
        // mysqli_close($link);
        return mysqli_insert_id($link);
    }

    function get($query)
    {
        $link = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or die(mysqli_connect_error());
        $res = mysqli_query($link, $query) or die(mysqli_error($link));
        mysqli_close($link);

        $data = array();
        $count_row = 0;
        while ($row = mysqli_fetch_assoc($res)) {
            foreach ($row as $col => $val)
                $data[$count_row][$col] = $val;
            $count_row++;
        }

        return $data;
    }

    function check($query)
    {
        $link = mysqli_connect($this->host, $this->user, $this->pass, $this->db) or die(mysqli_connect_error());
        $res = mysqli_query($link, $query) or die(mysqli_error($link));
        return (mysqli_num_rows($res) == 0) ? false : true;
    }
}
