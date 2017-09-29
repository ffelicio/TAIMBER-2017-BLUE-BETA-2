<?php

// pesquisa geral
function pesquisa_geral(){

// globals
global $idioma_sistema;
global $tabela_banco;

// nome de pesquisa
$nome_pesquisa[0] = converte_minusculo(retorne_campo_formulario_request(7));

// cidade de pesquisa
$cidade = converte_minusculo(retorne_campo_formulario_request(50));

// modo de pesquisa
$modo_pesquisa = trata_campo_tabela(converte_minusculo(retorne_campo_formulario_request(8)), false);

// tipo de acao
$tipo_acao = retorne_campo_formulario_request(2);

// modo limpa o contador
$modo_limpa_contador = retorne_campo_formulario_request(20);

// modo usuarios
$modo_usuarios = retorne_campo_formulario_request(51);

// array com modos
$array_modo[0] = explode(",", CAMPO_TABELA_PERFIL_CAMPOS_3);
$array_modo[1] = explode(",", CAMPO_TABELA_PERFIL_CAMPOS);

// valida modo pagina
if($modo_pesquisa == converte_minusculo($array_modo[0][0])){
	
	// modo pagina
	$modo_pagina = true;
	
}else{
	
	// modo pesquisa comum
	$modo_pagina = false;
	
};

// valida nome de pesquisa
if($nome_pesquisa[0] == null){

	// array de dados
	$array_retorno["dados"] = null;
	
	// retorno nulo
	return json_encode($array_retorno);

};

// valida modo de pesquisa
if($modo_pesquisa == null){
	
	// pesquisa por nome de usuário
	$modo_pesquisa = $array_modo[1][0];
	
	// sobrenome a ser pesquisado
	$sobrenome_pesquisa = $array_modo[1][1];
	
};

// valida o modo da pesquisa
switch(converte_campo_perfil_numero_texto($modo_pesquisa)){

	case 2:
	
		// valida se o nome de pesquisa já é numérico
		if(is_numeric($nome_pesquisa[0]) == false){
			
			// pega o número do item da pesquisa
			$nome_pesquisa[0] = retorne_modo_sexo_usuario($nome_pesquisa[0]);

		};
	
	break;

};

// valida se zera o contador
if($modo_limpa_contador == true){

	// limit de query
	$limit_query = retorne_limit_query($tipo_acao, true);
	
	// limpar dados antigos
	$limpar_dados_antigos = 1;
	
}else{
	
	// limit de query
	$limit_query = retorne_limit_query($tipo_acao, false);
	
	// limpar dados antigos
	$limpar_dados_antigos = 0;

};

// valida cidade de pesquisa
if($cidade != null){
	
	// completa query
	$completa_query[0] = "and cidade like '%$cidade%'";
	
};

// valida modo pagina
if($modo_pagina == true){
	
	// query
	$query = "select *from $tabela_banco[19] where titulo_da_pagina like '%$nome_pesquisa[0]%' order by id desc $limit_query;";

}else{
	
	// valida se vai pesquisar o sobrenome
	if($sobrenome_pesquisa == null){
		
		// query
		$query = "select *from $tabela_banco[1] where $modo_pesquisa like '%$nome_pesquisa[0]%' $completa_query[0] order by uid desc $limit_query;";

	}else{
		
		// query
		$query = "select *from $tabela_banco[1] where $modo_pesquisa like '%$nome_pesquisa[0]%' or $sobrenome_pesquisa like '%$nome_pesquisa[0]%' $completa_query[0] order by uid desc $limit_query;";

	};
	
};

// valida se esta pesquisando por e-mail
if(verifica_se_email_valido($nome_pesquisa[0]) == true){
	
	// query
	$query = "select *from $tabela_banco[0] where e_mail like '%$nome_pesquisa[0]%' $completa_query[0] order by uid desc $limit_query;";	
	
};

// array com dados
$array_dados = plugin_executa_query($query);

// separa dados
$numero_linhas = $array_dados["linhas"];
$array_dados_usuario = $array_dados["dados"];

// contador de avanco
$contador = 0;

// construindo usuarios
for($contador == $contador; $contador <= $numero_linhas; $contador++){

	// dados
	$dados = $array_dados["dados"][$contador];
   
    // separa os dados de cada usuario
    $uid = $array_dados_usuario[$contador][UID];	
 
	// valida modo pagina
	if($modo_pagina == true){
	
		// valida o id da pagina
		if($dados["id"] != null){
			
			// html
			$html .= constroe_pagina_miniatura($dados, $dados, true, true);
			
		};
	
	}else{
		
		// valida uid de usuario
		if($uid != null){
			
			// valida o modo de usuario
			if($modo_usuarios == true){

				// imagem de perfil de usuario
				$imagem_perfil_usuario = constroe_imagem_perfil_miniatura_pesquisa($uid);

			}else{
				
				// imagem de perfil de usuario
				$imagem_perfil_usuario = constroe_imagem_perfil_medio($uid);

			};

			// html
			$html .= "
			<div class='classe_div_separa_amigo_visualizar_perfil_chat classe_cor_2'>
			$imagem_perfil_usuario
			</div>
			";

		};		
		
	};

};

// array de retorno
$array_retorno["dados"] = $html;
$array_retorno["limpar_dados_antigos"] = $limpar_dados_antigos;

// retorno
return json_encode($array_retorno);

};

?>