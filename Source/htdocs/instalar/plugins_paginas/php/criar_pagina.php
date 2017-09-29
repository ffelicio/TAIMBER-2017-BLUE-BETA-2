<?php

// cria a pagina do usuario
function criar_pagina(){

// globals
global $tabela_banco;
global $variavel_campo;

// id da pagina
$id = retorne_idpagina_request();

// tipo de acao
$tipo_acao = 110;

// valida numero de paginas por usuario
if(retorne_pode_criar_paginas() == false and retorne_campo_formulario_request(2) == 52){

	// chama a pagina novamente
    return chama_acao_usuario($tipo_acao);

};

// array com campos
$array_campos = explode(",", CAMPO_TABELA_PERFIL_PAGINA_CAMPOS);

// array com campos de tabelas
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_PAGINA_CORPO);

// contador
$contador = 0;

// titulo da pagina
$titulo_pagina = null;

// lista campos disponiveis
foreach($array_campos as $campo){

	// valida campo
	if($campo != null){

		// trata o campo do formulario
		$campo_tabela = trata_campo_tabela($array_campos_tabela[$contador + 1], false);

		// valor de requeste
		$valor_requeste = remove_html($_REQUEST[$campo_tabela]);	

		// valida primeiro elemento de contador
		if($contador == 0){
			
			// pegando o titulo
			$titulo_pagina = $valor_requeste;
			
		};
		
		// valida valor de campo
		if($valor_requeste == null){
			
			// chama a pagina novamente
			return chama_acao_usuario($tipo_acao);
	
		};
		
		// campos adicionar em tabela
		$campos_adicionar .= "\"$valor_requeste\", ";	

		// atualiza o contador
		$contador++;
		
	};

};

// campos a serem adicionados
$campos_adicionar = substr($campos_adicionar, 0, -2);

// id de usuario
$idusuario = retorne_idusuario_logado();

// data atual
$data = data_atual();

// adiciona o id de usuario
$campos_adicionar = "\"$idusuario\", $campos_adicionar";

// valida o tipo de campo de formulario
if(retorne_campo_formulario_request(2) == 54){

	// valida usuario dono da pagina
	if(retorne_usuario_dono_pagina($idusuario, $id) == false){
		
        // chama a pagina novamente
        return chama_pagina_usuario($id);		
		
	};
	
	// query
	$query[0] = "delete from $tabela_banco[19] where id='$id';";
	$query[1] = "insert into $tabela_banco[19] values(\"$id\", $campos_adicionar);";
	$query[2] = "update $tabela_banco[18] set titulo='$titulo_pagina' where id='$id' and uid='$idusuario';";
	$query[3] = "update $tabela_banco[22] set titulo='$titulo_pagina' where pagina='$id';";

	// atualiza as informacoes da pagina
	plugin_executa_query($query[0]);
	plugin_executa_query($query[1]);
	plugin_executa_query($query[2]);
	plugin_executa_query($query[3]);
	
    // salva todos os dados do usuario na sessao
    atualiza_retorna_dados_usuario_sessao(true, true);

	// url da pagina
	$url_pagina = PAGINA_INICIAL."?$variavel_campo[25]=$id";

	// atualiza a pagina
	return chama_pagina_url($url_pagina);

};

// query
$query[0] = "insert into $tabela_banco[18] values(null, '$idusuario', '$titulo_pagina', '$data');";
$query[1] = "select *from $tabela_banco[18] where uid='$idusuario' order by id desc;";

// cadastra a nova pagina
plugin_executa_query($query[0]);

// dados de query
$dados_query = plugin_executa_query($query[1]);

// id da ultima pagina criada
$id = $dados_query["dados"][0]["id"];

// query
$query[2] = "insert into $tabela_banco[19] values(\"$id\", $campos_adicionar);";

// valida se a pagina foi cadastrada
if($dados_query["linhas"] > 0){

    // adiciona 
    plugin_executa_query($query[2]);	
	
};

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

// chama a pagina novamente
return chama_pagina_usuario($id);

};

?>