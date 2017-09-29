<?php

// exclui musica de usuario
function excluir_musica_usuario($id, $chave){

// globals
global $tabela_banco;

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// retorno nulo
	return null;
	
};

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// tabela
$tabela = $tabela_banco[26];

// valida a chave
if($chave != null){
	
	// query
	$query = "select *from $tabela where (id='$id' or chave='$chave') and uid='$idusuario';";

}else{
	
	// query
	$query = "select *from $tabela where id='$id' and uid='$idusuario';";
	
};

// dados de query
$dados_query = plugin_executa_query($query);

// contador
$contador = 0;

// numero de linhas
$linhas = $dados_query["linhas"];

// listando musicas
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa os dados
	$id = $dados["id"];
	$uid = $dados[UID];
	$url_root_musica = $dados[URL_ROOT_MUSICA];

	// valida id e se e dono de musica
	if($id != null and $uid == $idusuario){
		
		// query
		$query = "delete from $tabela where id='$id' and uid='$idusuario';";
		
		// exclui do banco de dados
		plugin_executa_query($query);
		
		// excluindo musica...
		exclui_arquivo_unico($url_root_musica);
		
	};

};

};

?>