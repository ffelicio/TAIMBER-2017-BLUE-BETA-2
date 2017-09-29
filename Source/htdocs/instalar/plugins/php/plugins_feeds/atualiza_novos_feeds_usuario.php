<?php

// atualiza os novos feeds do usuario, util quando adicionar uma nova amizade
function atualiza_novos_feeds_usuario($uidamigo){

// globals
global $tabela_banco;

// id de usuario
$uid = retorne_idusuario_logado();

// tabela
$tabela = $tabela_banco[5];

// dados de usuario logado
$dados[0] = retorne_array_ids_ultimas_publicacoes_usuario($uid, true);

// dados de amigo de usuario
$dados[1] = retorne_array_ids_ultimas_publicacoes_usuario($uidamigo, true);

// valida existem publicacoes
if(is_array($dados[0]) == false or is_array($dados[1]) == false){
	
	// retorno nulo
	return null;
	
};

// data atual
$data = data_atual();

// deleta feeds antigos
$query[0] = "delete from $tabela_banco[8] where uidamigo='$uidamigo' and uid='$uid';";
$query[1] = "delete from $tabela_banco[8] where uidamigo='$uid' and uid='$uidamigo';";

// executando querys
plugin_executa_query($query[0]);
plugin_executa_query($query[1]);

// listando ids de publicacoes
foreach($dados[0] as $id){
	
	// valida id
	if($id != null){
		
		// query
		$query[2] = "insert into $tabela_banco[8] values(null, '$uidamigo', '$uid', '$id', '$data');";

		// adicionando feed...
		plugin_executa_query($query[2]);
		
	};
	
};

// listando ids de publicacoes
foreach($dados[1] as $id){
	
	// valida id
	if($id != null){
		
		// query
		$query[3] = "insert into $tabela_banco[8] values(null, '$uid', '$uidamigo', '$id', '$data');";

		// adicionando feed...
		plugin_executa_query($query[3]);

	};
	
};

};

?>