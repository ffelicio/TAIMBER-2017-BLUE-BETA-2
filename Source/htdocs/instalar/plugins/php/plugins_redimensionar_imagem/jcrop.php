<?php

// recurso jcrop
function jcrop(){

// globals
global $pasta_host_sistema;

// pasta de recurso
$pasta_recurso = $pasta_host_sistema["pasta_recursos_sistema"]."jcrop/";

// url de scripts
$script[0] = $pasta_recurso."jquery.Jcrop.min.css";
$script[1] = $pasta_recurso."jquery.color.js";
$script[2] = $pasta_recurso."jquery.Jcrop.min.js";

$campo_script = "
<script language='javascript'>

// inicializa o framework
$(function(){

$('#cropbox').Jcrop({aspectRatio: 0.75, onSelect: updateCoords, boxWidth: 310, boxHeight: 310});

});

// atualiza as coordenadas
function updateCoords(c){
	
$('#x').val(c.x);
$('#y').val(c.y);
$('#w').val(c.w);
$('#h').val(c.h);

};

// verifica as coordenadas
function checkCoords(){

// valida coordenada iniciada
if(document.getElementById('w').value.length == 0){

// retorna falso	
return false;

};

};

</script>
";

// html
$html = "
\n
<link rel='stylesheet' href='$script[0]' type='text/css' media='screen'/>
\n
<script type='text/javascript' src='$script[1]'></script>
\n
<script type='text/javascript' src='$script[2]'></script>
\n
$campo_script
\n
";

// retorno
return $html;

};

?>