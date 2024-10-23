<?php 

include_once "InstrumentoMusical.php";

class Violao extends InstrumentoMusical{


    public function tocarInstrumento():string
    {
        return "bã dom dom, bã dom dom...";
    }

}

?>