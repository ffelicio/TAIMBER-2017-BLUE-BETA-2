<?php

// constroe campo gerencia comentario
function constroe_campo_gerencia_comentario($dados, $id_campo_texto_comentario, $id_comentario_usuario){

// globals
global $idioma_sistema;

// separa os dados
$id = $dados["id"];
$uid = $dados[UID];
$id_post = $dados[ID_POST];
$comentario = $dados[COMENTARIO];
$tabela_comentario = $dados[TABELA_COMENTARIO];
$data = $dados[DATA];

// valida se comentario possui id
if($id == null){
	
	// retorno nulo
	return null;
	
};

// retorna o numero da tabela de comentario
$tabela_comentario = retorne_tabela_comentario($tabela_comentario);

// dados de publicacao
$dados_publicacao = retorne_dados_publicacao($id_post);

// id de usuario logado
$idusuario_logado = retorne_idusuario_logado();

// valida se o usuario e dono da postagem, ou se é dono do comentario
if($dados_publicacao[UID] != $idusuario_logado and $uid != $idusuario_logado){
	
	// retorno nulo
    return null;
	
};

// nome do usuario logado
$nome_usuario_logado = retorne_nome_usuario_logado();

// id de campo de entrada para atualizar o comentario
$id_campo_entrada[0] = codifica_md5("campo_entrada_atualiza_comentario_".$id.$idusuario_logado);

// id de dialogo de editar comentario
$id_dialogo_editar = codifica_md5("id_dialogo_editar".$id.$idusuario_logado);

// campos
$campo[0] = constroe_campo_div_editavel(true, $id_campo_entrada[0], html_entity_decode($comentario), null, null, $idioma_sistema[91]);

// campo editar
$campo_editar = "
<div class='classe_div_campo_edita_comentario_texto'>
$campo[0]
</div>

<div class='classe_div_campo_edita_comentario_salva'>
<input type='button' value='$idioma_sistema[12]' onclick='salvar_comentario_editado(\"$id_campo_entrada[0]\", \"$id\", \"$id_campo_texto_comentario\", \"$id_dialogo_editar\");'>
</div>
";

// adiciona dialogo
$campo_editar = constroe_dialogo($idioma_sistema[90], $campo_editar, $id_dialogo_editar);

// campo editar
$campo_editar = "
<div class='classe_div_opcoes_comentario_separa' onclick='exibe_dialogo(\"$id_dialogo_editar\");'>
<span class='span_link'>$idioma_sistema[87]</span>
</div>

$campo_editar
";

// id de dialogo excluir comentario
$id_dialogo_excluir = codifica_md5("id_dialogo_excluir_".$id.$idusuario_logado);

// define mensagem de dialogo excluir comentario
if(retorne_usuario_dono_comentario($uid) == true){

    // mensagem de dialogo de excluir comentario
    $mensagem_dialogo_excluir = "$nome_usuario_logado$idioma_sistema[92]";
	
}else{

    // mensagem de dialogo de excluir comentario
    $mensagem_dialogo_excluir = "$nome_usuario_logado$idioma_sistema[88]";
	
	// limpa campo de editar comentario
	$campo_editar = null;
	
};

// campo excluir
$campo_excluir = "

<div class='classe_texto_caixa_dialogo'>
$mensagem_dialogo_excluir
</div>

<div class='classe_botao_caixa_dialogo'>
<input type='button' value='$idioma_sistema[29]' onclick='excluir_comentario(\"$id\", \"$uid\", \"$id_comentario_usuario\", \"$id_dialogo_excluir\", \"$tabela_comentario\", \"$id_post\");'>
</div>

";

// adiciona dialogo em excluir comentario
$campo_excluir = constroe_dialogo($idioma_sistema[89], $campo_excluir, $id_dialogo_excluir);

// campo excluir
$campo_excluir = "
<div class='classe_div_opcoes_comentario_separa' onclick='exibe_dialogo(\"$id_dialogo_excluir\");'>
<span class='span_link'>$idioma_sistema[29]</span>
</div>

$campo_excluir
";

// html
$html = "
$campo_editar
$campo_excluir
";

// adiciona div
$html = "
<div class='classe_div_opcoes_comentario'>
$html
</div>
";

// retorno
return $html;

};

?>