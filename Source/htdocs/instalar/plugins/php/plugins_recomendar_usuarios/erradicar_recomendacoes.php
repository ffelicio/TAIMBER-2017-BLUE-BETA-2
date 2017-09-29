<?php

// erradica as recomendacoes
function erradicar_recomendacoes(){

// globals
global $tabela_banco;

// array de amigos
$array_amigos = array();

// data atual
$data = data_atual();

// tabela
$tabela[0] = $tabela_banco[1];
$tabela[1] = $tabela_banco[37];
$tabela[2] = $tabela_banco[6];

// dados de usuario logado
$dados_perfil = retorne_dados_perfil_usuario_logado();

// separando dados
$cidade = $dados_perfil[CIDADE];
$estado = $dados_perfil[ESTADO];

// valida dados
if($cidade == null or $estado == null){
	
	// retorno nulo
	return null;
	
};

// id de usuario logado
$uid = retorne_idusuario_logado();

// query
$query = "select *from $tabela[1] where uid='$uid' limit 1;";

// dados de query
$dados_query = plugin_executa_query($query);

// dados de query
$dados_query = $dados_query["dados"][0];

// contador
$contador[0] = $dados_query[CONTADOR];

// valida contador
if($contador[0] == null){
	
	// contador padrao
	$contador[0] = 0;
	
};

// limit
$limit = "limit $contador[0], ".NUMERO_RECOMENDACOES_ERRADICAR_USUARIOS;

// atualizando o contador
$contador[0] += NUMERO_RECOMENDACOES_ERRADICAR_USUARIOS;

// query
$query = "select *from $tabela[2] where uid='$uid' or uidamigo='$uid' order by uid desc $limit;";

// contador
$contador[1] = 0;

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// analisando amizades
for($contador[1] == $contador[1]; $contador[1] <= $linhas; $contador[1]++){
	
	// dados
	$dados = $dados_query["dados"][$contador[1]];
	
	// valida id
	if($dados["id"] != null){
		
		// id de amigo
		$uidamigo = retorne_idamigo_dados_amigo(false, $dados, $uid);
	
		// valida uidamigo
		if($uidamigo == null){
			
			// id de amigo
			$uidamigo = retorne_idamigo_dados_amigo(true, $dados, $uid);
			
		};

		// valida uidamigo
		if($uidamigo != null){
			
			// atualiza o array de amigos
			$array_amigos[] = $uidamigo;
			
		};
		
	};
	
};

// query
$query = "select *from $tabela[0] where (cidade like '%$cidade%' and estado like '%$estado%' and uid!='$uid') order by uid desc $limit;";

// contador
$contador[1] = 0;

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// analisando amizades
for($contador[1] == $contador[1]; $contador[1] <= $linhas; $contador[1]++){
	
	// dados
	$dados = $dados_query["dados"][$contador[1]];
	
	// valida id
	if($dados[UID] != null){
		
		// separando dados
		$uid_tabela = $dados[UID];

		// verifica se o usuario da tabela nao é amigo do usuario logado
		if(retorne_elemento_array_existe($array_amigos, $uid_tabela) == false){
			
			// query
			$query = "select *from $tabela[1] where uid='$uid' and uidamigo='$uid_tabela';";
			
			// valida numero de linhas
			if(retorne_numero_linhas_query($query) == 0 and retorne_usuario_bloqueio($uid_tabela) == false){
				
				// query
				$query = "insert into $tabela[1] values(null, '$uid', '$uid_tabela', '0', '$contador[0]', '$data');";
				
				// executando query
				plugin_executa_query($query);
				
			};
			
		};

	};
	
};

// valida numero de linhas
if($linhas > 0){
	
	// query
	$query = "update $tabela[1] set contador='$contador[0]' where uid='$uid';";

	// executando query
	plugin_executa_query($query);

};

};

?>