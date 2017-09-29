<?php

// array com lista de arquivos
$array_arquivos_css = plugin_listar_arquivos($pasta_root_sistema["plugins_paginas_css"], $extensao_arquivo["css"], false);
$array_arquivos_js = plugin_listar_arquivos($pasta_root_sistema["plugins_paginas_js"], $extensao_arquivo["js"], false);
$array_arquivos_php = plugin_listar_arquivos($pasta_root_sistema["plugins_paginas_php"], $extensao_arquivo["php"], true);

// limpa compilacao antiga
$conteudo_plugins[0] = null;
$conteudo_plugins[1] = null;
$conteudo_plugins[2] = null;

// obtem conteudo de arquivos css
foreach($array_arquivos_css as $endereco_arquivo){
	
	// valida endereco valido
	if($endereco_arquivo != null){
	    
		// conteudo de plugins
		$conteudo_arquivo[0] = ler_conteudo_arquivo($endereco_arquivo);
		
		// atualiza o array de conteudo de arquivo
		$conteudo_plugins[0] .= $conteudo_arquivo[0];
		
	};
	
};

// obtem conteudo de arquivos js
foreach($array_arquivos_js as $endereco_arquivo){
	
	// valida endereco valido
	if($endereco_arquivo != null){
	    
		// conteudo de plugins
		$conteudo_arquivo[1] = ler_conteudo_arquivo($endereco_arquivo);
		
		// atualiza o array de conteudo de arquivo
		$conteudo_plugins[1] .= $conteudo_arquivo[1];
		
	};
	
};

// obtem conteudo de arquivos php
foreach($array_arquivos_php as $endereco_arquivo){
	
	// valida endereco valido
	if($endereco_arquivo != null){
	    
		// conteudo de plugins
		$conteudo_arquivo[2] = ler_conteudo_arquivo($endereco_arquivo);
		$conteudo_arquivo[2] = str_ireplace("<?php", null, $conteudo_arquivo[2]);
		$conteudo_arquivo[2] = str_ireplace("?>", null, $conteudo_arquivo[2]);
		
		// atualiza o array de conteudo de arquivo
		$conteudo_plugins[2] .= $conteudo_arquivo[2];
		
	};
	
};

// adiciona inicio de tag php
$conteudo_plugins[2] = remove_comentarios_conteudo_arquivo("
<?php
$conteudo_plugins[2]
?>
");

// salva arquivos de dependencia
salvar_arquivo($arquivo_sistema_root["paginas_css"], $conteudo_plugins[0]);
salvar_arquivo($arquivo_sistema_root["paginas_js"], $conteudo_plugins[1]);
salvar_arquivo($arquivo_sistema_root["paginas_php"], $conteudo_plugins[2]);

?>