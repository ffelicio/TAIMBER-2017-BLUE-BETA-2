<?php

// constroe mensagem de chat
function constroe_mensagem_chat($dados_query, $modo){

// globals
global $idioma_sistema;

// contador
$contador = 0;

// numero de linhas
$numero_linhas = $dados_query["linhas"];

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// construindo mensagens
for($contador == $contador; $contador <= $numero_linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa os dados
	$id = $dados["id"];
    $uidenviou = $dados[UIDENVIOU];
    $data = $dados[DATA];
	$mensagem = $dados[MENSAGEM];
	$chave_imagem = $dados[CHAVE_IMAGEM];
	
	// valida id
	if($id != null){

	    // valida o id de usuario que enviou para construir classes
	    if($uidenviou == $idusuario){
			
			// usuario logado enviou
			$classe = "classe_mensagem_chat_1";
			
		}else{
			
			// amigo enviou
			$classe = "classe_mensagem_chat_2";
		};
		
		// valida modo imagem
		if($chave_imagem == true){
			
			// limpa a classe
			$classe = "classe_imagem_mensagem_chat";
			
		};
		
	    // data amigavel
	    $data = converte_data_amigavel(true, $data);

		// converte em urls
		$mensagem = converter_urls(true, $mensagem);
		
	    // constroe mensagem
	    $html .= "
	    <div class='classe_mensagem_chat' title='$data'>
		<div class='$classe'>$mensagem</div>
		</div>
	    ";
	
	};
	
};

// retorno
return $html;

};

?>