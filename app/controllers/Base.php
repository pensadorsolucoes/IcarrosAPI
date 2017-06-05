<?php

abstract class Base {

    protected static $db;
    protected static $request;

    public function __construct() {

        // mysqlclient
        if (!self::$db)
            $this->_instanceDb();

        // detalhes da requisicao
        if (!self::$request)
            self::$request = Flight::request();
      
    }

    protected function _instanceDb() {

        try {
         
            $pdo = new PDO("mysql:host=mysql.manager.redeproaprendiz.org.br;dbname=manager", "manager", "asdf324tghnm",
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION
                ]
            );

            self::$db = new FluentPDO($pdo);
            
        } catch (Exception $e) {

            echo '<h1>', 'Ops, temos um problema :(', '</h1>',
            'Tenta novamente mais tarde... Desculpe o transtorno';
            var_dump($e);

            die();
        }
    }

}
