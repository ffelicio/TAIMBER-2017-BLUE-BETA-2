<?php

// retorna a query de pesquisa de noticias
function retorne_query_pesquisa_noticias($limit_query){

// globals
global $tabela_banco;

// tabela
$tabela = $tabela_banco[35];

// id de usuario logado
$uid = retorne_idusuario_logado();

// nome de pesquisa
$nome_pesquisa = retorne_campo_formulario_request(7);

// valida nome de pesquisa
if($nome_pesquisa != null){
	
	// completa query
	$completa_query[0] = " and (titulo like '%$nome_pesquisa%' or descricao like '%$nome_pesquisa%')";
	$completa_query[1] = "where titulo like '%$nome_pesquisa%' or descricao like '%$nome_pesquisa%'";

};

// valida usuario logado
if(retorne_usuario_logado() == true){
	
	// query
	$query = "select *from $tabela where uid='$uid' $completa_query[0] order by id desc $limit_query;";

}else{
	
	// valida sessao
	if($_SESSION[SESSAO_UID_PESQUISA_NOTICIAS_DESLOGADO] == null){
		
		// query
		$query = "select *from $tabela $completa_query[1] order by id desc $limit_query;";
		
		// dados
		$dados_query = plugin_executa_query($query);

		// linhas
		$linhas = $dados_query["linhas"];
		
		// contador
		$contador = 0;
		
		// procurando primeiro uid
		for($contador == $contador; $contador <= $linhas; $contador++){
			
			// retorno
			$dados = $dados_query["dados"][$contador];
			
			// uid
			$uid = $dados[UID];
			
			// valid uid
			if($uid != null){
				
				// atualizando sessao
				$_SESSION[SESSAO_UID_PESQUISA_NOTICIAS_DESLOGADO] = $uid;
				
				// saindo
				break;
				
			};

		};
	
	}else{
		
		// pegando uid de sessao
		$uid = $_SESSION[SESSAO_UID_PESQUISA_NOTICIAS_DESLOGADO];

	};
	
	// query
	$query = "select *from $tabela where uid='$uid' $completa_query[0] order by id desc $limit_query;";

};

// retorno
return $query;

};

?>