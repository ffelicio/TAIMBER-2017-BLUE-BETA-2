<?php

// carrega as paginas do usuario
function carregar_paginas_usuario(){

// globals
global $tabela_banco;

// modo
$modo = retorne_campo_formulario_request(6);

// retorna o id de usuario de request
$uid = retorne_idusuario_request();

// termo de pesquisa
$termo_pesquisa = retorne_campo_formulario_request(22);

// valida modo
if($modo == null){
	
	// modo padrao
	$modo = 0;
	
};

// retorna zerar contador de avanco
if(retorne_zerar_contador_avanco_pesq_pagina($termo_pesquisa.$modo) == true){
	
	// limit
	$limit = retorne_limit_query(retorne_campo_formulario_request(2), true);
	
	// zerou contador
	$zerou_contador = 1;
	
}else{

	// limit
	$limit = retorne_limit_query(retorne_campo_formulario_request(2), false);
	
	// nao zerou contador
	$zerou_contador = 0;
	
};

// valida modo
switch($modo){
	
	case 0:
	$query = "select *from $tabela_banco[18] where uid='$uid' and titulo like'%$termo_pesquisa%' order by id desc $limit;";
	$modo_pagina = true;
	break;
	
	case 1:
	$query = "select *from $tabela_banco[22] where uidamigo='$uid' and titulo like'%$termo_pesquisa%' order by id desc $limit;";
	$modo_pagina = false;
	break;
	
	case 2:
	$query = "select *from $tabela_banco[18] where titulo like'%$termo_pesquisa%' order by id desc $limit;";
	$modo_pagina = true;	
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
$array_retorno["zerou_contador"] = $zerou_contador;

// retorno
return json_encode($array_retorno);

};

?>