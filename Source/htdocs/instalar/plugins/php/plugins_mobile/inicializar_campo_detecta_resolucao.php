<?php

// inicializa o campo de deteccao de resolucao
function inicializar_campo_detecta_resolucao(){

// funcoes
$funcao[0] = "detecta_resolucao();";

// html
$html = "
<script language='javascript'>$funcao[0]</script>
";

// h tml
$html .= plugin_timer_sistema(6, $funcao[0]);

// retorno
return $html;

};

?>