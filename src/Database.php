<?php
/**
 * Created by PhpStorm.
 * User: Kimt
 * Date: 02/08/2018
 * Time: 15:12
 */

namespace AgriBot;


use PDO;

class Database
{
    public static $mysql;

    public static function getConnection()
    {
        self::$mysql = new PDO('mysql:dbname=heroku_526741e4a3bcedf;host=us-cdbr-iron-east-04.cleardb.net', 'bc7b958cdd6a45', 'a82c899a');
        self::$mysql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return self::$mysql;
    }
}