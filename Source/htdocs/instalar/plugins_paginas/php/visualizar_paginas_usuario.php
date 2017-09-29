<?php

// visualiza as paginas criadas ou inscritas do usuario
function visualizar_paginas_usuario(){

// globals
global $tabela_banco;

// modo
$modo = retorne_campo_formulario_request(6);
$modo_paginar = retorne_campo_formulario_request(26);

// retorna o id de usuario de request
$uid = retorne_idusuario_request();

// valida o modo
switch($modo){
	
	case 2:
    $limit = retorne_limit_query(retorne_tipo_acao_pagina(), true);
	$array_retorno["zerou_contador"] = 1;
	break;
	
	default:
    $limit = retorne_limit_query(retorne_tipo_acao_pagina(), false);
    $array_retorno["zerou_contador"] = 0;
	
};

// valida o modo
switch($modo_paginar){
	
	case 0:
	// query
	$query = "select *from $tabela_banco[18] where uid='$uid' order by id desc $limit;";
	
	// modo de pagina
	$modo_pagina = true;
	break;
	
	case 1:
	// query
	$query = "select *from $tabela_banco[22] where uidamigo='$uid' order by id desc $limit;";
	
	// modo de pagina
	$modo_pagina = false;
	break;

};

// contador
$contador = 0;

// dados de query
$dados_query = plugin_executa_query($query);

// constroe usuarios
for($contador == $contador; $contador <= $dados_query["linhas"]; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// obtem os dados do perfil da pagina
	if($modo_pagina == true){

	    // dados do perfil da pagina
		$dados_perfil = retorne_dados_perfil_pagina($dados["id"]);

	};
	
    // codigo html
	$html .= constroe_pagina_miniatura($dados, $dados_perfil, $modo_pagina, true);
	
};

// array de retorno
$array_retorno["dados"] = $html;

// retorno
return json_encode($array_retorno);

};

?>