<?php

// retorna os dados compilados do usuario em forma de array
function retorne_dados_compilados_usuario($idusuario){

#>> para acessar os dados <<
#>> array_retorno[nome_tabela][campo_tabela]

// globals
global $tabela_banco;

// dados de usuario de todas as tabelas
$dados_usuario = retorne_dados_usuario($idusuario);

// contador
$contador = 0;

// compila todos os dados de todas as tabelas num unico array
foreach($tabela_banco as $tabela){
    
	// valida tabela
	if($tabela != null){
	    
		// nome de campo de tabela
		$nome_campo = $tabela_banco[$contador];
		
		// array associativo com dados de tabela
		$array_dados_tabela[$nome_campo] = $dados_usuario[$contador][0];
		
		// array com todos os dados
		$array_todos_dados[$nome_campo] = $dados_usuario[$contador];
		
		// seleciona qual tabela tera todos os dados
		switch($tabela){
		
			case $tabela_banco[4]: // imagens
			// array associativo com dados de tabela
			$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			
			case $tabela_banco[5]: // publicacoes
			// array associativo com dados de tabela
			$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			
			case $tabela_banco[6]: // amizades
			// array associativo com dados de tabela
			$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			
			case $tabela_banco[8]: // feeds
			// array associativo com dados de tabela
			$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			
			case $tabela_banco[10]: // usuarios bloqueados
			// array associativo com dados de tabela
			$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			
			case $tabela_banco[11]: // usuarios visitados
			// array associativo com dados de tabela
			$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			
			case $tabela_banco[13]: // depoimentos de usuarios
			// array associativo com dados de tabela
			$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			
			case $tabela_banco[16]: // tabela de emoticons
			// array associativo com dados de tabela
			$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;

			case $tabela_banco[18]: // tabela de paginas
			// array associativo com dados de tabela
			$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			
			case $tabela_banco[19]: // tabela de perfil de paginas
			// array associativo com dados de tabela
			$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			
			case $tabela_banco[20]: // tabela de imagem de perfil de pagina
			// array associativo com dados de tabela
			$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			
			case $tabela_banco[21]: // tabela imagem de capa de pagina
			// array associativo com dados de tabela
			$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			
			case $tabela_banco[22]: // tabela paginas inscritas
			// array associativo com dados de tabela
			$array_dados_tabela[$nome_campo] = $array_todos_dados[$nome_campo];
			break;
			
		};

		// atualiza o contador
		$contador++;
		
	};
	
};

// seta os dados padrao, em caso de nao houver
$array_dados_tabela = seta_dados_compilados_padrao($array_dados_tabela);

// retorna um array com todas as informacoes de todas as tabela
return $array_dados_tabela;

};

?>