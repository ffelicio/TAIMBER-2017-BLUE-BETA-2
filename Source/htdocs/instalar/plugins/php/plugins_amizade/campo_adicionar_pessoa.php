<?php

// campo adicionar pessoa
function campo_adicionar_pessoa($modo_perfil_grande, $modo, $idusuario){

// modo true retorna modo array
// modo false retorna normal

// globals
global $tabela_banco;
global $idioma_sistema;

// valida usuario dono do perfil, ou se o usuário está deslogado
if(retorne_usuario_dono_perfil($idusuario) == true or retorne_usuario_logado() == false){

    // retorno nulo	
    return null;
	
};

// valida tipo de acao para montar classe
if($modo_perfil_grande == true){
	
	// classes
	$classe[0] = "classe_div_campo_adicionar_amizade_campo_add";
	$classe[1] = "classe_div_campo_adicionar_amizade";
	
}else{
	
	// classes
	$classe[0] = "classe_div_campo_adicionar_amizade_campo_add_2";
	$classe[1] = "classe_div_campo_adicionar_amizade_2";	
	
};

// dados compilados do usuario
$dados_compilados_usuario = retorne_dados_compilados_usuario($idusuario);
$dados_compilados_usuario_logado = atualiza_retorna_dados_usuario_logado_sessao();
 
// dados do perfil
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];
$dados_perfil_logado = $dados_compilados_usuario_logado[$tabela_banco[1]];

// separa os dados do perfil
$nome = $dados_perfil[NOME];
$nome_logado = $dados_perfil_logado[NOME];

// array com amigos de usuario
$array_amizade = $dados_compilados_usuario[$tabela_banco[6]];

// contador de avanco
$contador = 0;

// id de campos
$idcampo[0] = codifica_md5("idcampo_adicionar_amizade_$idusuario".data_atual());
$idcampo[1] = codifica_md5("idcampo_adicionar_amizade_email_$idusuario".data_atual());
$idcampo[2] = codifica_md5("idcampo_adicionar_amizade_mensagem_$idusuario".data_atual());

// id de dialogo
$dialogo_id = retorne_idcampo_md5();

// id de usuario logado
$idusuario_logado = retorne_idusuario_logado();

// procurando id de amigo em lista de amizades
for($contador == $contador; $contador <= count($array_amizade); $contador++){

    //dados de amizade
	$dados_amizade = $array_amizade[$contador];
    
	// separa os dados
	$id = $dados_amizade["id"];
	$uid = $dados_amizade[UID];
    $uidamigo = $dados_amizade[UIDAMIGO];
	$uidenviou = $dados_amizade[UIDENVIOU];
    $aceito = $dados_amizade[ACEITO];

	// desfazer amizade aceita recebida
	if($id != null and $uidamigo == $idusuario_logado and $aceito == 1){
		
		// exclui amizade ja aceita
        $tipo_acao = 4;
		
	    // parando o looping
        break;
		
	};
	
	// desfazer amizade aceita enviada
	if($id != null and $uidenviou == $idusuario_logado and $uidamigo == $idusuario and $aceito == 1){
		
		// exclui amizade ja aceita
        $tipo_acao = 5;
		
	    // parando o looping
        break;
		
	};
	
	// valida usuario recebeu solicitacao
	if($id != null and $uidenviou == $idusuario and $uidamigo == $idusuario_logado){
		
		// responde se aceita, ou cancela a solicitacao recebida
        $tipo_acao = 3;
		
	    // parando o looping
        break;
		
	};

	// valida usuario enviou solicitacao
	if($id != null and $uidenviou == $idusuario_logado){
		
		// tipo de acao cancelar solicitacao enviada
		$tipo_acao = 2;
	    
		// parando o looping
		break;
		
	};
	
};

