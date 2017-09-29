<?php

// exclui os compartilhamentos
function excluir_compartilhamentos($id){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[5];

// query
$query = "select *from $tabela where id_compartilhado='$id' and id!='$id';";

// contador
$contador = 0;

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// excluindo publicacoes compartilhadas
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// valida o id de dados
	if($dados["id"] != null){
		
		// exclui a publicacao de usuario
		excluir_publicacao_usuario($dados["id"], true);
	
	};
	
};

};

?>