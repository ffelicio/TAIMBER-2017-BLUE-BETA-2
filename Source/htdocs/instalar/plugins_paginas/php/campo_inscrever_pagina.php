<?php

// campo inscrever em pagina
function campo_inscrever_pagina($pagina, $modo){

// modo false constroe normal
// modo true constroe no modo jquery

// globals
global $idioma_sistema;
global $variavel_campo;

// valida o modo
if($modo == true){
	
	// classes
	$classe[0] = "classe_inscrever_pagina_2";
	
}else{
	
	// classes
	$classe[0] = "classe_inscrever_pagina";

};

// sexo de usuario logado
$sexo_usuario = retorne_sexo_usuario_logado();

// pagina inicial
$pagina_inicial = PAGINA_INICIAL;

// id de usuario logado
$uid = retorne_idusuario_logado();

// usuario dono da pagina
$usuario_dono = retorne_usuario_dono_pagina($uid, $pagina);

// numero de inscritos
$numero_inscritos = retorne_numero_inscritos_pagina($pagina);

// id de campo
$idcampo[0] = codifica_md5("id_campo_inscreve_pagina_".$pagina.data_atual());
$idcampo[1] = codifica_md5("id_dialogo_cancelar_inscricao_pagina_".$pagina.data_atual());

// eventos
$evento[0] = "onclick='adiciona_inscrito_pagina(\"$uid\", \"$idcampo[0]\", \"$idcampo[1]\");'";
$evento[1] = "onclick='exibe_dialogo(\"$idcampo[1]\");'";

// valida usuario inscrito
if(retorne_usuario_inscrito_pagina($uid, $pagina) == true){

    // nome do usuario logado
    $nome_usuario = retorne_nome_usuario_logado();

	// campos
    $campo[2] = "

	<div class='classe_texto_caixa_dialogo'>
	$nome_usuario$idioma_sistema[263]
	</div>

	<div class='classe_botao_caixa_dialogo'>
	<input type='button' value='$idioma_sistema[32]' $evento[0]>
	</div>	
	
	";

    // adiciona dialogo
    $campo[2] = constroe_dialogo($idioma_sistema[264], $campo[2], $idcampo[1]);

	// iguala ao evento de dialogo
	$evento[0] = $evento[1];
	
	// valida sexo de usuário
	if($sexo_usuario == true){
		
		// campos
		$campo[0] = "
		<button $evento[0]>$idioma_sistema[257]</button>
		";
		
	}else{
		
		// campos
		$campo[0] = "
		<button $evento[0]>$idioma_sistema[610]</button>
		";
		
	};
	
}else{
	
	// valida configuracao de pagina
    if(retorne_idpagina_request() != null){
	
	    // analiza configuracao de pagina
	    if(retorne_configuracao_pagina(retorne_idpagina_request(), 2) == true and retorne_configuracao_pagina(retorne_idpagina_request(), 3) == true){
		
	        // campos
            $campo[0] = "
	        <button class='botao_inscrito' $evento[0]>$idioma_sistema[256]</button>	
	        ";		    
		
	    };

    };

};

// valida usuario dono da pagina
if($usuario_dono == true){
	
	// limpa os campos
    $campo[0] = null;
	$campo[2] = null;
	
};

// singular ou plural
if($numero_inscritos > 1){
	
	// tamanho de inscritos
	$numero_inscritos = retorne_tamanho_resultado($numero_inscritos);
	
	// texto do numero de inscritos
	$texto[0] = $numero_inscritos.$idioma_sistema[259];
	
}else{
	
	// texto do numero de inscritos
	$texto[0] = $numero_inscritos.$idioma_sistema[260];	
	
};

// valida o numero de inscritos
if($numero_inscritos == 0){
	
	// texto do numero de inscritos
	$texto[0] = $idioma_sistema[261];
	
};

// urls
$url[0] = "$pagina_inicial?$variavel_campo[25]=$pagina&$variavel_campo[6]=4";

// links
$link[0] = "<a href='$url[0]' title='$texto[0]'>$texto[0]</a>";

// campos
$campo[1] = "
<div class='classe_numero_inscritos_pagina borda_div_2'>
$link[0]
</div>
";

// exibe os ultimos usuarios inscritos na pagina
$campo[3] = exibe_ultimos_usuarios_inscritos_perfil_pagina();

// valida usuario logado
if(retorne_usuario_logado() == false){
	
	// limpa campos
	$campo[0] = null;
	
};

// campos
$campo[0] = "
<div class='campo_botao_inscrever_pagina'>
$campo[0]
</div>
";

// html
$html = "
<div class='$classe[0]' id='$idcampo[0]'>
$campo[0]
$campo[1]
$campo[3]
</div>
$campo[2]
";

// valida o modo
if($modo == false){
	
    // adiciona caixa
    $html = constroe_caixa(false, $html);

};

// retorno
return $html;

};

?>