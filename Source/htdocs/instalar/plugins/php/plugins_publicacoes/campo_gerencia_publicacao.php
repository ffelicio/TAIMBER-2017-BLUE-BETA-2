<?php

// campo para gerenciar publicacao
function campo_gerencia_publicacao($dados, $identificador_publicacao, $idcampo_1){

// globals
global $idioma_sistema;
global $tabela_banco;

// array de dados
$array_dados = $dados[0];

// separa os dados
$id = $array_dados["id"];
$uid = $array_dados[UID];
$chave = $array_dados[CHAVE];
$texto = $array_dados[TEXTO];
$id_compartilhado = $array_dados[ID_COMPARTILHADO];
$modo = $array_dados[MODO];
$data = $array_dados[DATA];

// valida id de publicacao
if($id == null){

    // retorno nulo
	return null;
	
};

// usa os dados compilados de sessao
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// separa os dados do perfil
$dados_perfil[1] = $dados_compilados_usuario[$tabela_banco[1]];

// nome do usuario
$nome_usuario = $dados_perfil[1][NOME];

// id de dialogo
$dialogo_id[0] = codifica_md5("id_dialogo_excluir_publicacao_$id");
$dialogo_id[1] = codifica_md5("id_dialogo_excluir_feed_$id");

// dialogo excluir publicacao
$dialogo_excluir_publicacao = "

<div class='classe_texto_caixa_dialogo'>
$nome_usuario$idioma_sistema[35]
</div>

<div class='classe_botao_caixa_dialogo'>
<input type='button' value='$idioma_sistema[32]' onclick='excluir_publicacao_usuario(\"$id\", \"$identificador_publicacao\");'>
</div>

";

// valida id compartilhado
if($id_compartilhado == null){
	
	// link da publicacao
	$link[0] = retorna_link_publicacao_id($id);

}else{
	
	// link da publicacao
	$link[0] = retorna_link_publicacao_id($id_compartilhado);
	
};

// adiciona o dialogo
$dialogo_excluir_publicacao = constroe_dialogo($idioma_sistema[34], $dialogo_excluir_publicacao, $dialogo_id[0]);

// valida usuario dono da publicacao
if($uid == retorne_idusuario_logado()){
	
	// campos
	$campo[0] = "
	
	<div class='classe_div_opcao_menu_suspense'>
	<span class='span_opcao_gerencia_publicacao span_link' onclick='exibe_dialogo(\"$dialogo_id[0]\");'>$idioma_sistema[29]</span>
	</div>
	
	";

};

// campos
$campo[1] = "

<div class='classe_div_opcao_menu_suspense'>
$link[0]
</div>

";

// campos
$campo[2] = constroe_campo_edita_publicacao($dados, $idcampo_1);

// campo editar
$campo_editar[0] = $campo[2][0];
$campo_editar[1] = $campo[2][1];

// valida publicacao e feed
if(retorna_publicacao_pertence_feed($id) == true){
	
	// campos
	$campo[3] = "
	
	<div class='classe_texto_caixa_dialogo'>
	$nome_usuario$idioma_sistema[530]
	</div>
	
	<div class='classe_botao_caixa_dialogo'>
	<input type='button' value='$idioma_sistema[32]' onclick='excluir_feed_usuario(\"$id\", \"$identificador_publicacao\");'>
	</div>

	";
	
	// dialogo excluir feed
	$dialogo_excluir_feed = constroe_dialogo($idioma_sistema[323], $campo[3], $dialogo_id[1]);
	
	// funcoes
	$funcao[0] = "exibe_dialogo(\"$dialogo_id[1]\");";
	
	// eventos
	$eventos[0] = "onclick='$funcao[0];'";
	
	// campos
	$campo[3] = "
	<div class='classe_div_opcao_menu_suspense'>
	<span class='span_link' $eventos[0]>$idioma_sistema[323]</span>
	</div>
	";
	
};

// campo de menu
$campo_menu = "
$campo_editar[1]
$campo[0]
$campo[1]
$campo[3]
";

// adiciona o menu de suspense
$campo_menu = constroe_menu_suspense(false, null, false, null, "id_menu_gerencia_publicacao_$id", $campo_menu);

// html
$html = "
<div class='classe_div_campo_gerencia_publicacao'>

<div class='classe_div_campo_gerencia_publicacao_menu_suspense'>
$campo_menu
</div>

</div>

$dialogo_excluir_publicacao
$dialogo_excluir_feed
$campo_editar[0]

";

// retorno
return $html;

};

?>