<?php

// exibe os inscritos da pagina
function exibir_inscritos_pagina(){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[22];

// id de pagina
$pagina = retorne_idpagina_request();

// valida o modo
if(retorne_campo_formulario_request(6) == 0){
	
    // limit de query
    $limit = retorne_limit_query(retorne_campo_formulario_request(2), false);	
	
	// zerou contador
	$zerou_contador = 0;
	
}else{

    // limit de query
    $limit = retorne_limit_query(retorne_campo_formulario_request(2), true);

	// zerou contador
	$zerou_contador = 1;
	
};

// query
$query = "select *from $tabela where pagina='$pagina' order by id desc $limit;";

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
	
	// separa os dados
	$uidamigo = $dados[UIDAMIGO];
	
	// valida uidamigo
	if($uidamigo != null){
		
	    // imagem de perfil de usuario
		$imagem_perfil_usuario = constroe_imagem_perfil_miniatura(false, true, $uidamigo);
		
		// perfil basico de usuario
        $perfil_basico_usuario = "
        
        <div class='classe_div_separa_amigo_visualizar_perfil_pagina_2'>
        $imagem_perfil_usuario
        </div>
        
       ";
		
		// imagem de perfil de usuario
	    $html .= $perfil_basico_usuario;
		
	};

};

// array de retorno
$array_retorno["dados"] = $html;
$array_retorno["zerou_contador"] = $zerou_contador;

// retorno
return json_encode($array_retorno);

};

?>