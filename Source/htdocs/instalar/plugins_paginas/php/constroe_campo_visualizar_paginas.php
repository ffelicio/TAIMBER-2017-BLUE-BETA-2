<?php

// constroe o campo visualizador de paginas
function constroe_campo_visualizar_paginas($modo){

// modo true carrega as paginas criadas
// modo false carrega as paginas curtidas

// globals
global $idioma_sistema;
global $tabela_banco;

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// valida o modo
if($modo == true){
	
    // array com paginas
    $array_paginas = $dados_compilados_usuario[$tabela_banco[18]];
    $array_paginas_perfil = $dados_compilados_usuario[$tabela_banco[19]];

	// inverte os arrays
    $array_paginas = inverte_array($array_paginas);
    $array_paginas_perfil = inverte_array($array_paginas_perfil);

}else{
	
    // array com paginas
    $array_paginas = $dados_compilados_usuario[$tabela_banco[22]];
	
    // inverte os arrays
    $array_paginas = inverte_array($array_paginas);

};

// valida array de paginas
if(count($array_paginas) == 0){
	
	// retorno nulo
	return null;
	
};

// contador
$contador = 0;

// constroe paginas
for($contador == $contador; $contador <= count($array_paginas); $contador++){

    // valida quantidade de paginas que pode exibir no perfil basico
    if($contador > NUMERO_PAGINAS_EXIBE_PERFIL_BASICO){
		
		// saindo do for
		break;
		
	};
	
	// constroe as paginas
	$paginas .= constroe_pagina_miniatura($array_paginas[$contador], $array_paginas_perfil[$contador], $modo, false);

};

// valida paginas
if($paginas != null){
	
	// html
	$html = "
	<div class='classe_campo_visualizar_paginas_perfil'>
	$paginas
	</div>
	";

};

// retorno
return $html;

};

?>