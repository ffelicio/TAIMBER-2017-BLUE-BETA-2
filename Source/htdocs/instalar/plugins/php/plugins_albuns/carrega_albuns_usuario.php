<?php

// carrega os albuns do usuário
function carrega_albuns_usuario(){

// globals
global $idioma_sistema;

// valida o modo pagina
if(retorne_modo_pagina() == true){
	
	// retorno nulo
	return null;
	
};

// id de usuário via requeste
$uid = retorne_idusuario_request();

// campos com albuns
$campo[0] = carrega_lista_albuns_imagens_pagina();
$campo[1] = carrega_lista_albuns_imagens(1);
$campo[2] = carrega_lista_albuns_imagens(2);

// valida o numero de páginas do usuário
if(retorne_numero_paginas_usuario($uid) > 0){
	
	// campos com albuns
	$campo[3] = carrega_lista_albuns_imagens(3);

};

// classes
$classe[0] = "classe_lista_albuns_imagens_usuario_titulo classe_cor_8 classe_cor_4 classe_cor_21";
$classe[1] = "classe_lista_albuns_imagens_usuario_conteudo";
$classe[2] = "classe_lista_albuns_imagens_usuario_gerais";
$classe[3] = "classe_lista_albuns_imagens_usuario_paginas";

// campos
$sub_campo[0] = "
<div class='$classe[2]'>

<div class='$classe[0]'>
$idioma_sistema[602]
</div>

<div class='$classe[1]'>
$campo[1]
$campo[2]
$campo[3]
</div>

</div>
";

// valida o numero de paginas de usuario
if(retorne_numero_paginas_usuario($uid) > 0){
	
	// campos
	$sub_campo[1] = "
	<div class='$classe[3]'>

	<div class='$classe[0]'>
	$idioma_sistema[601]
	</div>

	<div class='$classe[1]'>
	$campo[0]
	</div>

	</div>
	";

};

// html
$html = "
<div class='classe_lista_albuns_imagens_usuario'>
$sub_campo[0]
$sub_campo[1]
</div>
";

// retorno
return $html;

};

?>