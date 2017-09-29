<?php

// constroe as marcacoes de usuarios
function constroe_marcacoes_usuarios($idpost, $tabela_referencia){

// globals
global $tabela_banco;
global $idioma_sistema;

// tabela
$tabela = $tabela_banco[14];

// query
$query = "select *from $tabela where idpost='$idpost' and tabela_referencia='$tabela_referencia';";

// contador
$contador = 0;

// dados de query
$dados_query = plugin_executa_query($query);

// numero de linhas
$numero_linhas = $dados_query["linhas"];

// valida o numero de linhas
if($numero_linhas == 0){
	
	// retorno nulo
	return null;
	
};

// constroe a lista com usuarios marcados
for($contador == $contador; $contador <= $numero_linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separando dados
	$uidamigo = $dados[UIDAMIGO];
	
	// valida o uidamigo
	if($uidamigo != null){
		
		// nome link de usuario
		$nome_link = retorne_nome_link_usuario(true, $uidamigo);

		// lista de usuarios marcados
		$lista_marcados .= "
		<div class='classe_usuario_marcado'>
		$nome_link
		</div>	
		";
	
	};

};

// html
$html = "
<div class='classe_div_usuarios_marcados'>
<div class='classe_div_usuarios_marcados_titulo'>
$idioma_sistema[291]
</div>

$lista_marcados
</div>
";

// retorno
return $html;

};

?>