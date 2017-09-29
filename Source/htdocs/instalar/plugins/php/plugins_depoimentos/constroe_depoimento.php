<?php

// constroe o depoimento
function constroe_depoimento($dados, $modo, $usuario_dono){

// globals
global $idioma_sistema;

// separa os dados
$id = $dados["id"];
$uid = $dados[UID];
$uidamigo = $dados[UIDAMIGO];
$depoimento = html_entity_decode($dados[DEPOIMENTO]);
$aceito = $dados[ACEITO];
$data = converte_data_amigavel(true, $dados[DATA]);

// valida id
if($id == null){
    
	// retorno nulo
    return null;
	
};

// valida o modo
switch($modo){

    case 1:	
    $perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $uid);
    break;

    case 2:	
    $perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $uidamigo);
    break;
	
    default:
	// valida usuario dono do perfil
	if($usuario_dono == true){
		
		// carrega os comentarios que o usuario fez      
	   $perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $uid);

	}else{
		
		// carrega os comentarios que o usuario recebeu		
		$perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $uidamigo);
		
	};
	
};

// valida se bloqueia o conteudo
if(retorna_conteudo_bloqueado($depoimento) == true){
	
	// retorno
	return constroe_caixa(false, retorne_nome_usuario_logado().$idioma_sistema[179]);
	
};

// converte urls
$depoimento = converter_urls(false, $depoimento);

// id de campos
$idcampo[0] = codifica_md5("id_campo_depoimento_$id".data_atual());

// opcoes de depoimento
$opcoes_depoimento = constroe_opcoes_depoimento($dados, $idcampo[0], $usuario_dono);

// html
$html = "
<div class='classe_depoimento_usuario classe_cor_3 cor_borda_div' id='$idcampo[0]'>
<div class='classe_depoimento_usuario_perfil'>$perfil_usuario</div>
<div class='classe_depoimento_usuario_texto'>$depoimento</div>
<div class='classe_depoimento_usuario_data classe_cor_7'>$data</div>
$opcoes_depoimento
</div>
";

// retorno
return $html;

};

?>