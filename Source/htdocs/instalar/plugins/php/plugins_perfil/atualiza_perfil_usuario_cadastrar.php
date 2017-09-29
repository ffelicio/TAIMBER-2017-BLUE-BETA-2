<?php

// atualiza o perfil do usuario ao se cadastrar
function atualiza_perfil_usuario_cadastrar($dados){

// globals
global $tabela_banco;
global $variavel_campo;

// array com campos de tabelas
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_CORPO);

// contador
$contador = 0;

// obtendo valores
foreach($array_campos_tabela as $campo_tabela){
	
	// valida campo de tabela
	if($campo_tabela != null){

		// valor de campo
		$valor_campo = $dados[$contador + 1];
	    
		// remove as entidades html
		$valor_campo = html_entity_decode($valor_campo);
		
		// campos adicionar em tabela
		$campos_adicionar .= "\"$valor_campo\", ";

		// atualiza o contador
		$contador++;
	
	};
	
};

// id de usuario
$idusuario = $dados[0];

// campos a serem adicionados
$campos_adicionar = substr($campos_adicionar, 0, -2);

// query
$query = "insert into $tabela_banco[1] values($idusuario, $campos_adicionar);";

// define o perfil basico do usuario
plugin_executa_query($query);

};

?>