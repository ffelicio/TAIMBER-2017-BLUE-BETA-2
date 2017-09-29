<?php

// constroe campo visualizador de amigos online
function constroe_campo_visualizador_amigos_online(){

// globals
global $idioma_sistema;

// numero de amigos online
$numero_online = retorne_tamanho_resultado(retorna_numero_amigos_online(retorne_idusuario_request()));

// id de campos
$idcampo[0] = codifica_md5("id_campo_exibe_numero_amigos_online_".retorne_contador_iteracao());
$idcampo[1] = codifica_md5("id_campo_dialogo_amigos_online_".retorne_contador_iteracao());
$idcampo[2] = codifica_md5("id_campo_lista_amigos_online_".retorne_contador_iteracao());
$idcampo[3] = retorne_idcampo_md5();

// funcoes
$funcao[0] = "exibir_amigos_online(\"$idcampo[2]\", \"$idcampo[3]\", 1)";
$funcao[1] = "exibir_amigos_online(\"$idcampo[2]\", \"$idcampo[3]\", 0)";

// eventos
$evento[0] = "onclick='$funcao[1];'";
$evento[1] = "onclick='exibe_dialogo(\"$idcampo[1]\"), $funcao[0]'";

// campos
$campo[0] = "
<div class='classe_div_visualizador_amigos_perfil_online classe_cor_7' id='$idcampo[0]' $evento[1]>
$idioma_sistema[386]$numero_online
</div>
";

// funcoes do timer
$funcoes = "atualizar_numero_amigos_online(\"$idcampo[0]\")";

// campos
$campo[1] = plugin_timer_sistema(2, $funcoes);

// nome de usuario
$nome_usuario = retorne_nome_usuario(true, retorne_idusuario_request());

// titulo de dialogo
$titulo_dialogo = $idioma_sistema[387].$nome_usuario;

// progresso
$progresso[0] = campo_progresso_gif($idcampo[3]);

// campos
$campo[2] = "
<div class='classe_div_visualizador_amigos_perfil_amigos' id='$idcampo[2]'></div>

$progresso[0]

<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[0]>
$idioma_sistema[61]
</div>
";

// campos
$campo[2] = constroe_dialogo($titulo_dialogo, $campo[2], $idcampo[1]);

// html
$html = "
$campo[0]
$campo[1]
$campo[2]
";

// retorno
return $html;

};

?>