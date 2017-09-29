<?php

// constroe as musicas de publicacao
function constroe_musicas_publicacao($chave){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[26];

// query
$query = "select *from $tabela where chave='$chave';";

// valida o numero de linhas
if(retorne_numero_linhas_query($query) > 1){
	
	// html
	$html = constroe_player_playlist(false, plugin_executa_query($query));

}else{
	
	// html
	$html = constroe_player(false, plugin_executa_query($query));
	
};

// valida html
if($html == null){
	
	// retorno nulo
	return null;
	
};

// html
$html = "
<div class='classe_player_musica'>$html</div>
";

// retorno
return $html;

};

?>