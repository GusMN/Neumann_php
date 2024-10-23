<?php

namespace Classes;

require_once "ContaBancaria.php";

class ContaPoupança extends ContaBancaria{

    public function __construct(public float $saldo){
        parent::__construct($saldo);
    }

}