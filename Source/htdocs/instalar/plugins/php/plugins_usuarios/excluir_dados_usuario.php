<?php

// exclui os dados de usuario
function excluir_dados_usuario(){

// globals
global $tabela_banco;

// id de usuario
$idusuario = retorne_idusuario_logado();

// listando as tabelas
foreach($tabela_banco as $tabela){

    // valida tabela
    if($tabela != null){
    
	    // querys
	    $query[0] = "delete from $tabela where uid='$idusuario';";
		$query[1] = "delete from $tabela where uidamigo='$idusuario';";
		
		// excluindo registros de tabela
		plugin_executa_query($query[0]);
		plugin_executa_query($query[1]);

	};
};

};

?>