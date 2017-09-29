<?php

// atualiza as notificacoes via timer
function atualiza_notifica_timer(){

// globals
global $idioma_sistema;
global $url_link_acao;

// numero de novas mensagens
$numero_mensagens = retorne_numero_mensagens(5, retorne_idusuario_logado());

// numero total de notificacoes
$numero_total = retorne_numero_notifica(0) + $numero_mensagens;

// dados das notificacoes
$dados[0] = retorne_tamanho_resultado($numero_total);
$dados[1] = retorne_tamanho_resultado(retorne_numero_notifica(1));
$dados[2] = retorne_tamanho_resultado(retorne_numero_notifica(2));
$dados[3] = retorne_tamanho_resultado($numero_mensagens);
$dados[4] = retorne_tamanho_resultado(retorne_numero_novos_depoimentos(retorne_idusuario_logado()));
$dados[5] = retorne_tamanho_resultado(retorne_numero_solicitacoes_amizade(2));
$dados[6] = retorne_tamanho_resultado(retorne_numero_notifica(5));
$dados[7] = retorne_tamanho_resultado(retorne_numero_notifica(6));
$dados[8] = retorne_tamanho_resultado($numero_mensagens);
$dados[9] = $numero_total;

// adiciona links em dados
$dados[1] = "<a href='$url_link_acao[14]' title='$idioma_sistema[78]'>$idioma_sistema[78] - $dados[1]</a>";
$dados[2] = "<a href='$url_link_acao[15]' title='$idioma_sistema[279]'>$idioma_sistema[279] - $dados[2]</a>";
$dados[3] = "<a href='$url_link_acao[16]' title='$idioma_sistema[220]'>$idioma_sistema[220] - $dados[3]</a>";
$dados[4] = "<a href='$url_link_acao[17]' title='$idioma_sistema[180]'>$idioma_sistema[180] - $dados[4]</a>";
$dados[5] = "<a href='$url_link_acao[18]' title='$idioma_sistema[109]'>$idioma_sistema[109] - $dados[5]</a>";
$dados[6] = "<a href='$url_link_acao[19]' title='$idioma_sistema[293]'>$idioma_sistema[293] - $dados[6]</a>";
$dados[7] = "<a href='$url_link_acao[25]' title='$idioma_sistema[423]'>$idioma_sistema[423] - $dados[7]</a>";

// atualiza o array de retorno
$array_retorno["dados"] = $dados;

// retorno
return json_encode($array_retorno);

};

?>