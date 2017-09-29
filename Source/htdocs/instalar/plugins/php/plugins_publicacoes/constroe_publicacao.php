<?php

// constroe a publicacao de usuario
function constroe_publicacao($dados){

// globals
global $idioma_sistema;
global $tabela_banco;

// usuario logado
$usuario_logado = retorne_usuario_logado();

// array de dados
$array_dados = $dados[0];

// separa os dados
$id_compartilhado = $array_dados[ID_COMPARTILHADO];
$id_post = $array_dados["id"];
$uid = $array_dados[UID];

// valida se e um compartilhamento
if($id_compartilhado != null){

	// id de pagina do compartilhamento
	$pagina = retorne_idpagina_postagem($id_compartilhado);
	
	// valida pagina
	if($pagina == null){
		
		// id de usuario dono da publicacao
		$uid = retorne_idusuario_dono_publicacao($id_compartilhado);

	};
	
	// id de usuario
	$idusuario = $array_dados[UID];

	// nome link de usuario
	$nome_link = retorne_nome_link_usuario(true, $uid);

	// id real da publicacao
	$id = $array_dados["id"];

	// dados de publicacao de compartilhamento
	$array_dados = retorne_dados_publicacao($id_compartilhado);

	// pega novamente o id real da publicacao
	$array_dados["id"] = $id;
	
	// imagem de sistema
	$imagem_sistema[0] = retorne_imagem_sistema(33, null, false);
	
	// campos
	$campo[0] = "
	<div class='classe_informa_publicacao_compartilhada'>
	
	<div class='classe_informa_publicacao_compartilhada_imagem'>
	$imagem_sistema[0]
	</div>
	
	<div class='classe_informa_publicacao_compartilhada_nome_link'>
	$nome_link 
	</div>
	
	</div>
	";
	
};

// separa os dados
$id = $array_dados["id"];
$uid = $array_dados[UID];
$pagina = $array_dados[PAGINA];
$chave = $array_dados[CHAVE];
$texto = $array_dados[TEXTO];
$data = $array_dados[DATA];
$id_compartilhado = $array_dados[ID_COMPARTILHADO];

// valida id de publicacao
if($id == null){

    // retorno nulo
	return null;
	
};

// adiciona vizualidado em publicações, comentários etc
adiciona_visualizado($id, $tabela_banco[5]);

// valida usuario logado e pagina
if($usuario_logado == false and $pagina == ''){
	
	// retorno
	return mensagem_erro($idioma_sistema[524]);
	
};

// valida se bloqueia o conteudo
if(retorna_conteudo_bloqueado($texto) == true){
	
	// converte palavras impróprias
	$texto = converte_improprio($texto);

};

// modo mobile
$modo_mobile = retorne_modo_mobile();

// identificador de publicacao
$identificador_publicacao = codifica_md5("identificador_publicacao".$id.$uid);

// id de campos
$idcampo[0] = codifica_md5("id_conteudo_publicacao_".$id.$uid);

// campo de imagens
$campo_imagens = constroe_imagens_publicacao($chave, 1, $uid);

// valida modo pagina
if($pagina == null){
	
	// valida id de usuario dono do compartilhamento
	if($idusuario != null){
		
		// imagem de perfil
		$imagem_perfil = constroe_imagem_perfil_miniatura_publicacao(false, $idusuario);

		// nome link
		$nome_link = retorne_nome_link_usuario(true, $idusuario);
		
	}else{
		
		// imagem de perfil
		$imagem_perfil = constroe_imagem_perfil_miniatura_publicacao(false, $uid);
		
		// nome link
		$nome_link = retorne_nome_link_usuario(true, $uid);
		
	};
	
}else{
	
    // imagem de perfil
    $imagem_perfil = constroe_imagem_perfil_miniatura_pagina($pagina);
	
	// nome link
	$nome_link = retorne_nome_link_pagina($pagina);
	
};

// campo gerencia publicacao
$campo_gerencia_publicacao = campo_gerencia_publicacao($dados, $identificador_publicacao, $idcampo[0]);

// converte todas as urls, links, videos etc
$texto = converter_urls(false, $texto);

// campo social
$campo_social = constroe_campo_social(1, $id_post, true, $uid);

// campo marcacao
$campo_marcacao = constroe_marcacoes_usuarios($id_post, $tabela_banco[5]);

// campo data
$campo_data = constroe_data_conteudo($data);

// campo musicas
$campo_musicas = constroe_musicas_publicacao($chave);

// campo videos
$campo_videos = constroe_videos_publicacao($chave);

// constroe campo de conteudo de url
$campo_conteudo_url = constroe_conteudo_publicacao_conteudo_url($chave, false);

// encurta o texto se necessario
$texto = encurta_texto($texto, NUMERO_CARACTERES_OCULTAR_TEXTO_POST);

// campo data
$campo_data = "

<div class='classe_div_publicacao_data'>
$campo_data
</div>
	
";

// valida o modo mobile
if($modo_mobile == true){
	
	// campo data
	$campo[2] = $campo_data;
	
}else{
	
	// campo data
	$campo[1] = $campo_data;
	
};

// html
$html = "
<div class='classe_div_publicacao borda_div_5' id='$identificador_publicacao'>

$campo[1]

<div class='classe_div_publicacao_topo'>

<div class='classe_div_publicacao_topo_perfil'>
$imagem_perfil
</div>

<div class='classe_div_publicacao_topo_nome'>
$nome_link
</div>

</div>

$campo[2]

<div class='classe_campo_meio_publicacao'>
$campo[0]
<div class='classe_div_publicacao_topo_gerencia'>$campo_gerencia_publicacao</div>

$campo_marcacao
<div class='classe_div_publicacao_texto' id='$idcampo[0]'>
$texto
$campo_conteudo_url
</div>

<div class='classe_div_publicacao_imagem'>$campo_imagens</div>
$campo_musicas
$campo_videos
$campo_social
</div>

</div>
";

// retorno
return $html;

};

?>