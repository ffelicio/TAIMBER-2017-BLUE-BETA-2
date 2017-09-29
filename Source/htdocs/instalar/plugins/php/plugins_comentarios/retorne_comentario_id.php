<?php

// retorna o comentario por id
function retorne_comentario_id($id){

// globals
global $tabela_banco;
global $idioma_sistema;

// query
$query = "select *from $tabela_banco[7] where id='$id';";

// dados de query
$dados_query = plugin_executa_query($query);

// valida comentario existe
if($dados_query["linhas"] == 0){
	
	// mensagem de retorno
	$mensagem[0] = mensagem_erro(retorne_nome_usuario_logado().$idioma_sistema[464]);
	
	// retorno
	return constroe_conteudo_padrao(true, $mensagem[0], null);
	
}else{

	// retorno
	return constroe_comentario($dados_query["dados"][0]);

};

};

?>