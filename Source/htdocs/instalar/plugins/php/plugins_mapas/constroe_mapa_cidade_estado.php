<?php

// constroe mapa
function constroe_mapa($cidade, $estado){

// url endereco servidor mapa
$url_endereco_servidor_mapa = "https://www.google.com.br/maps?q=$cidade,+$estado&output=embed";

// codigo html
$html = "
<div class='classe_div_mapa classe_cor_29'>
<iframe src='$url_endereco_servidor_mapa'></iframe>
</div>
";

// retorno
return $html;

};

?>