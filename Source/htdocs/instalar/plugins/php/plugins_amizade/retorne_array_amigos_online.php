<?php

// retorna o array com amigos online
function retorne_array_amigos_online($idusuario){

// global
global $tabela_banco;

// tabela
$tabela = $tabela_banco[6];

// query
$query = "select *from $tabela where uid='$idusuario' and aceito='1' order by id desc;";

// array de dados
$array_dados = plugin_executa_query($query);

// linhas
$linhas = $array_dados["linhas"];

// contador
$contador = 0;

// listando usuarios online
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $array_dados["dados"][$contador];

	// uid
	$uid = retorne_idamigo_dados_amigo(true, $dados, $idusuario);
	
	// valida usuario online
	if($uid != null and retorne_usuario_online($uid) == true){

		// atualizando array
		$array_retorno[] = $uid;
		
	};
	
};

// retorno
return $array_retorno;

};

?>