<?php

// constroe o campo descricao de imagem
function constroe_campo_descricao_imagem($dados){

// globals
global $idioma_sistema;

// separa os dados
$id = $dados["id"];
$uid = $dados[UID];
$chave = $dados[CHAVE];
$descricao_imagem = html_entity_decode($dados[DESCRICAO_IMAGEM]);

// valida usuario logado dono de descricao
if(retorne_idusuario_logado() == $uid){
	
	// placeholder
	$placeholder[0] = retorne_nome_usuario_logado().$idioma_sistema[416];

	// id de campo
	$idcampo[0] = retorne_idcampo_md5();
	
	// funcoes
	$funcao[0] = "atualizar_descricao_imagem_album(\"$idcampo[0]\", \"$id\", \"$chave\");";
	
	// eventos
	$evento[0] = "onkeyup='$funcao[0]'";
	$evento[1] = "onclick='$funcao[0]'";
	
	// emoticons
	$emoticons[0] = constroe_visualizador_emoticons(true, false, retorne_idcampo_md5(), $idcampo[0]);

	// campo de entrada
	$campo_entrada = constroe_campo_div_editavel(true, $idcampo[0], $descricao_imagem, null, $evento[0], $placeholder[0]);
	
	// campos
	$campo[0] = "
	<div class='classe_descricao_imagem classe_cor_3'>
	
	<div class='classe_descricao_imagem_campo'>
	$campo_entrada
	</div>

	<div class='classe_descricao_imagem_emoticons'>
	<div class='classe_descricao_imagem_emoticons_separa'>$emoticons[0]</div>
	</div>
	
	<div class='classe_descricao_imagem_campo_botao'>
	<input type='button' value='$idioma_sistema[12]' $evento[1]>
	</div>

	</div>

	";
	
}else{
	
	// valida descricao de imagem
	if($descricao_imagem != null){
		
		// converte todas as urls, links, videos etc
		$descricao_imagem = converter_urls(false, $descricao_imagem);
		
		// campos
		$campo[0] = "
		<div class='classe_descricao_imagem'>
		
		<div class='classe_descricao_imagem_descricao classe_cor_15'>
		$descricao_imagem
		</div>

		</div>
		";
	
	};
	
};

// html
$html = "
$campo[0]
";

// retorno
return $html;

};

?>