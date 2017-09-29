<?php

// retorna o texto de relacionamento
function retorne_texto_relacionamento($uid){

// globals
global $idioma_sistema;

// nome de usuario
$nome_usuario = retorne_nome_usuario(true, $uid);

// imagem de sistema
$imagem_sistema[0] = retorne_imagem_sistema(101, null, false);

// dados do perfil do usuario
$dados_perfil = retorne_dados_perfil_usuario($uid);

// separando dados
$relacionamento = $dados_perfil[RELACIONAMENTO];
$idusuario = $dados_perfil[UID];

// valida relacionamento
if($relacionamento == null){
	
	// html
	$html = "
	<div class='classe_atencao_relacionamento'>

	<div class='classe_atencao_relacionamento_imagem'>
	$imagem_sistema[0]
	</div>

	<div class='classe_atencao_relacionamento_texto span_link_3'>
	$nome_usuario$idioma_sistema[563]
	</div>

	</div>
	";

	// retorno
	return $html;
	
};

// sexo de usuario
$sexo_usuario = retorne_sexo_idusuario($uid);

// valida sexo de usuario
if($sexo_usuario == false){
	
	// texto
	$texto[0] = $idioma_sistema[38];
	$texto[1] = $idioma_sistema[543];
	
}else{
	
	// texto
	$texto[0] = $idioma_sistema[37];	
	$texto[1] = $idioma_sistema[544];
	
};

// separando as relações
$relacoes = explode(",", $texto[0]);

// separando opcoes
$opcoes = explode(",", $texto[1]);

// contador
$contador = 0;

// percorrendo relacoes e analisando opcoes
for($contador == $contador; $contador <= count($relacoes); $contador++){
	
	// separa relacionamento
	$relacionamento = trim(strtolower($relacionamento));
	
	// separa relacao
	$relacao = trim(strtolower($relacoes[$contador]));

	// valida relacionamento
	if($relacionamento == $relacao){

		// subcontador
		$sub_contador = $contador - 1;
		
		// valida o contador
		switch($sub_contador){
			
			case 1:
			return $opcoes[0];
			break;
			
			case 2:
			return $opcoes[1];
			break;

			case 3:
			return $opcoes[2];
			break;
			
			case 7:
			return $opcoes[3];
			break;
			
			case 8:
			return $opcoes[4];
			break;
			
		};

	}else{
		
		// valida atingiu o final e não encontrou resultados
		if(count($relacoes) == $contador){
			
			// adiciona captular
			$relacionamento = captular($relacionamento);

			// html
			$html = "
			<div class='classe_atencao_relacionamento'>
			
			<div class='classe_atencao_relacionamento_imagem'>
			$imagem_sistema[0]
			</div>
			
			<div class='classe_atencao_relacionamento_texto span_link_3'>
			$relacionamento
			</div>
			
			</div>
			";
			
			// retorno
			return $html;
			
		};
		
	};

};

};

?>