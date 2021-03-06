<?php

// plugin de conexao com o banco de dados
function plugin_conexao($conectar = true){

// nome da conexão
$nome_conexao = CONEXAO_MYSQLI;

// informa se está conectado
$conectado = $_SESSION[$nome_conexao] != null;

// valida se deseja desconectar
if($conectar == false and $conectado == true){
	
	// fecha a conexão
	mysqli_close($_SESSION[$nome_conexao]);

	// limpa a variavel de conexao
	$_SESSION[$nome_conexao] = null;

	// retorno nulo
	return null;
	
};

// valida se está conectado, e está tentando conectar novamente
if($conectar == true and $conectado == true){
	
	// retorno nulo
	return null;
	
};

// valida configuracao e conecta-se ao mysql
if($conectar == true and $conectado == false){

    // conecta-se ao mysql
    $_SESSION[$nome_conexao] = mysqli_connect(SERVIDOR_MYSQL, USUARIO_MYSQL, SENHA_MYSQL);

	// agora seleciona o banco de dados
	mysqli_select_db($_SESSION[$nome_conexao], NOME_BANCO_DADOS);
	
	// codificacao UTF-8
	mysqli_query($_SESSION[$nome_conexao], "SET NAMES 'utf8'");
	mysqli_query($_SESSION[$nome_conexao], 'SET character_set_connection=utf8');
	mysqli_query($_SESSION[$nome_conexao], 'SET character_set_client=utf8');
	mysqli_query($_SESSION[$nome_conexao], 'SET character_set_results=utf8');

};

};

?>