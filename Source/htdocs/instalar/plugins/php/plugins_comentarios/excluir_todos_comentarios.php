<?php

// exclui todos os comentarios
function excluir_todos_comentarios($id_post, $tabela_comentario){

// globals
global $tabela_banco;

// query
$query[0] = "select *from $tabela_banco[7] where id_post='$id_post' and tabela_comentario='$tabela_comentario';";
$query[1] = "delete from $tabela_banco[7] where id_post='$id_post' and tabela_comentario='$tabela_comentario';";

// exclui todos os comentarios
$dados_query = plugin_executa_query($query[0]);

// contador
$contador = 0;

// excluindo marcacoes se houverem
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){

	// dados
	$dados = $dados_query["dados"][$contador];

	// remove a marcacao
	remove_marcacao_usuario($dados["id"], $tabela_banco[7]);
	
	// exclui as respostas de comentario
	excluir_respostas_comentario($dados["id"]);

};

// exclui todos os comentarios
plugin_executa_query($query[1]);

};

?>