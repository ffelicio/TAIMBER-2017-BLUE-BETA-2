<?php

// retorna o numero de notificacoes
function retorne_numero_notifica($modo){

// modo 0 todos
// modo 1 comentarios
// modo 2 curtidas
// modo 3 maracao de comentarios
// modo 4 marcacao em publicacoes
// modo 5 todas as marcacoes
// modo 6 amizades aceitas

// globals
global $tabela_banco;

// tabela
$tabela[0] = $tabela_banco[24];
$tabela[1] = $tabela_banco[39];

// id de usuario logado
$uid = retorne_idusuario_logado();

// valida o modo
switch($modo){

    case 0:
    $query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0';";
	$query[] = "select *from $tabela[1] where uid='$uid' and aceito='0' and visualizado='0';";
	break;
	
	case 1:
    $query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0' and tabela_notifica!='$tabela_banco[14]' and tabela_acao='$tabela_banco[7]';";
	break;
	
	case 2:
    $query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0' and tabela_acao='$tabela_banco[9]';";
	break;
	
	case 3:
    $query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0' and tabela_notifica='$tabela_banco[14]' and tabela_acao='$tabela_banco[7]';";
	break;
	
	case 4:
	$query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0' and tabela_notifica='$tabela_banco[14]' and tabela_acao='$tabela_banco[5]';";
	break;
	
	case 5:
	$query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0' and tabela_notifica='$tabela_banco[14]';";
	break;
	
	case 6:
	$query[] = "select *from $tabela[0] where uidamigo='$uid' and visualizado='0' and tabela_notifica=-1 and tabela_acao='$tabela_banco[6]';";
	break;
	
};

// numero de notificacoes
$numero_notifica = 0;

// percorrendo querys
foreach($query as $query_executar){
	
	// valida query
	if($query_executar != null){
		
		// atualizando numero de notificacoes
		$numero_notifica += retorne_numero_linhas_query($query_executar);
		
	};
	
};

// retorno
return $numero_notifica;

};

?>