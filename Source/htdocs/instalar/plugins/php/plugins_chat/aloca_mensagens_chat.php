<?php

// aloca as mensagens do chat
function aloca_mensagens_chat(){

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

// array de retorno
$array_retorno = array();

// numero de usuarios abertos
$numero_abertos = retorne_numero_usuarios_abertos_chat();

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

		// numero de novas mensagens
		$numero_novas_mensagens = retorne_numero_mensagens(2, $uidamigo_tabela);
		
		// valida novas mensagens
		if($numero_novas_mensagens == 0){
			
			// limpa o numero de novas mensagens
			$numero_novas_mensagens = null;
			
		}else{
			
			// tamanho de novas mensagens
			$numero_novas_mensagens = retorne_tamanho_resultado($numero_novas_mensagens);
			
		};
		
		// atualiza o array de retorno
		$array_retorno[$contador][0] = $uidamigo_tabela;
		$array_retorno[$contador][1] = retorne_numero_mensagens(4, $uidamigo_tabela);
		$array_retorno[$contador][2] = $numero_novas_mensagens;
		$array_retorno[$contador][3] = $numero_abertos;
		
	};
	
};

// retorno
return $array_retorno;

};

?>