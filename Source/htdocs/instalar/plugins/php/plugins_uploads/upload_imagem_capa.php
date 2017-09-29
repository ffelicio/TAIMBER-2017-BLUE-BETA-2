<?php

// upload de imagem de capa
function upload_imagem_capa(){

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
	
	case 55:
	$tabela = $tabela_banco[21];
	$numero_pasta = 10;
    $id = retorne_idpagina_request();
	$modo_pagina = true;
	$novo_tamanho = TAMANHO_IMAGEM_CAPA_NORMAL_PAGINA;
	
	// valida o usuario dono da pagina
	if(retorne_usuario_dono_pagina($idusuario, $id) == false){
		
		// retorno nulo
		return null;
		
	};
	
	break;
	
	default:
    $tabela = $tabela_banco[3];
	$numero_pasta = 8;
	$modo_pagina = false;
	$novo_tamanho = TAMANHO_IMAGEM_CAPA_NORMAL;
	
};

// pasta de upload root
$pasta_upload_root = retorne_pasta_usuario($idusuario, $numero_pasta, true);

// exclui e recria pastas
excluir_pastas_subpastas($pasta_upload_root, true);

// pasta de upload host
$pasta_upload_host = retorne_pasta_usuario($idusuario, $numero_pasta, false);

// array de enderecos
$array_enderecos = upload_imagem(null, $pasta_upload_root, $novo_tamanho, null, false, false, $pasta_upload_host, null, null, null);

// separa enderecos
$host_normal = $array_enderecos['host_normal'];
$host_miniatura = $array_enderecos['host_miniatura'];
$root_normal = $array_enderecos['root_normal'];
$root_miniatura = $array_enderecos['root_miniatura'];
$url_normal = $array_enderecos['url_normal'];
$url_host_normal = $array_enderecos['url_host_normal'];
$url_root_normal = $array_enderecos['url_root_normal'];

// valida o modo pagina
if($modo_pagina == true){
	
    // querys
    $query[0] = "delete from $tabela where id='$id';";
    $query[1] = "insert into $tabela values('$id', '$host_normal', '$host_miniatura', '$root_normal', '$root_miniatura', '$url_host_normal', '$url_root_normal', '0');";	
	
}else{
	
    // querys
    $query[0] = "delete from $tabela where uid='$idusuario';";
    $query[1] = "insert into $tabela values('$idusuario', '$host_normal', '$host_miniatura', '$root_normal', '$root_miniatura', '$url_host_normal', '$url_root_normal', '0');";

};

// executa as querys
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);

// imagem de publicacao
$imagem_publicacao = "
$host_normal
";
	
// valida o modo pagina
if($modo_pagina == false){
	
	// texto de publicacao
	$texto = $codigos_especiais[0].$codigos_especiais[4].retorne_nome_usuario_logado().$codigos_especiais[5].$idioma_sistema[322].$codigos_especiais[1].$imagem_publicacao;

};

// valida o modo pagina
if($modo_pagina == true){
	
	// titulo da pagina
	$titulo_pagina = retorne_titulo_pagina_id($id);
	
	// texto de publicacao
	$texto = $codigos_especiais[0].$idioma_sistema[326].$titulo_pagina.$idioma_sistema[328].$codigos_especiais[1].$imagem_publicacao;
	
};

// array com dados de publicacao
$array_publicacao[TEXTO] = $texto;

// publica o conteudo de usuario
publicar_conteudo_usuario($array_publicacao, 2);

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

};

?>