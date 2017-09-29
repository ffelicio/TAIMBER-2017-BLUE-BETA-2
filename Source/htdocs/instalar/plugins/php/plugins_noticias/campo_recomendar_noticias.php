<?php

// campo recomendar noticias
function campo_recomendar_noticias(){

// globals
global $idioma_sistema;

// id de usuario
$uid = retorne_idusuario_logado();

// configuracao
$configuracao[0] = retorna_configuracao_privacidade(11, $uid);

// estado de noticia de usuario
$estado_noticia = retorne_estado_noticia_usuario();

// valida configuracao e estado
if($configuracao[0] == true or $estado_noticia == null){
	
	// retorno nulo
	return null;
	
};

// id de campos
$idcampo[0] = retorne_idcampo_md5();
$idcampo[1] = retorne_idcampo_md5();

// barra de progresso
$progresso[0] = campo_progresso_gif($idcampo[0]);

// funcoes
$funcoes[0] = "carregar_noticias(\"$idcampo[0]\", \"$idcampo[1]\", null);";
$funcoes[1] = "carregar_noticias(\"$idcampo[0]\", \"$idcampo[1]\", 1);";
$funcoes[2] = "carregar_noticias(\"$idcampo[0]\", \"$idcampo[1]\", 2);";

// imagens de sistema
$imagem[0] = retorne_imagem_sistema(83, null, false);
$imagem[1] = retorne_imagem_sistema(84, null, false);

// eventos
$evento[0] = "onclick='$funcoes[1]'";
$evento[1] = "onclick='$funcoes[2]'";

// campos paginar
$campo_paginar = "
<div class='classe_campo_paginar_noticia_1'>
<span $evento[0]>$imagem[0]</span>
</div>

<div class='classe_campo_paginar_noticia_2'>
<span $evento[1]>$imagem[1]</span>
</div>
";

// campos
$campo[0] = "
<div class='classe_noticias_recomendadas_topo'>
$campo_paginar
</div>
";

// campos
$campo[1] = "
<div class='classe_noticias_recomendadas_conteudo' id='$idcampo[1]'>

</div>
";

// campos
$campo[2] = plugin_timer_sistema(8, $funcoes[0]);

// campos
$campo[3] = "

<script>
$funcoes[0]
</script>

";

// html
$html = "
<div class='classe_noticias_recomendadas'>
$campo[0]
$progresso[0]
$campo[1]
</div>

$campo[2]
$campo[3]
";

// retorno
return $html;

};

?>