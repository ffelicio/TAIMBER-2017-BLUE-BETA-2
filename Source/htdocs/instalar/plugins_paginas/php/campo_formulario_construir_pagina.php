<?php

// campo formulario construir paginas
function campo_formulario_construir_pagina(){

// globals
global $idioma_sistema;
global $variavel_campo;

// valida pode criar paginas
if(retorne_pode_criar_paginas() == false){

    // retorno nulo
    return null;	
	
};

// numero de paginas
$numero_paginas = retorne_numero_paginas_usuario(retorne_idusuario_request());

// url de formulario
$url_formulario = PAGINA_ACOES;

// array com campos
$array_campos = explode(",", CAMPO_TABELA_PERFIL_PAGINA_CAMPOS);

// array com campos de tabelas
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_PAGINA_CORPO);

// contador
$contador = 0;

// lista campos disponiveis
foreach($array_campos as $campo){

// valida campo
if($campo != null){

	// trata o campo do formulario
	$campo_tabela = trata_campo_tabela($array_campos_tabela[$contador + 1], false);

	// seleciona o tipo de elemento
	switch($contador){

		case 1:
		// campos do formulario
		$campos[0] .= "
		<div class='classe_campo_criar_pagina_usuario_campo'>
		<div class='classe_campo_criar_pagina_usuario_campo_titulo'>$campo</div>
		<div class='classe_campo_criar_pagina_usuario_campo_campo'><textarea name='$campo_tabela' cols='28' rows='10' placeholder='$campo'></textarea></div>
		</div>
		";	
		break;
		
		default:
		// campos do formulario
		$campos[0] .= "
		<div class='classe_campo_criar_pagina_usuario_campo'>
		<div class='classe_campo_criar_pagina_usuario_campo_titulo'>$campo</div>
		<div class='classe_campo_criar_pagina_usuario_campo_campo'><input type='text' name='$campo_tabela' placeholder='$campo'></div>
		</div>
		";
	
	};
	
	// atualiza o contador
	$contador++;
	
};	
	
};

// campo criar pagina
$campos[1] = "
<div class='classe_campo_criar_pagina_usuario_campo'>
<input type='submit' value='$idioma_sistema[240]'>
</div>
";

// valida o numero de paginas
if($numero_paginas == 0){
    
	// mensagem de sistema
    $mensagem[0] = mensagem_sucesso(retorne_nome_usuario_logado().$idioma_sistema[244].NUMERO_MAXIMO_PAGINAS_USUARIO.$idioma_sistema[243]);
	
}else{
	
	// valida singular ou plural
	if($numero_paginas > 1){
		
		// plural
		$plural[0] = $idioma_sistema[243];
		
	}else{
		
		// plural
		$plural[0] = $idioma_sistema[245];	
		
	};
	
    // mensagem de sistema
    $mensagem[0] = mensagem_sucesso(retorne_nome_usuario_logado().$idioma_sistema[241].NUMERO_MAXIMO_PAGINAS_USUARIO.$idioma_sistema[242].$numero_paginas.$plural[0]);

};

// html
$html = "
<div class='classe_campo_criar_pagina_usuario'>
$mensagem[0]
<form action='$url_formulario' method='post'>
<input type='hidden' name='$variavel_campo[2]' value='52'>
$campos[0]
$campos[1]
</form>
</div>
";

// adiciona conteudo padrao
$html = constroe_conteudo_padrao(true, $html, null);

// retorno
return $html;

};

?>