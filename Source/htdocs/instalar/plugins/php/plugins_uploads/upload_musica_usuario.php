<?php

// upload de musica de usuario
function upload_musica_usuario(){

// globals
global $variavel_campo;
global $tabela_banco;
global $extensao_arquivo;

// id de usuario logado
$uid = retorne_idusuario_logado();

// pasta root
$pasta_root = retorne_pasta_usuario($uid, 3, true);

// pasta host
$pasta_host = retorne_pasta_usuario($uid, 3, false);

// nome do campo file
$nome_file = $variavel_campo[41];

// nome temporario do arquivo
$nome_temporario = $_FILES[$nome_file]['tmp_name'];

// nome real do arquivo
$nome_real_arquivo = $_FILES[$nome_file]['name'];

// tamanho do arquivo
$tamanho_arquivo = $_FILES[$nome_file]['size'];

// extensao de arquivo
$extensao = ".".converte_minusculo(pathinfo($nome_real_arquivo, PATHINFO_EXTENSION));

// valida extensao
if($extensao != $extensao_arquivo["mp3"]){
	
	// retorno nulo
	return null;
	
};

// nome do arquivo codificado
$nome_arquivo_codificado = codifica_md5($nome_real_arquivo.data_atual().retorne_contador_iteracao()).$extensao;

// endereco final de arquivo root
$endereco_root = $pasta_root."/".$nome_arquivo_codificado;

// endereco host
$endereco_host = $pasta_host."/".$nome_arquivo_codificado;

// fazendo upload
move_uploaded_file($nome_temporario, $endereco_root);

// chave de retorno publicacao
$chave = retorna_chave_request();

// tabela
$tabela = $tabela_banco[26];

// data
$data = data_atual();

// titulo da musica
$titulo_musica = converte_minusculo(remove_html(str_ireplace($extensao, null, $nome_real_arquivo)));

// cadastra no banco de dados
$query = "insert into $tabela values(null, '$uid', '$titulo_musica', '$endereco_root', '$endereco_host', '$chave', '$data');";

// salvando dados de musica
plugin_executa_query($query);

// retorno
return $chave;

};

?>