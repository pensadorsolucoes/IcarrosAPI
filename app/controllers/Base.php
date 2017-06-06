<?php

abstract class Base {


    public function __construct() {

        phpinfo();
      
    }

    protected function _instanceDb() {

        try {
         

            
        } catch (Exception $e) {

            echo '<h1>', 'Ops, temos um problema :(', '</h1>',
            'Tenta novamente mais tarde... Desculpe o transtorno';
            var_dump($e);

            die();
        }
    }

}
