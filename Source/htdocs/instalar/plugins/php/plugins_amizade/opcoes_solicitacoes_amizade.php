<?php

// opcoes de solicitacoes de amizade
function opcoes_solicitacoes_amizade($id_campo_conteudo){

// globals
global $idioma_sistema;

// id de campo
$idcampo = codifica_md5("select_option_opcoes_solicitacoes_amizade_".data_atual());

// modo de solicitação
$modo_solicitacao = retorne_campo_formulario_request(14);

// numero de solicitacoes
$numero_solicitacoes[0] = retorne_tamanho_resultado(retorne_numero_solicitacoes_amizade(1));
$numero_solicitacoes[1] = retorne_tamanho_resultado(retorne_numero_solicitacoes_amizade(2));

// define valores de arrays
$array_options = "$idioma_sistema[123] - $numero_solicitacoes[0],$idioma_sistema[124] - $numero_solicitacoes[1]";
$array_valores = "1,2";

// html
$html = gerador_select_option_especial($array_options, $array_valores, $modo_solicitacao, null, $idcampo, "alterar_modo_opcoes_solicitacao(\"$idcampo\", \"$id_campo_conteudo\");");

// html
$html = "
<div class='classe_opcoes_solicitacoes_amizade'>
<div class='classe_opcoes_solicitacoes_amizade_titulo classe_cor_3'>$idioma_sistema[152]</div>
<div class='classe_opcoes_solicitacoes_amizade_campo_opcoes'>$html</div>
</div>
";

// retorno
return $html;

};

?>