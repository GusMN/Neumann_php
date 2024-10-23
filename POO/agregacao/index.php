<?php
require_once "Time.php";

$estadio = new Estadio(60540);
$gremio = new Time("Super Grêmio",$estadio);
echo $gremio->getEstadio()->getCapacidade();