// valida o tipo de acao
switch($tipo_acao){

	case 2: // cancela a solicitacao enviada
	// texto de dialogo
	$texto_dialogo = "
	
	<div class='classe_campo_add_amizade_texto'>
	$idioma_sistema[45]$nome$idioma_sistema[46]
	</div>
	
	<div class='classe_campo_add_amizade_elementos'>
	<input type='button' value='$idioma_sistema[32]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 2);'>
	</div>
	
	";
	// titulo de dialogo
	$titulo_dialogo = $idioma_sistema[48];
	// campo adicionar amizade
    $campo_adicionar = "
    <span class='$classe[0]' title='$idioma_sistema[49]' onclick='exibe_dialogo(\"$dialogo_id\")'>$idioma_sistema[49]</span>
    ";
	break;
	
	case 3: // aceita ou cancela a solicitacao recebida
	// valida sexo
    if(retorne_sexo_usuario($dados_perfil_logado) == true){
        $texto_dialogo = "$nome_logado$idioma_sistema[51]$nome$idioma_sistema[46]";
	}else{
	    $texto_dialogo = "$nome_logado$idioma_sistema[52]$nome$idioma_sistema[46]";
    };
	// texto de dialogo
	$texto_dialogo = "
	
	<div class='classe_campo_add_amizade_texto'>
	$texto_dialogo
	</div>

	<div class='classe_campo_add_amizade_elementos'>
	
	<div class='classe_campo_add_amizade_elementos_separa'>
	<input type='button' value='$idioma_sistema[32]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 3);'>
	</div>
	
	<div class='classe_campo_add_amizade_elementos_separa'>
	<input type='button' value='$idioma_sistema[53]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 4);'>
	</div>
	
	</div>
	
	";
	// titulo de dialogo
	$titulo_dialogo = $idioma_sistema[57];
	// campo adicionar amizade
    $campo_adicionar = "
    <span class='$classe[0]' title='$idioma_sistema[50]' onclick='exibe_dialogo(\"$dialogo_id\")'>$idioma_sistema[50]</span>
    ";
	break;

	case 4: // desfazer amizade aceita recebida
	// texto de dialogo
	$texto_dialogo = "
	
	<div class='classe_campo_add_amizade_texto'>
	$nome_logado$idioma_sistema[56]$nome$idioma_sistema[46]
	</div>

	<div class='classe_campo_add_amizade_elementos'>
	<input type='button' value='$idioma_sistema[32]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 4);'>
	</div>
	
	";
	// campo adicionar amizade
    $campo_adicionar = "
    <span class='$classe[0]' title='$idioma_sistema[55]' onclick='exibe_dialogo(\"$dialogo_id\")'>$idioma_sistema[55]</span>
    ";
    // titulo de dialogo
	$titulo_dialogo = $idioma_sistema[55];
	break;
	
	case 5: // desfazer amizade aceita enviada
	// texto de dialogo
	$texto_dialogo = "
	
	<div class='classe_campo_add_amizade_texto'>
	$nome_logado$idioma_sistema[56]$nome$idioma_sistema[46]
	</div>
	
	<div class='classe_campo_add_amizade_elementos'>
	<input type='button' value='$idioma_sistema[32]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 5);'>
	</div>
	
	";
	// campo adicionar amizade
    $campo_adicionar = "
    <span class='$classe[0]' title='$idioma_sistema[55]' onclick='exibe_dialogo(\"$dialogo_id\")'>$idioma_sistema[55]</span>
    ";
    // titulo de dialogo
	$titulo_dialogo = $idioma_sistema[55];
	break;
	
	default:
	// solicita email ao adicionar
	$solicita_email = retorna_configuracao_privacidade(0, $idusuario);
	
	// valida sexo de usuario
	if(retorne_sexo_usuario($dados_perfil) == true){
	    $texto_dialogo = "$nome$idioma_sistema[44]";
	}else{
		$texto_dialogo = "$nome$idioma_sistema[54]";
	};

	// valida configuracao
	if($solicita_email == false){

	    // texto de dialogo
	    $texto_dialogo = "
		
	    <div class='classe_campo_add_amizade_texto'>
		$texto_dialogo
		</div>
		
		<div class='classe_campo_add_amizade_elementos'>
	    <input type='button' value='$idioma_sistema[32]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 1);'>
	    </div>
		
		";
	
	}else{

		// texto de dialogo
	    $texto_dialogo = "
		
		<div class='classe_campo_add_amizade_texto' id='$idcampo[2]'>
		$texto_dialogo
		<br>
		$nome_logado$idioma_sistema[160]$nome$idioma_sistema[46]
		</div>

		<div class='classe_campo_add_amizade_elementos'>
		<input type='text' id='$idcampo[1]' placeholder='$idioma_sistema[161]$nome' onkeydown='if(event.keyCode == 13){adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 1);}'>
		<br>
		<input type='button' value='$idioma_sistema[32]' onclick='adicionar_amizade(\"$idusuario\", \"$idcampo[1]\", \"$idcampo[2]\", \"$idcampo[0]\", 1);'>
		</div>
		
		";

	};
	
	// campo adicionar amizade
    $campo_adicionar = "
    <div class='$classe[0]' title='$idioma_sistema[43]' onclick='exibe_dialogo(\"$dialogo_id\")'>
	
	<span class='botao_padrao'>
	$idioma_sistema[43]
	</span>
	
	</div>
    ";
	
    // titulo de dialogo
	$titulo_dialogo = $idioma_sistema[47];

};

// campo dialogo adicionar amizade
$campo_dialogo_adicionar = constroe_dialogo($titulo_dialogo, $texto_dialogo, $dialogo_id);

// html
$html = "
<div class='$classe[1]'>
$campo_adicionar
</div>
";

// valida o modo
if($modo == true){
	
	// dados de retorno
	$dados_retorno["html"] = $html;
	$dados_retorno["dialogo"] = $campo_dialogo_adicionar;

	// retorno
	return $dados_retorno;

}else{
	
	// adiciona dialogo em html
	$html .= $campo_dialogo_adicionar;
	
	// retorno
	return $html;
	
};

};

?>