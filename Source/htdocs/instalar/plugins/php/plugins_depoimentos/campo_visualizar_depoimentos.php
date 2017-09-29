<?php

// campo visualizar depoimentos
function campo_visualizar_depoimentos($modo){

// globals
global $idioma_sistema;
global $tabela_banco;

// id de usuario via requeste
$uid = retorne_idusuario_request();

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// usuario dono do perfil
$usuario_dono = retorne_usuario_dono_perfil($uid);

// separa os dados
$dados_perfil_logado = $dados_compilados_usuario[$tabela_banco[1]];

// numero de depoimentos
$numero_depoimentos = retorne_numero_depoimentos($uid, true);

// plural ou singular
if($numero_depoimentos[0] > 1){
	
	// plural
	$numero_depoimentos[0] = retorne_tamanho_resultado($numero_depoimentos[0]).$idioma_sistema[181];
	
}else{
	
	// singular
	$numero_depoimentos[0] = $numero_depoimentos[0].$idioma_sistema[182];
	
};

// plural ou singular
if($numero_depoimentos[1] > 1){
	
	// plural
	$numero_depoimentos[1] = retorne_tamanho_resultado($numero_depoimentos[1]).$idioma_sistema[181];
	
}else{
	
	// singular
	$numero_depoimentos[1] = $numero_depoimentos[1].$idioma_sistema[182];
	
};

// id de campos
$idcampo[0] = codifica_md5("id_campo_visualizador_depoimentos".data_atual());
$idcampo[1] = codifica_md5("id_campo_paginador_depoimentos".data_atual());

// valida modo
if($modo == true){

    // id de campo
    $idcampo[2] = codifica_md5("id_campo_depoimentos_usuario_perfil".data_atual());

}else{

	// id de campo
	$idcampo[2] = retorne_campo_formulario_request(21);

};

// valida usuario dono do perfil
if($usuario_dono == true){
	
	// argumentos de dono do perfil
    $argumento[0] = 1;
    $argumento[1] = 0;

}else{
	
	// argumentos de amigo de usuario logado
    $argumento[0] = 0;
    $argumento[1] = 0;	
	
};

// id de campo
$idcampo[3] = retorne_idcampo_md5();

# zera o contador de depoimentos
$evento[1] = "onclick='carregar_depoimentos(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", null, $argumento[1], \"$idcampo[3]\");'";

# carrega os depoimentos enviados
$evento[2] = "onclick='carregar_depoimentos(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", 1, $argumento[0], \"$idcampo[3]\");'";

# carrega os depoimentos recebidos
$evento[3] = "onclick='carregar_depoimentos(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", 2, $argumento[0], \"$idcampo[3]\");'";

# carrega os depoimentos baseado no modo atual, serve para a paginacao somente!
$evento[4] = "onclick='carregar_depoimentos(\"$idcampo[0]\", \"$idcampo[1]\", \"$idcampo[2]\", 3, $argumento[1], \"$idcampo[3]\");'";

// valida usuario dono do perfil
if($usuario_dono == true){

	// campo com numero de depoimentos
    $campo_numero_depoimentos = "
	<div class='classe_depoimentos_perfil_basico_titulo'>
    <div class='classe_visualiza_depoimentos_usuario_modo'>
	
	<span class='span_link' $evento[2]>$idioma_sistema[192]$numero_depoimentos[0]</span>
	<span class='span_link' $evento[3]>$idioma_sistema[193]$numero_depoimentos[1]</span>
    
	</div>
	</div>";
	
}else{

    // valida sexo de usuario
	# exibe o sexo e o numero de depoimentos
    if(retorne_sexo_usuario($dados_perfil_logado) == true){
	
	    // homem
	    $texto_campo_numero_depoimentos = "$idioma_sistema[196] - $numero_depoimentos[1]";
	
    }else{
	
	    // homem
	    $texto_campo_numero_depoimentos = "$idioma_sistema[197] - $numero_depoimentos[1]";
	
    };
	
	// campo com numero de depoimentos
    $campo_numero_depoimentos = "
	<div class='classe_depoimentos_perfil_basico_titulo'>
	
	<div class='classe_visualiza_depoimentos_usuario_modo' $evento[1]>
    <span class='span_link'>$texto_campo_numero_depoimentos</span>
	</div>
	
    </div>";

};

// valida usuario dono do perfil
if($usuario_dono == true){
	
    // evento de paginacao
	$evento_paginar = $evento[4];
	
}else{
	
    // evento de paginacao
	$evento_paginar = $evento[3];
	
};

// barra de progresso gif
$progresso[0] = campo_progresso_gif($idcampo[3]);

// campos depoimentos
$campos_depoimentos = "

$campo_numero_depoimentos

<div class='classe_visualiza_depoimentos_usuario_lista_depoimentos' id='$idcampo[0]'></div>
$progresso[0]

<div class='classe_paginador_padrao classe_cor_29 span_link' id='$idcampo[1]' $evento_paginar>
$idioma_sistema[61]
</div>

";

// valida modo
if($modo == false){
	
	// retorno
    return $campos_depoimentos;

};

// html
$html = "
<div class='classe_depoimentos_usuario_perfil' id='$idcampo[2]'>
$campos_depoimentos
</div>
";

// retorno
return $html;

};

?>