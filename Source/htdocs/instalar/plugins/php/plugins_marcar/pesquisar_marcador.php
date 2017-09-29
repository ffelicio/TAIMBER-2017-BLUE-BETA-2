<?php

// pesquisa por maracador
function pesquisar_marcador(){

// globals
global $tabela_banco;
global $idioma_sistema;

// nome de pesquisa
$nome_pesquisa = retorne_campo_formulario_request(7);

// chave
$chave = retorne_campo_formulario_request(3);

// valida nome de pesquisa
if($nome_pesquisa == null){

    // retorno nulo	
    return null;
	
};

// tabelas
$tabela[0] = $tabela_banco[6]; // amizades
$tabela[1] = $tabela_banco[1]; // perfil

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// remove espacos
$nome_pesquisa = trim($nome_pesquisa);

// identificador de sessao
$identificador_sessao = SESSAO_TERMO_PESQUISA_MARCADOR.retorna_chave_request();
$identificador_sessao_numero = SESSAO_PESQUISA_MARCADOR_NUMERO_ENCONTROU.retorna_chave_request();

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// valida sessao
if($_SESSION[$identificador_sessao] != $nome_pesquisa){
	
	// atualiza a sessao
	$_SESSION[$identificador_sessao] = $nome_pesquisa;

	// zera o contador
	contador_avanco(retorne_campo_formulario_request(2), 2);
	
	// zera o numero de nome de usuarios encontradas
	$_SESSION[$identificador_sessao_numero] = 0;
	
	// zerou contador
	$zerou_contador = 1;
	
}else{
	
	// nao zerou contador
	$zerou_contador = -1;
	
};

// valida zerar numero sessao nome de usuarios encontradas
if(contador_avanco(retorne_campo_formulario_request(2), 3) == 0){

	// zera o numero de nome de usuarios encontradas
	$_SESSION[$identificador_sessao_numero] = 0;	
	
};

// limit de query
$limit = retorne_limit_query_iniciar(false, null);

// valida nome de pesquisa
if($nome_pesquisa == null){
	
	// query
	$query = "select *from $tabela[0] where uid='$idusuario' and aceito='1' $limit;";

}else{
	
	// query
	$query = "select *from $tabela[0] where (nome like '%$nome_pesquisa%' or sobrenome like '%$nome_pesquisa%') and uid='$idusuario' and aceito='1' $limit;";
	
};

// dados de query
$dados_query = plugin_executa_query($query);

// linhas
$linhas = $dados_query["linhas"];

// contador
$contador = 0;

// obtendo id de amigo de usuario logado
for($contador == $contador; $contador <= $linhas; $contador++){

	// dados
	$dados = $dados_query["dados"][$contador];

    // uidamigo de usuario logado
    $uidamigo = $dados[UIDAMIGO];

	// valida uidamigo
	if($uidamigo != null){
		
		// atualiza retorno
		$html .= constroe_uidamigo_marcado($uidamigo, $chave);

	};

};

// atualiza array de retorno
$array_retorno["dados"] = $html;
$array_retorno["zerou_contador"] = $zerou_contador;

// retorno
return json_encode($array_retorno);

};

?>