<?php

// visitar perfil
function visitar_perfil(){

// globals
global $tabela_banco;

// id de usuario
$idusuario = retorne_idusuario_request();

// valida usuario dono do perfil
if(retorne_usuario_dono_perfil($idusuario) == true){

    // retorno nulo	
    return null;
	
};

// retorna o id de usuario logado
$idusuario_logado = retorne_idusuario_logado();

// verifica se e o administrador do sistema
if(retorne_pode_bloquear($idusuario_logado) == false){
	
	// retorno nulo
	return null;
	
};

// data atual
$data = data_atual();

// query
$query[0] = "select *from $tabela_banco[11] where uid='$idusuario' and uidamigo='$idusuario_logado';";
$query[1] = "insert into $tabela_banco[11] values(null, '$idusuario', '$idusuario_logado', '1', '$data');";

// dados de query
$dados_query = plugin_executa_query($query[0]);

// valida linhas
if($dados_query["linhas"] == 0){
	
	// adiciona visita ao perfil
	plugin_executa_query($query[1]);
	
}else{
	
	// data da ultima visita
	$data_visitou = $dados_query["dados"][0][DATA];
	
	// valida se as datas sao iguais
	if($data != $data_visitou){

		// atualiza contador de visitas
		$numero_visitas = ($dados_query["dados"][0][NUMERO_VISITAS] + 1);

		// query para deletar visita
		$query[2] = "delete from $tabela_banco[11] where uid='$idusuario' and uidamigo='$idusuario_logado';";
	
		// query para atualizar numero de visitas
		$query[3] = "insert into $tabela_banco[11] values(null, '$idusuario', '$idusuario_logado', '$numero_visitas', '$data');";

		// atualiza o numero de visitas
		plugin_executa_query($query[2]);
		plugin_executa_query($query[3]);
	
	};
	
};

};

?>