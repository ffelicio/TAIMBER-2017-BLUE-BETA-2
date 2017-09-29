<?php

// mensagem de sistema sucesso
function mensagem_sucesso($mensagem){

// sexo de usuario
$sexo_usuario = retorne_sexo_usuario_logado();

// valida sexo de usuario logado
if($sexo_usuario == true or $sexo_usuario == null){
	
	// classes
	$classe[0] = "classe_div_mensagem_sistema_sucesso";
	
}else{
	
	// classes
	$classe[0] = "classe_div_mensagem_sistema_sucesso_2";
	
};

// html
$html = "
<div class='$classe[0]'>
$mensagem
</div>
";

// retorno
return $html;

};

?>