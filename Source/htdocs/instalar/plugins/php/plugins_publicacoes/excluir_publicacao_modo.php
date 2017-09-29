<?php

// exclui a publicacao pelo modo
function excluir_publicacao_modo($id, $modo){

// globals
global $tabela_banco;

// id de usuario
$idusuario = retorne_idusuario_logado();

// query
$query = "select *from $tabela_banco[5] where id!='$id' and uid='$idusuario' and modo='$modo';";

// contador
$contador = 0;

// dados de query
$dados_query = plugin_executa_query($query);

// excluindo publicacoes via modo
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa os dados
	$id = $dados["id"];
	
	// valida id
	if($id != null){
		
		// excluindo publicacao
		excluir_publicacao_usuario($id, false);	
	
	};
	
};

};

?>