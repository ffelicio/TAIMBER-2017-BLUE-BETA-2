<?php

// erradica os aniversarios dos amigos do usuario logado
function erradicar_aniversarios_amigos(){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// tabela
$tabela[0] = $tabela_banco[6];
$tabela[1] = $tabela_banco[25];

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_logado_sessao();

// array com dados de amigos
$array_amizade = $dados_compilados_usuario[$tabela_banco[6]];

// numero de amigos
$numero_amigos = retorne_numero_amigos($array_amizade);

// contador
$contador = 0;

// data atual
$data = data_atual();

// query
$query = "delete from $tabela[1] where uid='$uid';";

// executa a query
plugin_executa_query($query);

// obtendo dados de amigos
for($contador == $contador; $contador <= $numero_amigos; $contador++){
	
	// dados
	$dados = $array_amizade[$contador];

	// valida uid
	if($uid != null){
		
		// uidamigo
		$uidamigo = retorne_idamigo_dados_amigo(true, $dados, $uid);

		// dados de perfil
		$dados_perfil = retorne_dados_perfil_usuario($uidamigo);
	
		// separa os dados de perfil
		$nasceu = $dados_perfil[NASCEU];
	
		// valida data de nascimento
		if(retorne_aniversario($nasceu) == true){
			
			// idade
			$idade = retorne_idade_usuario($nasceu);
			
			// query
			$query = "insert into $tabela[1] values(null, '$uid', '$uidamigo', '$idade', '$data');";
			
			// executa a query
			plugin_executa_query($query);
			
		};
	
	};

};

};

?>