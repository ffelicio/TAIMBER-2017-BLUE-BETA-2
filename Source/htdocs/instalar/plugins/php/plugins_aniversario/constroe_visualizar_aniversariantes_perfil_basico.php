<?php

// constroe o visualizador de aniversariantes de perfil basico
function constroe_visualizar_aniversariantes_perfil_basico(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[25];

// id de usuario logado
$uid = retorne_idusuario_logado();

// limit
$limit_query = "limit ".NUMERO_ANIVERSARIANTES_PERFIL;

// query
$query = "select *from $tabela where uid='$uid' order by id desc $limit_query;";

// contador
$contador = 0;

// dados de query
$dados_query = plugin_executa_query($query);

// numero de linhas
$numero_linhas = $dados_query["linhas"];

// constroe usuarios
for($contador == $contador; $contador <= $numero_linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa dados
	$uidamigo = $dados[UIDAMIGO];
	
	// valida uidamigo
	if($uidamigo != null){

		// campo com perfil de usuario
		$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, false, $uidamigo);
	
		// html
		$html .= "
		<div class='classe_div_separa_amigo_visualizar_perfil'>$imagem_perfil_usuario</div>	
		";
	
	};
	
};

// retorno
return $html;

};

?>