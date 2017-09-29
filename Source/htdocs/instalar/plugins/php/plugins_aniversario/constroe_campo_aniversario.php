<?php

// constroe o campo de aniversario
function constroe_campo_aniversario(){

// globals
global $idioma_sistema;

// classes
$classe[0] = "classe_bloco_aniversariantes_perfil";

// numero de aniversariantes
$numero_aniversariantes = retorne_numero_aniversariantes_usuario();

// campo parabens
$campo_parabens = campo_parabens_aniversario();

// valida numero de aniversariantes
if($numero_aniversariantes == 0 and $campo_parabens == null){
	
	// retorno nulo
	return null;
	
};

// id de campos
$idcampo[0] = codifica_md5("id_dialogo_visualizar_aniversariantes_".data_atual());
$idcampo[1] = codifica_md5("id_campo_resultados_visualizar_aniversariantes_".data_atual());
$idcampo[2] = codifica_md5("id_barra_progresso_aniversariantes_".data_atual());

// funcoes
$funcao[0] = "carregar_aniversariantes(\"$idcampo[1]\", \"$idcampo[2]\", 1);";
$funcao[1] = "carregar_aniversariantes(\"$idcampo[1]\", \"$idcampo[2]\", 0);";

// eventos
$evento[0] = "onclick='exibe_dialogo(\"$idcampo[0]\"), $funcao[0];'";

// eventos
$evento[1] = "onclick='$funcao[1]'";

// eventos
$evento[2] = "onscroll='$funcao[1]'";

// campos
$campo[0] = constroe_visualizar_aniversariantes_perfil_basico();

// barra de progresso
$barra_progresso[0] = campo_progresso_gif($idcampo[2]);

// campos
$campo[1] = "
<div class='classe_resultados_aniversariantes' id='$idcampo[1]' $evento[2]></div>
$barra_progresso[0]

<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[1]>
$idioma_sistema[61]
</div>
";

// adiciona dialogo
$campo[1] = constroe_dialogo($idioma_sistema[331], $campo[1], $idcampo[0]);

// campos
$campo[2] = "
<div class='classe_abrir_aniversariantes classe_cor_3 classe_cor_5' $evento[0]>
<span class='span_link'>$idioma_sistema[332]</span>
</div>
";

// valida numero de aniversariantes
if($numero_aniversariantes == 0){
	
	// limpa campos
	$campo[0] = null;
	$campo[1] = null;
	$campo[2] = null;
	
};

// html
$html = "
<div class='$classe[0]'>
$campo_parabens
$campo[2]
$campo[0]
</div>
$campo[1]
";

// retorno
return $html;

};

?>