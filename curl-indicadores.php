<?php

require_once ("conexion/curl-token.php");
require_once ("conexion/conex.php");

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://postulaciones.solutoria.cl/api/indicadores',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$obToken.''
  ),
));

$response = curl_exec($curl);

curl_close($curl);

//echo $response;

 $informacion= json_decode($response);


 //Decodifimos toda la info con el json decode para poder hacer el for each
 //La variable informacion tiene todos los datos 

 foreach ($informacion as $datos) {

$id = $datos->id;

// A la variable $id le estamos diciendo que es igual al valor del id que se encuentra en la variable $dato
//Este valor ira cambiando mediante vaya haciendo el recorrido y los mismo pasa con las siguientes variables
$nombreIndicador = $datos->nombreIndicador;
$codigoIndicador = $datos->codigoIndicador;
$unidadMedidaIndicador= $datos->unidadMedidaIndicador;
$valorIndicador = $datos->valorIndicador;
$fechaIndicador = $datos->fechaIndicador;
$tiempoIndicador = $datos->tiempoIndicador;
$origenIndicador = $datos->origenIndicador ;

if ($codigoIndicador == "UF"){
  //El if funciona como filtro para subir las Uf con sus respecitvos valores, tambien en caso de querer hacer un echo
  // Solo muestre los UF

   // echo $id . "\n" . $nombreIndicador. "\n" . $codigoIndicador. "\n".$unidadMedidaIndicador . "\n". $valorIndicador . "\n". $fechaIndicador . "\n". $origenIndicador ."<br>";


    $datosduplicados = mysqli_query($mysqli, "SELECT * FROM clients WHERE id='$id' AND valIndicador= '$valorIndicador'");
  
    if (mysqli_num_rows($datosduplicados) > 0) {
  
      /* Si el Valor Indicador se repite entonces no se hara nada en este If, podriamos realizar un update pero si el Valor se repite significa
      que tampoco se actualizado el fechaIndicador asi que el update es innecesario personalmente.
       */

  } else{

    // Si el valorIndicado no se repite pues se registrara sin problema a la BD
    $sql = "INSERT INTO clients(id,nomIndicador,codIndicador,uniIndicador,valIndicador,orIndicador,created_at,updated_at) VALUES ('$id', '$nombreIndicador', '$codigoIndicador','$unidadMedidaIndicador', '$valorIndicador', '$origenIndicador','$fechaIndicador','$fechaIndicador')";
    $ejecutar = mysqli_query($mysqli, $sql);

  }
        
}


}
