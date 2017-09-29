<?php

// publica o conteudo de usuario
function publicar_conteudo_usuario($array_publicacao, $modo){

// modo 0 publicacao normal
// modo 1 alterou imagem de perfil
// modo 2 alterou imagem de capa
// modo 3 alterou informacoes de perfil
// modo 4 compartilhamento

// globals
global $idioma_sistema;
global $tabela_banco;

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// retorno nulo
    return null;

};

// id de publicacao compartilhada
$id_compartilhado = $array_publicacao[ID_COMPARTILHADO];
	
// id de usuario
$idusuario = retorne_idusuario_logado();

// id de pagina
$pagina = retorne_idpagina_request();

// valida se o usuario e dono da pagina
if($pagina != null and retorne_usuario_dono_pagina($idusuario, $pagina) == false){
	
	// valida se esta compartilhando
	if($modo == 4){
		
		// evita que um usuario tentando compartilhar publique na pagina
		$pagina = null;
		
	}else{
		
		// retorno nulo
		return null;
	
	};
	
};

// upload de imagens se existirem
upload_imagem_album(9);

// valida dados
if(is_array($array_publicacao) == true){
	
	// texto de publicacao
	$texto = trata_html_requeste($array_publicacao[TEXTO]);
	
	// chave de publicacao atual
	$chave = retorna_seta_chave_publicacao(true);	
	
}else{
	
	// texto de publicacao
	$texto = trata_html_requeste($_REQUEST["campo_texto"]);
	
	// chave de publicacao atual
	$chave = retorna_chave_request();	

};

// valida se permite publicar, ou se está publicando somente fotos
if($array_publicacao == -1){
	
	// limpa texto de postagem
	$texto = null;
	
	// limpa a chave
	$chave = null;
	
};

// valida publicacao
if(($texto == null and $id_compartilhado == null and retorne_id_conteudo_url($chave) == null and retorne_numero_imagens_album_chave($chave) == 0) or $chave == null){
	
	// numero de publicacoes
	$numero_publicacoes = retorne_numero_publicacoes(null);

	// singular ou plural
	if($numero_publicacoes > 1){
		
		// plural
		$numero_publicacoes = retorne_tamanho_resultado($numero_publicacoes);
		
		// campo publicacoes
		$numero_publicacoes = "
		<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
		<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[519]</div>
		";
		
	}else{

		// campo publicacoes
		$numero_publicacoes = "
		<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
		<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[518]</div>
		";
		
	};

	// constroe publicacao
	$array_retorno["linhas"] = $numero_publicacoes;

	// retorno
	return json_encode($array_retorno);
	
};

// data
$data = data_atual();

// query
$query[0] = "insert into $tabela_banco[5] values(null, '$idusuario', '$pagina', '$chave', '$texto', '$id_compartilhado', '$modo', '$data');";

// valida pagina
if($pagina == null){
	
	// query de publicacoes de usuario
	$query[1] = "select *from $tabela_banco[5] where uid='$idusuario' and pagina='' order by id desc;";

}else{
	
	// query de pagina de usuario
	$query[1] = "select *from $tabela_banco[5] where uid='$idusuario' and pagina='$pagina' order by id desc;";
	
};

// executa a query
plugin_executa_query($query[0]);

// array da publicacao
$array_publicacao = plugin_executa_query($query[1]);

// separa os dados de publicacao
$idpost = $array_publicacao["dados"][0]["id"];

// numero de publicacoes
$numero_publicacoes = $array_publicacao["linhas"];

// singular ou plural
if($numero_publicacoes > 1){
	
	// plural
	$numero_publicacoes = retorne_tamanho_resultado($numero_publicacoes);
	
	// campo publicacoes
	$numero_publicacoes = "
	<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
	<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[519]</div>
	";
	
}else{

	// campo publicacoes
	$numero_publicacoes = "
	<div class='classe_div_numero_publicacoes_topo'>$numero_publicacoes</div>
	<div class='classe_div_numero_publicacoes_texto'>$idioma_sistema[518]</div>
	";
	
};

// valida o modo
if($modo != 0 and $modo != 4){
	
	// exclui a publicacao pelo modo
	excluir_publicacao_modo($idpost, $modo);

};

// erradica os feeds do usuario
erradicar_feeds_usuario(true, $array_publicacao["dados"][0]["id"], $idusuario);
erradicar_feeds_pagina_usuario(true, $array_publicacao["dados"][0]["id"], $idusuario, $pagina);

// erradica as marcacoes de usuarios
erradicar_marcacoes_usuarios($idpost);

// atualiza o publicado de conteudo de url
atualiza_publicado_conteudo_url($chave);

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

// constroe publicacao
$array_retorno["dados"] = constroe_publicacao($array_publicacao["dados"]);
$array_retorno["linhas"] = $numero_publicacoes;
$array_retorno[CHAVE] = retorna_seta_chave_publicacao(true);

// retorno
return json_encode($array_retorno);

};

?>