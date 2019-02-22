<?php
/**
 * Created by PhpStorm.
 * User: Москалевы
 * Date: 22.02.2019
 * Time: 0:00
 */

class DB extends PDO
{
    private $db;

    public function __construct($dsn, $username, $passwd)
    {
        $this->db = new PDO($dsn, $username, $passwd);
    }

    public function getArr($table, $first, $count)
    {
        $arr = [];
        $last=$first+$count;
        $sql="SELECT * FROM `{$table}` LIMIT {$first},{$last}";
        $result = $this->db->query($sql);
        while ($row = $result->fetchObject()) {
            // в результате получаем ассоциативный массив
            $arr[] = $row;
        }
        return $arr;
    }

}