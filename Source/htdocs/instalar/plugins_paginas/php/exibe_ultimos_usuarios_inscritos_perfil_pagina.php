<?php

// exibe os ultimos usuarios inscritos no perfil da pagina
function exibe_ultimos_usuarios_inscritos_perfil_pagina(){

// globals
global $tabela_banco;

// id da pagina
$pagina = retorne_idpagina_request();

// limit de query
$limit = "limit ".NUMERO_AMIGOS_CAMPO_PERFIL;

// query
$query = "select *from $tabela_banco[22] where pagina='$pagina' order by id desc $limit;";

// dados de query
$dados_query = plugin_executa_query($query);

// contador
$contador = 0;

// construindo usuarios
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){

    $dados = $dados_query["dados"][$contador];
	
	// separa os dados
	$uidamigo = $dados[UIDAMIGO];
	
	// valida uidamigo
	if($uidamigo != null){
		
        // imagem de perfil de usuario
		$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_amizade(false, true, false, $uidamigo);
		
		// perfil basico de usuario
        $perfil_basico_usuario = "
        
        <div class='classe_div_separa_amigo_visualizar_perfil_pagina'>
        $imagem_perfil_usuario
        </div>
        
       ";
		
		// imagem de perfil de usuario
	    $html .= $perfil_basico_usuario;	
	
	};

};

// retorno
return $html;

};

?>