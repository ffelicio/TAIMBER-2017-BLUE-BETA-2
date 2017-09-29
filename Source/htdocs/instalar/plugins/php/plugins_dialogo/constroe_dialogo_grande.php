<?php

// constroe dialogo
function constroe_dialogo_grande($conteudo, $id_dialogo, $idcampo_1, $modo_paginar_album, $id, $uid){

// quando passar a funcao como parametro não usar o ;

// globals
global $idioma_sistema;

// imagens
$imagem[0] = retorne_imagem_sistema(98, null, false);

// botao fechar
$botao_fechar = "
<span class='span_botao_fechar_mensagem_dialogo_grande classe_cor_6' onclick='exibe_dialogo(\"$id_dialogo\");'>
$imagem[0]
</span>
";

// valida se a funcao foi passada
if($modo_paginar_album == true){
	
	// tabindex
	$tabindex = retorne_contador_iteracao();

	// scripts
	$scripts[0] = "
	<script>

	$(\"#$id_dialogo\").hover(function(){
		this.focus();
	}, function(){
		this.blur();
	}).keydown(function(e){
		
		paginar_slide_album_teclado(\"$idcampo_1\", \"$uid\", e.keyCode);
		
	});

	</script>
	";

};

// html
$html = "
<div id=\"$id_dialogo\" class='div_janela_principal_mensagem_dialogo_grande' tabindex='$tabindex'>
<div class='div_janela_mensagem_dialogo_grande'>

<div class='div_janela_mensagem_dialogo_grande_titulo'>
$botao_fechar
</div>

<div class='div_janela_mensagem_conteudo_grande' id='$idcampo_1'>
$conteudo
</div>

</div>
</div>

$scripts[0]
";

// retorno
return $html;

};

?>