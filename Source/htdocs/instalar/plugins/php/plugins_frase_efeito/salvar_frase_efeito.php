<?php

// salva a frase de efeito
function salvar_frase_efeito(){

// globals
global $tabela_banco;

// conteudo
$conteudo = retorne_campo_formulario_request(36);

// tabela
$tabela = $tabela_banco[33];

// id de usuario logado
$uid = retorne_idusuario_logado();

// data atual
$data = data_atual();

// query
$query[0] = "select *from $tabela where uid='$uid';";
$query[1] = "insert into $tabela values(null, '$uid', '$conteudo', '$data');";
$query[2] = "update $tabela set conteudo='$conteudo', data='$data' where uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query[0]);

// valida numero de linhas
if($dados_query["linhas"] == 0){
	
	// salva
	plugin_executa_query($query[1]);
	
}else{
	
	// atualiza
	plugin_executa_query($query[2]);
	
};

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

};

?>