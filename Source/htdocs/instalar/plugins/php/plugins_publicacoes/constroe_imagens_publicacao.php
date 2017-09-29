<?php

// constroe as imagens de publicacoes
function constroe_imagens_publicacao($chave, $modo, $uid){

// globals
global $tabela_banco;
global $idioma_sistema;

// tabela
$tabela = $tabela_banco[4];

// query
$query = "select *from $tabela where uid='$uid' and chave='$chave' order by id desc;";

// dados de query
$dados_query = plugin_executa_query($query);

// numero de linhas
$linhas = $dados_query["linhas"];

// valida o numero de linhas
if($linhas == 0){
	
	// retorno
	return null;
	
};

// contador
$contador[0] = 0;
$contador[1] = 0;

// valida o modo
switch($modo){
	
	case 0:
	// classe
	$classe[0] = "classe_separa_imagem_publicacao_previsualiza";
	break;
	
	case 1:
	if($linhas > 1){
		
		// classe
		$classe[0] = "classe_separa_imagem_publicacao";
	
	}else{
		
		// classe
		$classe[0] = "classe_separa_imagem_publicacao_unica";

	};
	break;

};

// construindo imagens
for($contador[0] == $contador[0]; $contador[0] <= $linhas; $contador[0]++){

	// dados
	$dados = $dados_query["dados"][$contador[0]];
	
	// listando dados
    $id = $dados["id"];
	
	// valida chave
	if($id != null){

		// constroe a imagem de album por dados
		$html = constroe_imagem_album_dados($dados, $modo, null);

		// valida numero de imagens
		if($linhas == 1){
			
			// atualiza o bloco
			$bloco[0][$contador[0]] = $html;

		}else{
			
			// valida o contador e define a classe
			switch($contador[1]){
				
				case 0:
				
				// atualiza o bloco
				$bloco[0][$contador[0]] = $html;
			
				// atualiza o contador
				$contador[1]++;
				
				break;
				
				case 1:
				
				// atualiza o bloco
				$bloco[1][$contador[0]] = $html;
				
				// atualiza o contador
				$contador[1] = 0;
				
				break;

			};

		};

	};
	
};

// html
$html = null;
	
// valida numero de linhas e constroe imagens
if($linhas == 1){
	
	// construindo imagens
	foreach($bloco[0] as $campo){
		
		// html
		$html[0] .= $campo;
	
	};
	
}else{

	// construindo imagens
	foreach($bloco[0] as $campo){
		
		// html
		$html[0] .= $campo;
	
	};

	// construindo imagens
	foreach($bloco[1] as $campo){
		
		// html
		$html[1] .= $campo;
	
	};	

};

// valida o modo
switch($modo){
	
	case 0:
	// html
	$html = "
	<div class='$classe[0]'>
	$html[0]
	$html[1]
	</div>
	";	
	break;
	
	case 1:
	// html
	$html = "
	<div class='$classe[0]'>$html[0]</div>
	<div class='$classe[0]'>$html[1]</div>
	";	
	break;

};

// retorno
return $html;

};

?>