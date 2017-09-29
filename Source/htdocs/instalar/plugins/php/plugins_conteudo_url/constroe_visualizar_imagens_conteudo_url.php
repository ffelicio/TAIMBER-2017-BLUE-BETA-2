<?php

// constroe o visualizador de imagens de conteudo
function constroe_visualizar_imagens_conteudo_url($imagens){

// globals
global $codigos_especiais;

// array com imagens
$imagens = explode($codigos_especiais[12], $imagens);

// contador
$contador = 0;

// construindo imagens
foreach($imagens as $url_imagem){
	
	// valida url de imagem
	if($url_imagem != null){
		
		// imagem
		$imagem[0] = retorne_imagem_sistema(36, null, false);
		
		// id de campo
		$idcampo[0] = retorne_idcampo_md5();
		
		// eventos
		$eventos[0] = "onclick='excluir_imagem_conteudo_url(\"$idcampo[0]\", $contador);'";
		
		// campo
		$campo[0] = "
		<script language='javascript'>
		v_array_conteudo_url_imagens[$contador] = \"$url_imagem\";
		</script>
		";
		
		// campo
		$campo[1] = "
		<div class='classe_separa_imagem_visualizar_conteudo_url_gerencia'>
		<div class='classe_separa_imagem_visualizar_conteudo_url_gerencia_separa' $eventos[0]>
		$imagem[0]
		</div>
		</div>
		";
		
		// html
		$html .= "
		<div class='classe_separa_imagem_visualizar_conteudo_url classe_cor_3' id='$idcampo[0]'>
		$campo[1]
		<div class='classe_separa_imagem_visualizar_conteudo_url_imagem'>
		<img src='$url_imagem'>
		</div>
		</div>
		
		$campo[0]
		";
		
		// atualiza o contador
		$contador++;
		
	};
	
};

// retorno
return $html;

};

?>