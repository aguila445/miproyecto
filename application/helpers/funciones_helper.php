<?php
function formatearFecha ($fecha)
{
    /*2023-06-10 00:21:27*/
    $dia=substr($fecha,8,2);
    $mes=substr($fecha,5,2);
    $anio=substr($fecha,0,4);
    $hora=substr($fecha,11,5);
    
    $fechaformateada=$dia."-".$mes."-".$anio." ".$hora;
    return $fechaformateada;
}
?>