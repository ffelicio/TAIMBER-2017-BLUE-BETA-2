<?php

// constroe recomendações de paginas
function carrega_recomendacoes_paginas(){

// globals
global $tabela_banco;
global $idioma_sistema;

// tabela
$tabela[0] = $tabela_banco[19];
$tabela[1] = $tabela_banco[22];

// limit
$limit = "limit 0, ".NUMERO_RECOMENDACOES_INICIO;

// dados de usuario logado
$dados = retorne_dados_perfil_usuario_logado();

// separando dados
$interesses = $dados[INTERESSES];

// valida interesses
if($interesses == null){
	
	// retorno
	return null;
	
};

// id de usuasrio logado
$uid = retorne_idusuario_logado();

// interesses
$interesses = explode(",", $interesses);

// contador de avanco
$contador = 0;

// analisando interesses
foreach($interesses as $interesse){
	
	// valida interesse
	if($interesse != null){
		
		// remove espaço em branco de interesse
		$interesse = trim($interesse);
		
		// valida contador
		if($contador > 0){
			
			// completa query
			$completa = "or";

		};
		
		// lista com querys
		$lista_query .= " $completa descricao_da_pagina like '%$interesse%' or titulo_da_pagina like '%$interesse%' ";
	
		// atualiza o contador
		$contador++;
	
	};
	
};

// query
$query = "select *from $tabela[1] where uidamigo='$uid';";

// contador de avanco
$contador = 0;

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// subcontador
$sub_contador = 0;

// construindo paginas
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separando dados
	$id = $dados["id"];
	$pagina = $dados[PAGINA];
	
	// valida id
	if($id != null){
		
		// valida subcontador
		if($sub_contador > 0){
			
			// completa query
			$completa = "and";
			
		}else{
			
			// completa query
			$completa = null;
			
		};
		
		// lista de query
		$lista_query_2 .= " $completa id!='$pagina'";
		
		// atualiza o subcontador
		$sub_contador++;

	};
	
};

// valida numero de linhas
if($linhas > 0){
	
	// lista de query
	$lista_query_2 = "and $lista_query_2";

};

// query
$query = "select *from $tabela[0] where ($lista_query) $lista_query_2 order by id desc $limit;";

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// valida o numero de linhas
if($linhas == 0){

	// retorno
	return null;
	
};

// contador
$contador = 0;

// construindo paginas
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// constroe a pagina em miniatura de sugestao
	$html .= constroe_pagina_miniatura_sugestao($dados);

};

// html
$html = "
<div class='classe_conteudo_recomendar_pagina'>
$html
</div>
";

// retorno
return $html;

};

?>