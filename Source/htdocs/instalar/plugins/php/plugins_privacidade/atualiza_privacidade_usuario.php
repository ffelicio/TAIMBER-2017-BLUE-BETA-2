<?php

// atualiza a privacidade do usuario
function atualiza_privacidade_usuario(){

// globals
global $variavel_campo;
global $tabela_banco;
global $pagina_inicial;

// array com campos de tabelas
$array_campos_tabela = explode(",", CAMPO_TABELA_PRIVACIDADE_CORPO);

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
        
		// atualiza o contador
		$contador++;
		
		// valor de requeste
		$valor_requeste = remove_html($_REQUEST[$campo_elemento_nome]);
		
		// converte para minusculo
		$valor_requeste = converte_minusculo($valor_requeste);
		
		// remove espaços
		$valor_requeste = trim($valor_requeste);
		
		// campos a serem atualizados
        $campos_atualizar .= $campo_tabela."=\"$valor_requeste\", ";
	    
		// campos adicionar em tabela
		$campos_adicionar .= "\"$valor_requeste\", ";
		
	};
	
};

// campos a serem atualizados
$campos_atualizar = substr($campos_atualizar, 0, -2);

// campos a serem adicionados
$campos_adicionar = substr($campos_adicionar, 0, -2);

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// query
$query[0] = "select *from $tabela_banco[12] where uid=\"$idusuario\";";
$query[1] = "update $tabela_banco[12] set $campos_atualizar where uid=\"$idusuario\";";
$query[2] = "insert into $tabela_banco[12] values($idusuario, $campos_adicionar);";

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

// salva todos os dados do usuario na sessao
atualiza_retorna_dados_usuario_sessao(true, true);

// atualiza a pagina
chama_pagina_url("$pagina_inicial?$variavel_campo[2]=25&$variavel_campo[6]=2");

};

?>