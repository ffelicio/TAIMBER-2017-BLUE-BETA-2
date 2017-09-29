<?php

// carrega as solicitacoes de amizade
function carrega_solicitacoes_amizade(){

// globals
global $tabela_banco;

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// contadores de avanco
$contador_avanco = contador_avanco(retorne_campo_formulario_request(2), 1) - NUMERO_VALOR_PAGINACAO;

// limit de query
$limit_query = "limit $contador_avanco, ".NUMERO_VALOR_PAGINACAO;

// modo de solicitacoes
$modo = retorne_campo_formulario_request(14);

// valida modo
if($modo == null){

    // modo padrao
    $modo = 1;	
	
};

// valida modo e constroe query
switch($modo){

    case 1: // query solicitacao enviou
	$query = "select *from $tabela_banco[6] where uid='$idusuario' and aceito='0' order by id desc $limit_query;";
    break;
	
	case 2: // query solicitacao recebeu
	$query = "select *from $tabela_banco[6] where uidamigo='$idusuario' and aceito='0' and uidenviou!='$idusuario' order by id desc $limit_query;";
	break;
	
};

// dados query
$dados_query = plugin_executa_query($query);

// numero de linhas
$numero_linhas = $dados_query["linhas"];

// contador
$contador = 0;

// constroe lista de solicitacoes
for($contador == $contador; $contador <= $numero_linhas; $contador++){
	
	// dados de usuario
	$dados_usuario = $dados_query["dados"][$contador];
	
	// valida modo
	if($modo == 1){
		
		// id de usuario que enviou solicitacao
	    $uid = $dados_usuario[UIDAMIGO];
	
	}else{
		
		// id de usuario que recebeiu solicitacao
		$uid = $dados_usuario[UID];
		
	};
	
	// valida uid
	if($uid != null){
		
		// campo adicionar
		$campo_adicionar = campo_adicionar_pessoa(false, false, $uid);
		
		// perfil de usuario
		$perfil_usuario = constroe_imagem_perfil_miniatura(true, true, $uid);
		
		// campo usuario
		$campo_usuario = "
		<div class='classe_div_perfil_usuario_configuracao classe_cor_3'>
		
		<div class='classe_div_perfil_usuario_configuracao_imagem'>
		$perfil_usuario
		</div>
		
		<div class='classe_div_perfil_usuario_configuracao_opcoes'>
		$campo_adicionar
		</div>
		
		</div>
		";
		
		// atualiza a lista de solicitacoes
	    $lista_solicitacoes .= $campo_usuario;

	};
	
};

// retorno
return $lista_solicitacoes;

};

?>