<?php

// atualizador de chat de usuario
function atualizador_chat_usuario(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[6];

// usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query = "select *from $tabela where uid='$idusuario' and aceito='1';";

// array de dados de query
$dados_query = plugin_executa_query($query);

// numero de linhas
$numero_linhas = $dados_query["linhas"];

// contador
$contador = 0;

// numero de usuarios online
$numero_online = 0;

// varrendo dados, e construindo dados de cada usuario
for($contador == $contador; $contador <= $numero_linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// valida dados
	if($dados["id"] != null){
		
		// separando dados
		$id = $dados["id"];
        $uid = $dados[UID];
        $uidamigo = $dados[UIDAMIGO];
        $uidenviou = $dados[UIDENVIOU];

		// valida id de usuario
		if($uid != $idusuario){
			
			// define o uidamigo de tabela
			$uidamigo_tabela = $uid;
		
		};
		
		// valida id de usuario
		if($uidamigo != $idusuario){
			
			// define o uidamigo de tabela
			$uidamigo_tabela = $uidamigo;
		
		};

        // valida usuario online
		if(retorne_usuario_online($uidamigo_tabela) == true){
			
			// imagem de sistema
		    $imagem_sistema[0] = retorne_imagem_sistema(18, null, false);
		
		    // atualiza o numero de usuarios online
		    $numero_online++;
			
		}else{
			
			// imagem de sistema
		    $imagem_sistema[0] = retorne_imagem_sistema(19, null, false);
			
		};

		// atualiza o array de retorno
		$array_dados[$contador][0] = $uidamigo_tabela;
        $array_dados[$contador][1] = $imagem_sistema[0];
		$array_dados[$contador][2] = $numero_online;

	};
	
};

// array de retorno
$array_retorno["dados"] = $array_dados;
$array_retorno["mensagens"] = aloca_mensagens_chat();

// retorno
return json_encode($array_retorno);

};

?>