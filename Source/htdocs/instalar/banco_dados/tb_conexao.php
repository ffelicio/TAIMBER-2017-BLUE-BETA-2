<?php

// campos de tabela
$campos = constroe_campos_tabela_banco(CAMPO_TABELA_CONEXAO_CHAVE, CAMPO_TABELA_CONEXAO_CORPO);

// nome de tabela
$nome_tabela = $tabela_banco[17];

// query
$query = "create table if not exists $nome_tabela($campos);";

// cria a tabela
plugin_executa_query($query);

?>