<?php

// constroe o comentario
function constroe_comentario($dados){

// globals
global $idioma_sistema;
global $tabela_banco;

// separa os dados
$id = $dados["id"];
$uid = $dados[UID];
$id_post = $dados[ID_POST];
$comentario = $dados[COMENTARIO];
$tabela_comentario = $dados[TABELA_COMENTARIO];
$data = $dados[DATA];

// valida id de comentario
if($id == null){
	
	// retorno nulo
	return null;
	
};

// valida tabela de comentario
switch($tabela_comentario){
	
	case $tabela_banco[4]:
	// classes
	$classe[0] = "classe_comentario_usuario_separa_4";
	break;
	
	default:
	// classes
	$classe[0] = "classe_comentario_usuario_separa_2";

};

// valida se bloqueia o conteudo
if(retorna_conteudo_bloqueado($comentario) == true){
	
	// converte palavras impróprias
	$comentario = converte_improprio($comentario);
	
};

// constroe a imagem do perfil do usuario que comentou
$imagem_perfil = constroe_imagem_perfil_comentario($uid);

// converte data para amigavel
$data = converte_data_amigavel(true, $data);

// id de campo de texto de comentario
$id_campo_texto_comentario = codifica_md5("id_campo_texto_comentario_".$id);

// id de comentario de usuario
$id_comentario_usuario = codifica_md5("id_comentario_usuario_".$id);

// campo gerencia comentario
$campo_gerenciar_comentario = constroe_campo_gerencia_comentario($dados, $id_campo_texto_comentario, $id_comentario_usuario);

// converte urls em links/videos etc
$comentario = converter_urls(false, $comentario);

// converte o conteudo em hashtags
$comentario = converte_conteudo_hashtag($comentario);

// nome
$nome = retorne_nome_link_usuario(true, $uid);

// adiciona nome em comentário
$comentario = $nome.$comentario;

// campo marcacao
$campo_marcacao = constroe_marcacoes_usuarios($id, $tabela_banco[7]);

// valida tabela de comentario
if(retorne_tabela_comentario($tabela_comentario) != 3){

	// campos
	$campo[0] = constroe_campo_comentario($tabela_comentario, 3, $id, true, $uid);

	// adiciona div de resposta de comentario
	$campo[0] = "
	<div class='classe_comentario_usuario_responder'>$campo[0]</div>
	";

	// classes
	$classe[1] = "classe_comentario_usuario_separa_1";

}else{
	
	// classes
	$classe[0] = "classe_comentario_usuario_separa_3";
	$classe[1] = "classe_comentario_usuario_separa_5";
	
};

// valida marcacoes
if($campo_marcacao == null){
	
	// campo com texto
	$campo[1] = "
	<div class='classe_comentario_usuario_conteudo_padrao' id='$id_campo_texto_comentario'>
	$comentario
	</div>
	";
	
}else{
	
	// campo com texto
	$campo[1] = "
	<div class='classe_comentario_usuario_conteudo' id='$id_campo_texto_comentario'>
	$campo_marcacao
	
	<div class='classe_comentario_usuario_conteudo_sub'>
	$comentario
	</div>
	
	</div>
	";
	
};

// valida tabela de comentario
switch($tabela_comentario){
	
	case $tabela_banco[4]:
	
	// classes
	$classe[1] = "classe_comentario_usuario_separa_5";
	
	break;

	case $tabela_banco[7]:
	
	// classes
	$classe[1] = "classe_comentario_usuario_separa_6";
	$classe[0] = "classe_comentario_usuario_separa_7";
	
	// valida se a resposta é de um comentário de album
	if(retorne_tabela_comentario_comentario_principal($dados) == $tabela_banco[4]){
		
		// classes
		$classe[0] = "classe_comentario_usuario_separa_8";
		
	};
	
	break;
	
};

// constroe as opcoes de comentario
$campo[2] = constroe_opcoes_comentario($dados);

// html
$html = "
<div class='classe_comentario_usuario classe_cor_29' id='$id_comentario_usuario'>

$campo[2]

<div class='$classe[1]'>
$imagem_perfil
</div>

<div class='$classe[0]'>
$campo[1]

<div class='classe_comentario_usuario_data classe_cor_7'>
$data
</div>

$campo_gerenciar_comentario
$campo[0]

</div>

</div>
";

// retorno
return $html;

};

?>