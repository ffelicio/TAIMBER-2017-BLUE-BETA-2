<?php

// constroe a imagem por id
function constroe_imagem_id($id){

// globals
global $tabela_banco;

// query
$query = "select *from $tabela_banco[4] where id='$id';";

// dados de query
$dados_query = plugin_executa_query($query);

// valida o numero de linhas
if($dados_query["linhas"] == 0){
	
	// retorno nulo
	return null;

};

// dados
$dados = $dados_query["dados"][0];

// separando dados
$url_host_miniatura = $dados[URL_HOST_MINIATURA];

// html
$html = "
<div class='classe_imagem_album_usuario'>
<img src='$url_host_miniatura'>
</div>
";

// retorno
return $html;

};

?>