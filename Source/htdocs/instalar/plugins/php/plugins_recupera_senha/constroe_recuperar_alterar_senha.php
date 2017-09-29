<?php

// constroe o campo de recuperação de senha para alterar
function constroe_recuperar_alterar_senha(){

// globals
global $tabela_banco;
global $idioma_sistema;

// tabela
$tabela = $tabela_banco[31];

// chave
$chave = retorna_chave_request();

// query
$query = "select *from $tabela where chave='$chave';";

// dados de query
$dados_query = plugin_executa_query($query);

// classe
$classe[0] = "classe_conteudo_centro_padrao";

// valida numero de linhas
if($dados_query["linhas"] == 0){
	
	// mensagem
	$mensagem[0] = mensagem_erro($idioma_sistema[449]);
	
	// html
	$html = "
	<div class='$classe[0]'>
	$mensagem[0]
	</div>
	";
	
	// retorno
	return $html;
	
};

// campos
$campo[0] = formulario_altera_senha();

// html
$html = "
<div class='$classe[0]'>
$campo[0]
</div>
";

// retorno
return $html;

};

?>