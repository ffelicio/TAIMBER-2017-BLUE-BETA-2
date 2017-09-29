<?php

// constroe o campo de edicao de publicacao
function constroe_campo_edita_publicacao($dados, $idcampo_1){

// globals
global $idioma_sistema;

// array com dados da publicacao
$array_dados = $dados[0];

// separa os dados
$id = $array_dados["id"];
$texto = html_entity_decode($array_dados[TEXTO]);
$modo = $array_dados[MODO];

// valida id de publicacao
if($id == null or $modo != 0){

    // retorno nulo
	return null;
	
};

// valida se o usuario logado e dono da publicacao
if(retorna_usuario_logado_dono_publicacao($id) == false){
	
	// retorno
	return null;
	
};

// id de campos
$idcampo[0] = codifica_md5("id_dialogo_editar_publicacao_".$id);
$idcampo[1] = codifica_md5("id_textarea_editar_publicacao_".$id);

// eventos
$evento[0] = "onclick='exibe_dialogo(\"$idcampo[0]\");'";
$evento[1] = "onclick='atualizar_publicacao(\"$id\", \"$idcampo_1\", \"$idcampo[1]\", \"$idcampo[0]\");'";

// campos
$campo[0] = "
<span class='span_link' $evento[0]>$idioma_sistema[318]</span>
";

// placeholder
$placeholder[0] = retorne_nome_usuario_logado().$idioma_sistema[319];

// campo entrada
$campo_entrada = constroe_campo_div_editavel(true, $idcampo[1], $texto, null, null, $placeholder[0]);

// campos
$campo[1] = "
<div class='classe_campo_edita_atualiza_publicacao_texto'>
$campo_entrada
</div>

<div class='classe_campo_edita_atualiza_publicacao_botao'>
<input type='button' value='$idioma_sistema[12]' $evento[1]>
</div>
";

// adiciona dialogo
$campo[1] = constroe_dialogo($idioma_sistema[318], $campo[1], $idcampo[0]);

// campos
$campo[2] = "
<div class='classe_div_opcao_menu_suspense'>
$campo[0]
</div>
";

// array de retorno
$array_retorno[0] = $campo[1];
$array_retorno[1] = $campo[2];

// retorno
return $array_retorno;

};

?>