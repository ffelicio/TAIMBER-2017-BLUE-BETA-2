<?php

// remove o plano de fundo de usuario
function remover_plano_fundo_usuario(){

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
$tabela = $tabela_banco[38];

// numero da pasta
$numero_pasta = 5;

// pasta de upload root
$pasta_upload_root = retorne_pasta_usuario($idusuario, $numero_pasta, true);

// exclui e recria pastas
excluir_pastas_subpastas($pasta_upload_root, false);

// query
$query = "delete from $tabela where uid='$idusuario';";

// executando query
plugin_executa_query($query);
	
// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

};

?>