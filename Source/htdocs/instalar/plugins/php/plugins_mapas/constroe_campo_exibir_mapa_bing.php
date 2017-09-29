<?php

// constroe o campo para exibir o mapa do bing
function constroe_campo_exibir_mapa_bing($modo){

// scripts
$script[0] = "
<script>
obtem_geolocalizacao();
</script>
";

// html
$html = "
$script[0]
";

// array com a geolocalizacao
$array_geolocalizacao = retorna_geolocalizacao();

// coordenadas
$latitude = $array_geolocalizacao["latitude"];
$longitude = $array_geolocalizacao["longitude"];

// mapa bing
$mapa_bing[0] = constroe_mapa_bing($latitude, $longitude, $modo);

// html
$html .= "
$mapa_bing[0]
";

// retorno
return $html;

};

?>