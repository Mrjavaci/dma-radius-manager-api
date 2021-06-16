<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




class Information
{
    public $email = "";

    public function __construct($email = "")
    {
        $this->email = $email;
    }



    public function getConnectionInfoWithUserName($userName): bool
    {
        $db = $this->connect();
        $sth = $db->prepare("select * from radacct where username = :username order by radacctid desc limit 0,1");
        $sth->execute(array("username" => $userName));
        $fth = $sth->fetch(PDO::FETCH_ASSOC);
        $connect = false;

        if (empty($fth["acctstoptime"])) {
            $connect = true;
        }
        return $connect;
    }

    public function getConnectionInfoAll()
    {
        $db = $this->connect();
        $sth = $db->prepare("select username from rm_users");
        $sth->execute();
        $sonucArray = array();
        while ($row = $sth->fetch()) {
            $username = $row["username"];
            $sth2 = $db->prepare("select acctstoptime from radacct where username = :username order by radacctid desc limit 0,1");
            $sth2->execute(array("username" => $username));
            $fth2 = $sth2->fetch(PDO::FETCH_ASSOC);
            $connect2 = false;
            if (empty($fth2["acctstoptime"])) {
                $connect2 = true;
            }
            $arr = array("username" => $username, "connection" => $connect2);
            array_push($sonucArray, $arr);

        }
        return $sonucArray;
    }

    private function connect()
    {
        $db = new PDO('mysql:host='.HOST.';dbname='.DB_NAME.';port=3306', USER, PASS);

        $db->exec("SET CHARSET UTF8");

        $db->exec("SET NAMES UTF8");

        $db->exec("SET COLLATION_CONNECTION = 'utf8_general_ci'");
        return $db;

    }

    public function getAllInfoOneWithUserName($userName)
    {
        $db = $this->connect();
        $sth = $db->prepare("select * from rm_users where username = :username");
        $sth->execute(array("username" => $userName));
        $fth = $sth->fetch(PDO::FETCH_ASSOC);
        return $fth;
    }
}