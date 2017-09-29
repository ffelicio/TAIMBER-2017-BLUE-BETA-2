<?php

// retorna o complemento da query para recomendar musicas
function retorne_completa_recomendar_musicas(){

// dados de usuario logado
$dados = retorne_dados_perfil_usuario_logado();

// separando dados
$musicas = $dados[MUSICAS];

// valida musicas
if($musicas == null){
	
	// retorno
	return null;
	
};

// musicas
$musicas = explode(",", $musicas);

// contador de avanco
$contador = 0;

// analisando musicas
foreach($musicas as $musica){
	
	// valida musica
	if($musica != null){
		
		// remove espaço em branco de musica
		$musica = trim($musica);
		
		// valida contador
		if($contador > 0){
			
			// completa query
			$completa = "or";

		};
		
		// lista com querys
		$lista_query .= " $completa titulo_musica like '%$musica%' ";
	
		// atualiza o contador
		$contador++;
	
	};
	
};

// retorno
return $lista_query;

};

?>