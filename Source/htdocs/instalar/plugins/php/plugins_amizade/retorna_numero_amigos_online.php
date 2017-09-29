<?php

// retorna o numero de amigos online
function retorna_numero_amigos_online($idusuario){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[6];

// query
$query = "select *from $tabela where uid='$idusuario' and aceito='1';";

// array de dados
$array_dados = plugin_executa_query($query);

// numero de linhas
$linhas = $array_dados["linhas"];

// contador
$contador[0] = 0;
$contador[1] = 0;

// numero de usuarios online
$numero_online = 0;

// analisando amigo online
for($contador[0] == $contador[0]; $contador[0] <= $linhas; $contador[0]++){
	
	// dados
	$dados = $array_dados["dados"][$contador[0]];
	
	// separa os dados
	$uid = retorne_idamigo_dados_amigo(true, $dados, $idusuario);

	// valida id de usuario
	if($uid != null){
	
		// valida usuario logado
		if(retorne_usuario_online($uid) == true){

			// atualizando numero de usuarios online
			$numero_online++;
		
			// atualiza o contador
			$contador[1]++;

		};
	
	};
	
};

// retorno
return $numero_online;

};

?>