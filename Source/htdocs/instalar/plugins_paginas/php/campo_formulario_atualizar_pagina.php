<?php

// campo formulario atualizar pagina
function campo_formulario_atualizar_pagina($id){

// globals
global $idioma_sistema;
global $variavel_campo;

// valida usuario dono da pagina
if(retorne_usuario_dono_pagina(retorne_idusuario_request(), $id) == false){
	
	// retorno nulo
    return null;
	
};

// dados da pagina
$dados = retorne_dados_perfil_pagina($id);

// url de formulario
$url_formulario = PAGINA_ACOES;

// array com campos
$array_campos = explode(",", CAMPO_TABELA_PERFIL_PAGINA_CAMPOS);

// array com campos de tabelas
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_PAGINA_CORPO);

// contador
$contador = 0;

// eventos
$evento[0] = "onkeyup='auto_ajustar_campo_textarea(this);'";

// lista campos disponiveis
foreach($array_campos as $campo){

	// valida campo
	if($campo != null){

		// trata o campo do formulario
		$campo_tabela = trata_campo_tabela($array_campos_tabela[$contador + 1], false);

		// valor de campo
		$valor_campo = $dados[$campo_tabela];
		
		// seleciona o tipo de elemento
		switch($contador){

			case 1:
			
			// adiciona quebra de linha em textarea
			$valor_campo = adiciona_quebra_linha_textarea($valor_campo);
			
			// campos do formulario
			$campos[0] .= "
			<div class='classe_campo_criar_pagina_usuario_campo'>
			<div class='classe_campo_criar_pagina_usuario_campo_titulo classe_cor_11'>$campo</div>
			<div class='classe_campo_criar_pagina_usuario_campo_campo'>
			<textarea name='$campo_tabela' cols='28' rows='10' placeholder='$campo' $evento[0]>$valor_campo</textarea>
			</div>
			</div>
			";	
			break;
			
			default:
			// campos do formulario
			$campos[0] .= "
			<div class='classe_campo_criar_pagina_usuario_campo'>
			<div class='classe_campo_criar_pagina_usuario_campo_titulo classe_cor_11'>$campo</div>
			<div class='classe_campo_criar_pagina_usuario_campo_campo'>
			<input type='text' name='$campo_tabela' placeholder='$campo' value='$valor_campo'>
			</div>
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
<input type='submit' value='$idioma_sistema[251]'>
</div>
";

// html
$html = "
<div class='classe_campo_criar_pagina_usuario'>
<form action='$url_formulario' method='post'>
<input type='hidden' name='$variavel_campo[2]' value='54'>
<input type='hidden' name='$variavel_campo[25]' value='$id'>
$campos[0]
$campos[1]
</form>
</div>
";

// retorno
return $html;

};

?>