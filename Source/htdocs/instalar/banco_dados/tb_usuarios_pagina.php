<?php

// campos de tabela
$campos = constroe_campos_tabela_banco(CAMPO_USUARIOS_PAGINA_CHAVE, CAMPO_USUARIOS_PAGINA_CORPO);

// nome de tabela
$nome_tabela = $tabela_banco[22];

// query
$query = "create table if not exists $nome_tabela($campos);";

// cria a tabela
plugin_executa_query($query);

?>