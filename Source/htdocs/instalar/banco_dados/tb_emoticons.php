<?php

// array com emoticons
$array_arquivos_emoticons = plugin_listar_arquivos($pasta_root_sistema["pasta_emoticons_root"], $extensao_arquivo["png"], false);

// campos de tabela
$campos = constroe_campos_tabela_banco(CAMPO_TABELA_EMOTICON_CHAVE, CAMPO_TABELA_EMOTICON_CORPO);

// nome de tabela
$nome_tabela = $tabela_banco[16];

// query
$query = "select *from $nome_tabela;";

// dados de query
$dados_query = plugin_executa_query($query);

// valida novos emoticons
if($dados_query["linhas"] != count($array_arquivos_emoticons)){

    // query
    $query = "drop table $nome_tabela;";

    // exclui a tabela
    plugin_executa_query($query);

    // query
    $query = "create table if not exists $nome_tabela($campos);";

    // cria a tabela
    plugin_executa_query($query);

    // instala os emoticons
    foreach($array_arquivos_emoticons as $url_imagem){
	
	    // valida url de imagem
	    if($url_imagem != null){
		
	    	// obtendo a url da imagem no host
		    $url_imagem = basename($url_imagem);
		    $url_imagem = $pasta_host_sistema["pasta_emoticons_host"].$url_imagem;

		    // query
		    $query = "insert into $nome_tabela values(null, '$url_imagem');";
		
		    // cadastrando emoticon
		    plugin_executa_query($query);

	    };
	
    };

};

?>