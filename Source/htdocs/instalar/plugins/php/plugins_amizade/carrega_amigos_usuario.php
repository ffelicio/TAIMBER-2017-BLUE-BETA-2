<?php

// carrega os amigos do usuario
function carrega_amigos_usuario($modo_chat, $modo_jason){

// globals
global $idioma_sistema;
global $tabela_banco;

// tabela
$tabela = $tabela_banco[6];

// tipo de acao
$tipo_acao = retorne_campo_formulario_request(2);

// dados de pesquisa
$nome_pesquisa = converte_minusculo(retorne_campo_formulario_request(7));

// valida nome de pesquisa
if($nome_pesquisa == null){
	
	// parametro de pesquisa
	$parametro_pesquisa = retorne_campo_formulario_request(54);

};

// este conteudo serve para comparar se vai zerar o contador de avanço ou não
$conteudo_compara_zera_contador = $parametro_pesquisa.$nome_pesquisa;

// valida o tipo de acao
if($tipo_acao == 104){
	
	// tipo de acao padrao
	$tipo_acao = 14;
	
};

// valida o modo chat
if($modo_chat == null){
	
    // modo chat
    $modo_chat = retorne_campo_formulario_request(24);

};

// valida o modo de chat
if($modo_chat == 1){
	
	// id de usuario logado
	$uid = retorne_idusuario_logado();
	
}else{
	
	// id de usuario
	$uid = retorne_idusuario_request();

};

// erradica as atualizacoes de amizades do usuário
erradicar_atualizacoes_amizades_usuario($uid);

// valida o parametro de pesquisa
if($parametro_pesquisa != null){
	
	// dados do perfil do usuario
	$dados_perfil = retorne_dados_perfil_usuario($uid);

};

// valida se zera o contador
if(retorne_zerar_contador_avanco_pesq_amigo_local($conteudo_compara_zera_contador) == true){

	// limpar dados antigos
	$limpar_dados_antigos = 1;
	
	// zera o contador de limit de query
	retorne_limit_query_iniciar(true, $tipo_acao);
	
	// limit de query
	$limit_query = retorne_limit_query_iniciar(false, $tipo_acao);

}else{
	
	// limpar dados antigos
	$limpar_dados_antigos = 0;

	// limit de query
	$limit_query = retorne_limit_query_iniciar(false, $tipo_acao);

};

// validando o parametro de pesquisa
switch($parametro_pesquisa){

	case 0: // estuda
	$campo_tabela = "estuda";
	$valor_tabela = $dados_perfil["$campo_tabela"];
	$query = "select *from $tabela where uid='$uid' and $campo_tabela like '%$valor_tabela%' order by id desc $limit_query;";
	break;

	case 1: // trabalha
	$campo_tabela = "trabalha";
	$valor_tabela = $dados_perfil["$campo_tabela"];
	$query = "select *from $tabela where uid='$uid' and $campo_tabela like '%$valor_tabela%' order by id desc $limit_query;";
	break;

	case 2: // cidade
	$campo_tabela = "cidade";
	$valor_tabela = $dados_perfil["$campo_tabela"];
	$query = "select *from $tabela where uid='$uid' and $campo_tabela like '%$valor_tabela%' order by id desc $limit_query;";
	break;

	case 3: // mulher
	$campo_tabela = "sexo";
	$valor_tabela = 2;
	$query = "select *from $tabela where uid='$uid' and $campo_tabela='$valor_tabela' order by id desc $limit_query;";
	break;

	case 4: // homem
	$campo_tabela = "sexo";
	$valor_tabela = 1;
	$query = "select *from $tabela where uid='$uid' and $campo_tabela='$valor_tabela' order by id desc $limit_query;";
	break;

};

// valida parametro
if(is_numeric($parametro_pesquisa) == false){
	
	// valida o nome da pesquisa
	if($nome_pesquisa == null){
		
		// query
		$query = "select *from $tabela where uid='$uid' order by id desc $limit_query;";
		
	}else{
		
		// query
		$query = "select *from $tabela where uid='$uid' and (nome like '%$nome_pesquisa%' or sobrenome like '%$nome_pesquisa%') order by id desc $limit_query;";
		
	};
	
};

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// contador
$contador = 0;

// id de usuario logado
#manter esta linha aqui! e do jeito que está!
$idusuario_logado = retorne_idusuario_logado();

// extraindo amigos de usuario
for($contador == $contador; $contador <= $linhas; $contador++){

	// dados de array de amigos
	$dados = $dados_query["dados"][$contador];

	// valida idusuario igual o id de usuario logado
	if($modo_chat == 1){
		
		// id de usuario amigo
		$idusuario = retorne_idamigo_dados_amigo(true, $dados, $idusuario_logado);

	}else{
		
		// id de usuario amigo
		$idusuario = retorne_idamigo_dados_amigo(true, $dados, $uid);

	};

	// valida id de usuario
	if($idusuario != null){

		// nome do usuario
		$nome_usuario = converte_minusculo(retorne_nome_usuario(true, $idusuario));

		// valida o modo de chat
		if($modo_chat == 1){
			
			// imagem de perfil de usuario modo chat
			$imagem_perfil_usuario = constroe_imagem_perfil_miniatura(true, false, $idusuario);
			
			// classe
			$classe[0] = "classe_div_separa_amigo_visualizar_perfil_chat";
			
		}else{
			
			// imagem de perfil de usuario
			$imagem_perfil_usuario = constroe_imagem_perfil_medio($idusuario);
			
			// classe
			$classe[0] = "classe_div_separa_amigo_medio_visualizar_perfil classe_cor_2";
			
		};
		
		// perfil basico de usuario
		$perfil_basico_usuario = "

		<div class='$classe[0]'>
		$imagem_perfil_usuario
		</div>

		";

		// html
		$html .= $perfil_basico_usuario;
	
	};

};

// valida modo de retorno json
if($modo_jason == true){
	
    // array de retorno
    $array_retorno["dados"] = $html;
    $array_retorno["limpar_dados_antigos"] = $limpar_dados_antigos;

    // retorno
    return json_encode($array_retorno);

}else{
	
	// retorno
	return $html;
	
};

};

?>