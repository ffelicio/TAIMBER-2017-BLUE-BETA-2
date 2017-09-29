<?php

// retorna o numero de visitas
function retorne_numero_visitas($idusuario, $modo){

// globals
global $tabela_banco;
global $idioma_sistema;

// retorna o id de usuario logado
$idusuario_logado = retorne_idusuario_logado();

// query
$query = "select *from $tabela_banco[11] where uid='$idusuario_logado' and uidamigo='$idusuario';";

// dados de query
$dados_query = plugin_executa_query($query);

// numero de visitas
$numero_visitas = $dados_query["dados"][0][NUMERO_VISITAS];

// valida modo
if($modo == true){

    // valida numero de visitas
    if($numero_visitas > 1){

	    // reduz tamanho
	    $numero_visitas = retorne_tamanho_resultado($numero_visitas).$idioma_sistema[132];
		
	}else{
     
	    // apenas menos ou uma visita
	    $numero_visitas = $idioma_sistema[133].$numero_visitas.$idioma_sistema[134];

	};
	
};

// retorno
return $numero_visitas;

};

?>