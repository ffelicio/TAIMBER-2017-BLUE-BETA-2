<?php

// campos de tabela
$campos = constroe_campos_tabela_banco(CAMPO_TABELA_AMIZADE_CHAVE, CAMPO_TABELA_AMIZADE_CORPO);

// nome de tabela
$nome_tabela = $tabela_banco[6];

// query
$query = "create table if not exists $nome_tabela($campos);";

// cria a tabela
plugin_executa_query($query);

?>