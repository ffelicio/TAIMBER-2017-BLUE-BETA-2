<?php

// constroe mensagem
function constroe_mensagem($dados_query, $modo, $modo_amigo){

// globals
global $idioma_sistema;

// contador
$contador = 0;

// numero de linhas
$numero_linhas = $dados_query["linhas"];

// construindo mensagens
for($contador == $contador; $contador <= $numero_linhas; $contador++){
	
	// dados
	$dados = $dados_query["dados"][$contador];
	
	// separa os dados
	$id = $dados["id"];
    $uid = $dados[UID];
    $uidamigo = $dados[UIDAMIGO];
    $mensagem = $dados[MENSAGEM];
    $uidenviou = $dados[UIDENVIOU];
    $visualizado = $dados[VISUALIZADO];
    $respondido = $dados[RESPONDIDO];
    $data = $dados[DATA];
	
	// valida id
	if($id != null){

	    // data amigavel
	    $data = converte_data_amigavel(true, $data);
		
		// eventos
        $eventos[0] = "onclick='carregar_mensagens_usuario(null, null, $uidamigo);'";

		// id de campos
		$idcampo[0] = codifica_md5("id_campo_mensagem_usuario_$id");
		
		// valida modo amigo
		if($modo_amigo == true){
			
			// campo perfil
			$campo_perfil = constroe_imagem_perfil_mensagens($uidamigo);
			
		}else{
			
			// campo perfil
			$campo_perfil = constroe_imagem_perfil_mensagens($uidenviou);
			
		};
		
		// campo gerencia mensagem
		$campo_gerencia = campo_gerencia_mensagem($dados, $idcampo[0], $modo);
		
		// converte em urls
		$mensagem = converter_urls(false, $mensagem);
		
	    // constroe mensagem
	    $html .= "
	    <div class='classe_mensagem_usuario classe_cor_2 classe_cor_31' id='$idcampo[0]'>
		$campo_gerencia

		<div class='classe_mensagem_usuario_separador' $eventos[0]>
		
		<div class='classe_mensagem_usuario_perfil'>
		$campo_perfil
		</div>
		
		<div class='classe_mensagem_usuario_mensagem'>
		$mensagem
		</div>
		
	    <div class='classe_mensagem_usuario_data classe_cor_7'>
		$data
		</div>
		
		</div>
		
		</div>
	    ";
	
	};
	
};

// retorno
return $html;

};

?>