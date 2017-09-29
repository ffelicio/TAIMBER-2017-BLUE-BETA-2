<?php

// campo bloquear usuario
function campo_bloquear_usuario($modo, $idusuario){

// modo true retorna modo array
// modo false retorna normal

// globals
global $idioma_sistema;

// valida usuario dono do perfil
if(retorne_usuario_dono_perfil($idusuario) == true or retorne_pode_bloquear($idusuario) == false){

    // retorno
    return null;	
	
};

// nome do usuario
$nome_usuario = retorne_nome_usuario_logado();
$nome_amigo = retorne_nome_usuario(true, $idusuario);

// id de dialogo
$id_dialogo = codifica_md5("dialogo_bloq_desbloq_amigo_$idusuario".data_atual());

// valida usuario bloqueado
if(retorne_usuario_bloqueio($idusuario) == true){
	
	// campo desbbloquear
    $campo_bloquear = "
	<div class='classe_campo_texto_bloquear'>
    $nome_usuario$idioma_sistema[129]$nome_amigo$idioma_sistema[46]
	</div>
	
	<div class='classe_campo_botao_bloquear'>
    <input type='button' value='$idioma_sistema[32]' onclick='desbloquear_usuario(\"$idusuario\");'>
    </div>
	
	";
   
    // adiciona dialogo
    $campo_bloquear_dialogo = constroe_dialogo($idioma_sistema[131].$nome_amigo, $campo_bloquear, $id_dialogo);

    // adiciona campo de bloqueio
    $campo_bloquear = "
    <span class='botao_padrao' onclick='exibe_dialogo(\"$id_dialogo\");'>$idioma_sistema[130]</span>
    ";	
	
	// html
	$html = "
	<div class='classe_campo_desbloquear_usuario'>
	$campo_bloquear
	</div>
	";

}else{

    // campo bloquear
    $campo_bloquear = "
	<div class='classe_campo_texto_bloquear'>
    $nome_usuario$idioma_sistema[100]$nome_amigo$idioma_sistema[46]
	</div>
	
	<div class='classe_campo_botao_bloquear'>
    <input type='button' value='$idioma_sistema[32]' onclick='bloquear_usuario(\"$idusuario\");'>
    </div>
	";
   
    // adiciona dialogo
    $campo_bloquear_dialogo = constroe_dialogo($idioma_sistema[101].$nome_amigo, $campo_bloquear, $id_dialogo);

    // adiciona campo de bloqueio
    $campo_bloquear = "
    <span class='span_link' onclick='exibe_dialogo(\"$id_dialogo\");'>$idioma_sistema[102]</span>
    ";	

	// html
	$html = "
	<div class='classe_campo_bloquear_usuario'>
	$campo_bloquear
	</div>
	";

};

// valida o modo
if($modo == true){
	
	// array de retorno
	$array_retorno["html"] = $html;
	$array_retorno["dialogo"] = $campo_bloquear_dialogo;

	// retorno
	return $array_retorno;

}else{
	
	// adiciona dialogo em html
	$html .= $campo_bloquear_dialogo;
	
	// retorno
	return $html;
	
};

};

?>