<?php

// carrega os depoimentos
function carregar_depoimentos(){

// globals
global $tabela_banco;
global $idioma_sistema;

// modos
$modo = retorne_campo_formulario_request(6);
$modo_limpa_contador = retorne_campo_formulario_request(20);

// id de usuario
$idusuario = retorne_idusuario_request();

// nome de usuario
$nome_usuario = retorne_nome_usuario_logado();

// nome de amigo
$nome_amigo = retorne_nome_usuario(true, $idusuario);

// usuario dono do perfil
$usuario_dono = retorne_usuario_dono_perfil($idusuario);

// valida desabilitou depoimentos
if(retorna_configuracao_privacidade(8, $idusuario) == true){
	
    // valida usuario dono do perfil
	if($usuario_dono == true){
		
		// array com retorno
		$array_retorno["dados"] = constroe_caixa(false, $nome_usuario.$idioma_sistema[185]);
		
		// retorno
		return json_encode($array_retorno);
		
	}else{

		// array com retorno
		$array_retorno["dados"] = constroe_caixa(false, $nome_amigo.$idioma_sistema[186]);
		
		// retorno
		return json_encode($array_retorno);
		
	};

};

// valida usuario dono do perfil, ou se e amigo
if(retorne_usuario_amigo($idusuario) == false and $usuario_dono == false){
	
	// array com retorno
	$array_retorno["dados"] = constroe_caixa(false, $nome_usuario.$idioma_sistema[194].$nome_amigo.$idioma_sistema[163]);

	// retorno
	return json_encode($array_retorno);
	
};

// tabela
$tabela = $tabela_banco[13];

// valida trocou de modo
if($modo == null or $modo_limpa_contador == 1){

    // zera o contador
    $zerar_contador = true;
	
    // informa se zerou o contador
    $array_retorno["zerou_contador"] = 1;
   
    // zera o contador de avanco
    $contador_avanco = contador_avanco(retorne_tipo_acao_pagina(), 2);

}else{

    // nao zera o contador
    $zerar_contador = false;

    // informa se zerou o contador
    $array_retorno["zerou_contador"] = 0;
	
    // contador de avanco
    $contador_avanco = contador_avanco(retorne_tipo_acao_pagina(), 1);

};

// zera o contador
$limit_query = "limit $contador_avanco, ".NUMERO_VALOR_PAGINACAO;

// valida usuario dono do perfil
if($usuario_dono == true){

    // query - dono do perfil
    $query[0] = "select *from $tabela where uidamigo='$idusuario' order by aceito asc, id desc $limit_query;";
    $query[1] = "select *from $tabela where uid='$idusuario' order by aceito asc, id desc $limit_query;";

}else{

    // query - usuarios comuns
    $query[0] = "select *from $tabela where uidamigo='$idusuario' and aceito='1' order by id desc $limit_query;";
    $query[1] = "select *from $tabela where uid='$idusuario' and aceito='1' order by id desc $limit_query;";

};

// valida o modo
switch($modo){

    case 1:
    $query_executa = plugin_executa_query($query[0]);
    break;

    case 2:
    $query_executa = plugin_executa_query($query[1]);
    break;
	
	default:
	// valida usuario dono do perfil
	if($usuario_dono == true){
		
		// carrega os comentarios que o usuario fez
        $query_executa = plugin_executa_query($query[0]);	
	
	}else{
		
		// carrega os comentarios que o usuario recebeu
		$query_executa = plugin_executa_query($query[1]);
		
	};
	
};

// separa dados
$dados = $query_executa["dados"];
$linhas = $query_executa["linhas"];

// contador
$contador = 0;

// varrendo dados
for($contador == $contador; $contador <= $linhas; $contador++){
	
	// obtendo dados de array
	$dados_array = $dados[$contador];
	
	// separa os dados
	$array_retorno["dados"] .= constroe_depoimento($dados_array, $modo, $usuario_dono);
	
};

// retorno
return json_encode($array_retorno);

};

?>