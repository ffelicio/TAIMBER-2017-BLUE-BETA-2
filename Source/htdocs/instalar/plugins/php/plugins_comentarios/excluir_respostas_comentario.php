<?php

// exclui as respostas de comentario
function excluir_respostas_comentario($id_post){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[7];

// query
$query[0] = "select *from $tabela where tabela_comentario='$tabela' and id_post='$id_post';";
$query[1] = "delete from $tabela where tabela_comentario='$tabela' and id_post='$id_post';";

// exclui comentario
$array_dados = plugin_executa_query($query[0]);

// contador
$contador = 0;

// linhas
$linhas = $array_dados["linhas"];

// listando comentarios e excluindo notificacao sobre ele
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $array_dados["dados"][$contador];
	
	// separando dados
	$id = $dados["id"];

	// valida id
	if($id != null){
		
		// remove notificacao
		remove_notifica(null, $id, $tabela, true);

	};
	
};

// exclui comentario
plugin_executa_query($query[1]);

};

?>