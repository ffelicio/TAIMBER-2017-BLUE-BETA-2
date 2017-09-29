<?php

// retorna o numero do estado do usuario logado
function retorne_numero_estado_usuario_logado(){

// globals
global $idioma_sistema;

// obtendo estados disponiveis
$estados = explode(",", $idioma_sistema[39]);

// dados do perfil do usuario logado
$dados_perfil = retorne_dados_perfil_usuario_logado();

// estado do usuario
$estado_usuario = $dados_perfil[ESTADO];

// contador
$contador = 0;

// listando estados
foreach($estados as $estado){
	
	// valida estado
	if($estado != null){
		
		// converte estados para minusculo
		$estado = converte_minusculo($estado);
		$estado_usuario = converte_minusculo($estado_usuario);
	
		// validando estados...
		if($estado == $estado_usuario){
			
			// retorno
			return $contador - 1;
			
		};
		
		// atualiza o contador
		$contador++;
		
	};
	
};

// retorno
return -1;

};

?>