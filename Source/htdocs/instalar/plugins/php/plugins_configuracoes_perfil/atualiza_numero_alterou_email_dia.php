<?php

// atualiza o numero de alteracoes de e-mail em um dia
function atualiza_numero_alterou_email_dia(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[32];

// id de usuario logado
$uid = retorne_idusuario_logado();

// data de hoje
$data_hoje = retorne_data_dia_mes_ano();

// query
$query = "select *from $tabela where uid='$uid';";

// dados de query
$dados_query = plugin_executa_query($query);

// separa os dados
$dados = $dados_query["dados"][0];

// separando os dados
$tentativas = $dados[TENTATIVAS];
$data = $dados[DATA];

// valida as datas
if($data == $data_hoje){
	
	// atualiza o numero de tentativas
	$tentativas++;
	
}else{
	
	// zera o numero de tentativas
	$tentativas = 1;
	
};

// limpa as querys antigas
$query = null;

// valida o numero de linhas
if($dados_query["linhas"] > 0){
	
	// query
	$query[0] = "update $tabela set tentativas='$tentativas', data='$data_hoje' where uid='$uid';";

}else{
	
	// query
	$query[0] = "delete from $tabela where uid='$uid';";
	$query[1] = "insert into $tabela values(null, '$uid', '$tentativas', '$data_hoje');";

};

// atualizando
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);

};

?>