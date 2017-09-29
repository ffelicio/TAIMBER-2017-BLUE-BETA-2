<?php

// upload de imagem de plano de fundo
function upload_imagem_plano_fundo(){

// globals
global $tabela_banco;
global $idioma_sistema;
global $codigos_especiais;

// valida chave
if(retorna_chave_request() == null){
	
	// retorno nulo
	return null;
	
};

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

// tabela
$tabela = $tabela_banco[38];

// numero da pasta
$numero_pasta = 5;

// pasta de upload root
$pasta_upload_root = retorne_pasta_usuario($idusuario, $numero_pasta, true);

// exclui e recria pastas
excluir_pastas_subpastas($pasta_upload_root, true);

// pasta de upload host
$pasta_upload_host = retorne_pasta_usuario($idusuario, $numero_pasta, false);

// array de enderecos
$array_enderecos = upload_imagem(null, $pasta_upload_root, TAMANHO_GRANDE_IMAGEM_FUNDO, TAMANHO_MINIATURA_IMAGEM_FUNDO, false, false, $pasta_upload_host, null, null, null);

// separa enderecos hosts
$host_normal = $array_enderecos['host_normal'];
$host_miniatura = $array_enderecos['host_miniatura'];

// separa enderecos roots
$url_root_normal = $array_enderecos['url_root_normal'];
$root_miniatura = $array_enderecos['root_miniatura'];

// query
$query = "select *from $tabela where uid='$idusuario';";

// valida numero de linhas
if(retorne_numero_linhas_query($query) == 0){
	
	// query
	$query = "insert into $tabela values(null, '$idusuario', '$host_normal', '$host_miniatura', '$url_root_normal', '$root_miniatura');";
	
	// executando query
	plugin_executa_query($query);
	
}else{
	
	// limpa querys
	$query = "update $tabela set url_host_grande='$host_normal', url_host_miniatura='$host_miniatura', url_root_grande='$url_root_normal', url_root_miniatura='$root_miniatura' where uid='$idusuario';";
	
	// executando query
	plugin_executa_query($query);
	
};

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

};

?>