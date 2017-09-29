<?php

// constroe o campo desenvolvedor
function constroe_campo_desenvolvedor(){

// globals
global $administradores_sistema;
global $idioma_sistema;

// valida usuario logado
if(retorne_usuario_logado() == true){
	
	// classes
	$classe[0] = "classe_campo_desenvolvedor_2 classe_cor_8";
	
}else{

	// classes
	$classe[0] = "classe_campo_desenvolvedor";	
	
};

// id de usuario
$uid = retorne_idusuario_email($administradores_sistema[0]);

// links
$link[0] = retorne_nome_link_usuario(true, $uid);

// campos
$campo[0] = "

<div class='classe_campo_desenvolvedor_separa'>

<div class='classe_campo_desenvolvedor_separa_titulo classe_cor_7'>
$idioma_sistema[314]
</div>

<div class='classe_campo_desenvolvedor_separa_conteudo'>
$link[0]
</div>

</div>

";

// campo altera idioma
$campo[1] = constroe_alterar_idioma();

// campos
$campo[1] = "
<div class='classe_campo_desenvolvedor_separa_2'>
$campo[1]
</div>
";

// html
$html = "
<div class='$classe[0]'>
$campo[0]
$campo[1]
</div>
";

// retorno
return $html;

};

?>