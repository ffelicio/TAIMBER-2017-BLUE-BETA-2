<?php

// constroe as opcoes de configuracoes de pagina
function constroe_opcoes_configuracoes_pagina(){

// globals
global $titulo_link_pagina;
global $pagina_inicial;
global $idioma_sistema;
global $variavel_campo;

// modo de configuracao
$modo_config = retorne_campo_formulario_request(46);

// contador
$contador = 0;

// id de pagina
$id = retorne_idpagina_request();

// construindo  links
foreach($titulo_link_pagina as $titulo){
	
	// valida link
	if($titulo != null){
		
		// atualiza o contador
		$contador++;
		
		// url de link
		$url = $pagina_inicial."?$variavel_campo[25]=$id&&$variavel_campo[6]=2&$variavel_campo[46]=$contador";

		// atualiza o link
		$link = "<a href='$url' title='$titulo'>$titulo</a>";
		
		// valida item selecionado
		if($contador == $modo_config){
			
			// html
			$html .= "<div class='classe_div_opcao_configuracao_selecionada classe_cor_3'>$link</div>";
			
		}else{
			
			// html
			$html .= "<div class='classe_div_opcao_configuracao_padrao'>$link</div>";
			
		};

	};
	
};

// retorno
return $html;

};

?>