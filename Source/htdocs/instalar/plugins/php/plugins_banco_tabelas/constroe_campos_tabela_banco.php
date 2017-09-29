<?php

// constroe campos de tabela de banco de dados
function constroe_campos_tabela_banco($chave, $corpo){

// valida campos
if($chave == null or $corpo == null){

    // retorno nulo
    return null;
	
};

// cria array com campos de tabelas
$campos_tabela = explode(",", $corpo);

// lista campos de tabelas
foreach($campos_tabela as $campo){

	// valida campo de tabela
	if($campo != null){

		// atualiza campos encontrados
		$campos_encontrados .= trata_campo_tabela($campo, true);

	};

};

// gera string de tabela
return $chave.substr($campos_encontrados,0, -2);

};

?>