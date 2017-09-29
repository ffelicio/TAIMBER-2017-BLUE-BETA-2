<?php

// constroe os paginadores javascript
function constroe_paginadores_javascript(){

// funcoes de paginacao
$funcoes_paginacao[0] = "executador_acao(null, v_variaveis_javascript['tipo_acao_pagina'], v_variaveis_javascript['campo_carrega_conteudo']);";

// carrega conteudo
switch(retorne_campo_formulario_request(2)){

	default: // publicacoes do usuario
    // html
	$html = "

	<!-- pagina ao carregar a pagina -->
	<script language='javascript'>
	$(document).ready(function(){
		
        $funcoes_paginacao[0]

    });
	</script>
    <!-- fim de comentario -->

	
	<!-- evento ao atingir o bottom da pagina -->
	<script language='javascript'>
    $(window).scroll(function(){
	if($(window).scrollTop() + $(window).height() == $(document).height()) {
       
        $funcoes_paginacao[0]
       
    };
    });
    <!-- fim de comentario -->
	</script>
	";
	
};

// retorno
return $html;

};

?>