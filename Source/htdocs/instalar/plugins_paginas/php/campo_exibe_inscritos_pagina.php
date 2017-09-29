<?php

// campo para exibir os inscritos da pagina
function campo_exibe_inscritos_pagina(){

// globals
global $idioma_sistema;

// id de campo
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();

// pagina
$pagina = retorne_idpagina_request();

// funcoes
$funcao[0] = "exibir_inscritos_pagina(\"$pagina\", \"$idcampo[0]\", \"$idcampo[1]\", \"1\");";

// campo paginador
$campo[0] = constroe_paginador_padrao($idcampo[1], $funcao[0]);

// scripts
$script[0] = "
<script>
$funcao[0]
</script>
";

// html
$html = "
<div class='classe_titulo_exibe_inscritos_pagina_usuario classe_cor_21 classe_cor_8 classe_cor_4'>
$idioma_sistema[262]
</div>

<div class='classe_exibe_inscritos_pagina_usuario' id='$idcampo[0]'>
</div>

$campo[0]
$script[0]
";

// retorno
return $html;

};

?>