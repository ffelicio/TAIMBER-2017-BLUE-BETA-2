<?php

// carrega os comentarios
function carregar_comentarios(){

// globals
global $tabela_banco;
global $idioma_sistema;

// id
$id = retorne_campo_formulario_request(4);

// comentario
$comentario = retorne_campo_formulario_request(9);

// tabela
$tabela = retorne_tabela_comentario(retorne_campo_formulario_request(10));

// id de elemento
$elemento_id = retorne_campo_formulario_request(12);

// valida usuario logado
if(retorne_usuario_logado() == false or $tabela == null){

    // retorno nulo
    return null;
	
};

// contador final
$contador_final = contador_avanco_comentario(retorne_campo_formulario_request(2), 1, $id, $elemento_id) - NUMERO_VALOR_PAGINACAO;

// limit de query
$limit_query = "limit $contador_final, ".NUMERO_VALOR_PAGINACAO;

// retrocede o contador final para calcular quantos ainda faltam
$contador_final += NUMERO_VALOR_PAGINACAO;

// separa dados de query
$numero_comentarios = retorne_numero_comentarios(retorne_campo_formulario_request(10), $id);

// query
$query[0] = "select *from $tabela_banco[7] where id_post='$id' and tabela_comentario='$tabela' order by id desc $limit_query;";
$query[1] = "select *from $tabela_banco[7] where id_post='$id' and tabela_comentario='$tabela' limit $contador_final, $numero_comentarios;";

// array dados de query
$dados_query[0] = plugin_executa_query($query[0]);
$dados_query[1] = plugin_executa_query($query[1]);

// separa os dados
$linhas[0] = $dados_query[0]["linhas"];
$linhas[1] = $dados_query[1]["linhas"];

// contador
$contador = 0;

// construindo dados
for($contador == $contador; $contador <= $linhas[0]; $contador++){
	
	// dados de comentario
	$dados = $dados_query[0]["dados"][$contador];
	
	// constroe o comentario
	$lista_comentarios .= constroe_comentario($dados);
	
};

// valida o numero de linhas
$array_retorno["dados"] = $lista_comentarios;

// array de retorno
$array_retorno["linhas"] = $linhas[0];

// nome de usuario logado
$nome_usuario = retorne_nome_usuario_logado();

// valida numero de linhas total
if($linhas[1] > 1){
	
	// tamanho de resultado
	$linhas[1] = retorne_tamanho_resultado($linhas[1]);
	
	// campo numero de resultados
    $campo_numero_resultados = "
    $nome_usuario$idioma_sistema[83]$linhas[1]$idioma_sistema[84]
    ";

}else{
	
	// campo numero de resultados
    $campo_numero_resultados = "
    $nome_usuario$idioma_sistema[85]$linhas[1]$idioma_sistema[86]
	";
	
};

// valida numero de linhas total
if($linhas[1] == 0){
	
	// campo numero de resultados
	$campo_numero_resultados = $nome_usuario.$idioma_sistema[82];
	
};

// array de retorno
$array_retorno["linhas_faltam"] = $campo_numero_resultados;

// retorno
return json_encode($array_retorno);

};

?>