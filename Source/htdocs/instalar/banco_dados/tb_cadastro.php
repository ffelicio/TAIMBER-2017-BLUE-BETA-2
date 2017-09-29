<?php

// campos de tabela
$campos = constroe_campos_tabela_banco(CAMPO_TABELA_CADASTRO_CHAVE, CAMPO_TABELA_CADASTRO_CORPO);

// nome de tabela
$nome_tabela = $tabela_banco[0];

// query
$query = "create table if not exists $nome_tabela($campos);";

// cria a tabela
plugin_executa_query($query);

?>