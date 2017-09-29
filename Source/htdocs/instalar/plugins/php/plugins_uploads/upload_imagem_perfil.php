<?php

// upload de imagem de perfil
function upload_imagem_perfil(){

// globals
global $tabela_banco;
global $idioma_sistema;
global $codigos_especiais;

// valida se esta postando imagem de perfil
if($_FILES['foto']['tmp_name'] == null){

    // retorno nulo
    return null;
	
};

// array com fotos
$fotos = $_FILES["foto"];

// nome real da imagem de upload
$nome_real_imagem = $fotos["name"];

// extencao da imagem de upload
$extensao_imagem = converte_minusculo(pathinfo($nome_real_imagem, PATHINFO_EXTENSION));

// valida se é uma imagem válida
if(retorna_extensao_imagem_valida($extensao_imagem) == false){
	
	// retorno falso
	return false;
	
};

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// valida o tipo de upload
switch(retorne_campo_formulario_request(2)){

    case 53:
	$tabela = $tabela_banco[20];
	$numero_pasta = 7;
    $id = retorne_idpagina_request();
	$modo_pagina = true;
	
	// valida o usuario dono da pagina
	if(retorne_usuario_dono_pagina($idusuario, $id) == false){
		
		// retorno nulo
		return null;
		
	};
    break;

	default:
    $tabela = $tabela_banco[2];
	$numero_pasta = 1;
	$modo_pagina = false;
	
};

// pasta de upload root
$pasta_upload_root = retorne_pasta_usuario($idusuario, $numero_pasta, true);

// exclui e recria pastas
excluir_pastas_subpastas($pasta_upload_root, true);

// pasta de upload host
$pasta_upload_host = retorne_pasta_usuario($idusuario, $numero_pasta, false);

// array de enderecos
$array_enderecos = upload_imagem(null, $pasta_upload_root, TAMANHO_IMAGEM_PERFIL_NORMAL, TAMANHO_IMAGEM_PERFIL_MINIATURA, true, true, $pasta_upload_host, TAMANHO_IMAGEM_ALBUM_MINIATURA, TAMANHO_IMAGEM_PERFIL_MOBILE, TAMANHO_IMAGEM_PERFIL_MEDIO);

// separa enderecos hosts
$host_normal = $array_enderecos['host_normal'];
$host_miniatura = $array_enderecos['host_miniatura'];
$url_host_normal = $array_enderecos['url_host_normal'];
$url_normal = $array_enderecos['url_normal'];
$url_host_thumbnail = $array_enderecos['url_host_thumbnail'];
$url_host_mobile = $array_enderecos['url_host_mobile'];
$url_host_medio = $array_enderecos['url_host_medio'];

// separa enderecos roots
$url_root_normal = $array_enderecos['url_root_normal'];
$root_miniatura = $array_enderecos['root_miniatura'];
$root_normal = $array_enderecos['root_normal'];
$url_root_thumbnail = $array_enderecos['url_root_thumbnail'];
$url_root_mobile = $array_enderecos['url_root_mobile'];
$url_root_medio = $array_enderecos['url_root_medio'];

// valida o modo pagina
if($modo_pagina == true){

    // querys
    $query[0] = "delete from $tabela where id='$id';";
    $query[1] = "insert into $tabela values('$id', '$host_normal', '$host_miniatura', '$root_normal', '$root_miniatura', '$url_host_normal', '$url_root_normal', '$url_host_mobile');";

}else{
	
    // querys
    $query[0] = "delete from $tabela where uid='$idusuario';";
    $query[1] = "insert into $tabela values('$idusuario', '$host_normal', '$host_miniatura', '$root_normal', '$root_miniatura', '$url_host_normal', '$url_root_normal', '$url_host_mobile', '$url_host_medio', '$url_root_medio', '$url_root_mobile');";

};

// executa as querys
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);

// dados do perfil do usuario logado
$dados_perfil_logado = retorne_dados_sessao_usuario_logado();
$dados_perfil_logado = $dados_perfil_logado[$tabela_banco[1]];

// valida o modo pagina
if($modo_pagina == false){
	
	// nome de usuario
	$titulo = retorne_nome_usuario_logado();

	// imagem de publicacao
	$imagem_publicacao = "
	$url_host_thumbnail
	";
	
	// texto de publicacao
	$texto = $codigos_especiais[0].$titulo.$idioma_sistema[320].$codigos_especiais[1].$imagem_publicacao;

};

// valida o modo pagina
if($modo_pagina == true){
	
	// imagem de publicacao
	$imagem_publicacao = "
	$url_host_thumbnail
	";
	
	// titulo da pagina
	$titulo = retorne_titulo_pagina_id($id);

	// texto de publicacao
	$texto = $codigos_especiais[0].$idioma_sistema[326].$titulo.$idioma_sistema[327].$codigos_especiais[1].$imagem_publicacao;
	
};

// array com dados de publicacao
$array_publicacao[TEXTO] = $texto;

// publica o conteudo de usuario
publicar_conteudo_usuario($array_publicacao, 1);

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

};

?>