<?php

// carrega os emoticons
function carregar_emoticons(){

// globals
global $idioma_sistema;
global $tabela_banco;

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// array com dados de emoticons
$array_dados_emoticons = $dados_compilados_usuario[$tabela_banco[16]];

// classes
$classe[0] = "classe_emoticon_lista";

// inverte a ordem de array de emoticons
$array_dados_emoticons = inverte_array($array_dados_emoticons);

// contador de avanco
$contador = contador_avanco(retorne_campo_formulario_request(2), 3) + 1;

// contador final
$contador_final = contador_avanco(retorne_campo_formulario_request(2), 5);

// entrada de campo que recebe codigo de emoticon
$idcampo_entrada_emoticon = retorne_campo_formulario_request(23);

// carregando emoticons
for($contador == $contador; $contador <= $contador_final; $contador++){

    // dados
    $dados = $array_dados_emoticons[$contador];

    // separa os dados
    $id = $dados["id"];
    $url = $dados[URL];
    $codigo_conversao = $dados["codigo_conversao"];

    // valida id
    if($id != null){

        // eventos
        $evento[0] = "onclick='adicionar_emoticon_campo(\"$url\", \"$idcampo_entrada_emoticon\");'";

        // lista com emoticons
        $lista_emoticons .= "
        <div class='$classe[0]' $evento[0]>
        <img src='$url' title='$codigo_conversao' alt='$codigo_conversao'>
        </div>
        ";
    
    };

};

// array de retorno
$array_retorno["dados"] = $lista_emoticons;

// retorno
return json_encode($array_retorno);

};

?>