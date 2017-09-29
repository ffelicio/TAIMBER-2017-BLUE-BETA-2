<?php

// adiciona o ativar usuario
function adicionar_ativar_usuario(){

// globals
global $tabela_banco;

// id de usuario logado
$uid = retorne_idusuario_logado();

// tabela
$tabela = $tabela_banco[30];

// data atual
$data_hoje = retorne_data_dia_mes_ano();

// chave
$chave = codifica_md5($uid.$data_hoje.retorne_contador_iteracao());

// querys
$query[0] = "delete from $tabela where uid='$uid';";
$query[1] = "insert into $tabela values(null, '$uid', '$chave', 0, '$data_hoje');";

// removendo dados antigos
plugin_roda_query($query[0]);

// adicionando dados novos
plugin_roda_query($query[1]);

};

?>