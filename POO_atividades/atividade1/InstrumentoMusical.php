<?php 


abstract class InstrumentoMusical{

    public function __construct(private string $nome){

    }

    abstract public function tocarInstrumento():string;
}
?>