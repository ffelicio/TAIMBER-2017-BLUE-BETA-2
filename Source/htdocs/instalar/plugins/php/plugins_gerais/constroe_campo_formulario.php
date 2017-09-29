<?php

// constroe campo de formulario
function constroe_campo_formulario($modo, $valor, $idcampo, $nome, $placeholder, $evento){

// valida o modo
switch($modo){
	
	case 1:
	$html = "<input type='text' value='$valor' name='$nome' placeholder='$placeholder' id='$idcampo' $evento>";
	break;

	case 2:
	$html = "<input type='button' value='$valor' $evento>";
	break;

};

// retorno
return $html;

};

?>