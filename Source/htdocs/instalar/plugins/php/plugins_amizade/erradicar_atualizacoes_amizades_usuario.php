<?php

// erradica as atualizacoes de amizades do usuário
function erradicar_atualizacoes_amizades_usuario($uid){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[6];

// query
$query = "select *from $tabela where uid='$uid' and nome is null;";

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// contador
$contador = 0;

// varrendo e listando amigos de usuario
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// id de amigo de usuario
	$uidamigo = $dados[UIDAMIGO];
	
	// valida uidamigo
	if($uidamigo != null){
		
		// atualiza os dados do amigo
		atualize_dados_amigo($uid, $uidamigo, true);
		
	};
	
};

};

?>