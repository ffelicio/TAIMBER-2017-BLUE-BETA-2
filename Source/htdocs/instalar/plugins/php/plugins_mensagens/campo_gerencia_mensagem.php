<?php

// campo gerencia mensagem
function campo_gerencia_mensagem($dados, $idcampo_1, $modo){

// globals
global $idioma_sistema;

// separa os dados
$id = $dados["id"];
$uid = $dados[UID];
$uidamigo = $dados[UIDAMIGO];
$mensagem = $dados[MENSAGEM];
$uidenviou = $dados[UIDENVIOU];
$visualizado = $dados[VISUALIZADO];
$respondido = $dados[RESPONDIDO];
$data = $dados[DATA];

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// id de dialogo
$id_dialogo[0] = codifica_md5("id_dialogo_excluir_mensagem_$id");

// id de menu
$id_menu[0] = codifica_md5("id_menu_suspense_gerencia_mensagem_$id");

// eventos
$eventos[0] = "onclick='exibe_dialogo(\"$id_dialogo[0]\");'";
$eventos[1] = "onclick='excluir_mensagem_usuario(\"$id\", \"$idcampo_1\", \"$uidamigo\", \"$modo\");'";

// campo excluir
$campo_excluir = "
<div class='classe_separa_opcao_gerencia_mensagem'>
$nome_usuario$idioma_sistema[223]
</div>

<div class='classe_separa_opcao_gerencia_mensagem_botao'>
<input type='button' value='$idioma_sistema[32]' $eventos[1]>
</div>
";

// adiciona dialogo
$dialogo[0] = constroe_dialogo($idioma_sistema[222], $campo_excluir, $id_dialogo[0]);

// campo excluir
$campo_excluir = "
<span class='classe_opcao_gerencia_mensagem span_link' $eventos[0]>$idioma_sistema[222]</span>
";

// html
$html = "
$campo_excluir
";

// adiciona menu
$html = constroe_menu_suspense(false, null, false, null, $id_menu[0], $html);

// html
$html = "
<div class='classe_opcoes_mensagem'>$html</div>

$dialogo[0]
";

// retorno
return $html;

};

?>