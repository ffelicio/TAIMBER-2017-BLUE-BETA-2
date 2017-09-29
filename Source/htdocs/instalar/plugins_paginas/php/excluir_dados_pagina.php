<?php

// exclui todos os dados da pagina
function excluir_dados_pagina($pagina){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// valida usuario logado dono da pagina
if(retorne_usuario_dono_pagina($uid, $pagina) == false){
	
	// retorno nulo
	return null;
	
};

// tabelas
$tabelas[0] = $tabela_banco[18];
$tabelas[1] = $tabela_banco[19];
$tabelas[2] = $tabela_banco[20];
$tabelas[3] = $tabela_banco[21];
$tabelas[4] = $tabela_banco[22];
$tabelas[5] = $tabela_banco[23];

// pastas a serem excluidas
$pasta_excluir[0] = retorne_pasta_usuario($uid, 7, true);
$pasta_excluir[1] = retorne_pasta_usuario($uid, 10, true);

// exclui as pastas da pagina
excluir_pastas_subpastas($pasta_excluir[0], false);
excluir_pastas_subpastas($pasta_excluir[1], false);

// querys
$query[0] = "select *from $tabela_banco[5] where pagina='$pagina' and uid='$uid';";

// contador
$contador = 0;

// dados de query
$dados_query = plugin_executa_query($query[0]);

// carregando as publicacoes da pagina
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa os dados
	$id = $dados["id"];
	
	// exclui a publicacao
	if($id != null){
		
		// excluindo...
		excluir_publicacao_usuario($id, false);

	};

};

// querys
foreach($tabelas as $tabela){
	
	// valida tabela
	if($tabela != null){
		
		// querys
		$query[0] = "delete from $tabela where id='$pagina';";
		$query[1] = "delete from $tabela where pagina='$pagina';";
		
		// executa as querys
		plugin_executa_query($query[0]);
		plugin_executa_query($query[1]);

	};

};

};

?>