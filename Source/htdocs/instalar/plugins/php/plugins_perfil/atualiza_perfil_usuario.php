<?php

// atualiza o perfil do usuario
function atualiza_perfil_usuario(){

// globals
global $variavel_campo;
global $tabela_banco;
global $pagina_inicial;
global $codigos_especiais;

// url que será aberta em caso de algum erro
$url_abrir = "$pagina_inicial?$variavel_campo[2]=2";

// valida o modo
if(retorne_campo_formulario_request(6) != true){
	
	// atualiza a pagina
	return chama_pagina_url($url_abrir);

};

// array com campos de tabelas
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_CORPO);

// contador
$contador = 0;

// obtendo valores
foreach($array_campos_tabela as $campo_tabela){
	
	// valida campo de tabela
	if($campo_tabela != null){
	    
        // campo de tabela
	    $campo_tabela = $array_campos_tabela[$contador];
	
	    // trata o campo do formulario
	    $campo_tabela = trata_campo_tabela($campo_tabela, false);
	
	    // nome de campo elemento html
	    $campo_elemento_nome = "campo_edita_perfil_$campo_tabela";
		
		// valor de requeste
		$valor_requeste = remove_html($_REQUEST[$campo_elemento_nome]);

		// campo data
		if($contador == 4){
			
			// valores de request
			$dia = retorne_campo_formulario_request(37);
			$mes = retorne_campo_formulario_request(38);
			$ano = retorne_campo_formulario_request(39);

			// valor de requeste
			$valor_requeste = $dia.$codigos_especiais[10].$mes.$codigos_especiais[10].$ano;
			
		};

		// valida se o nome e sobrenome estão em branco
		if($contador <= 1 and $valor_requeste == null){
			
			// atualiza a pagina
			return chama_pagina_url($url_abrir);

		};

		// campos a serem atualizados
		$campos_atualizar .= $campo_tabela."=\"$valor_requeste\", ";
	    
		// campos adicionar em tabela
		$campos_adicionar .= "\"$valor_requeste\", ";

		// atualiza o contador
		$contador++;

	};
	
};

// campos a serem atualizados
$campos_atualizar = substr($campos_atualizar, 0, -2);

// campos a serem adicionados
$campos_adicionar = substr($campos_adicionar, 0, -2);

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query[0] = "select *from $tabela_banco[1] where uid=\"$idusuario\";";
$query[1] = "update $tabela_banco[1] set $campos_atualizar where uid=\"$idusuario\";";
$query[2] = "insert into $tabela_banco[1] values($idusuario, $campos_adicionar);";

// array de dados
$array_dados = plugin_executa_query($query[0]);

// atualiza ou cadastra novos dados
if($array_dados["linhas"] == 0){
    
	// cadastra
	plugin_executa_query($query[2]);
	
}else{
	
	// atualiza dados
	plugin_executa_query($query[1]);
	
};

// adiciona uma publicacao ao atualizar o perfil
adicionar_publicacao_atualizar_perfil();

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

// atualiza os dados do amigo
atualize_dados_amigo(null, null, false);

// atualiza a pagina
return chama_pagina_url($url_abrir);

};

?>