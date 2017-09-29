<?php

// função para reposicionar a capa
function reposicionar_capa(){

// globals
global $tabela_banco;

// dados do formulário
$modo = retorne_campo_formulario_request(6);
$idcampo = retorne_campo_formulario_request(21);
$altura_capa = retorne_campo_formulario_request(59);

// id de usuário logado
$uid = retorne_idusuario_logado();

// página via request
$pagina = retorne_idpagina_request();

// modo página
$modo_pagina = retorne_modo_pagina();

// valida o modo de página
if($modo_pagina == true){

	// valida se o usuário é dono da página
	if(retorne_usuario_dono_pagina($uid, $pagina) == false){
		
		// retorno nulo
		return null;
		
	};
	
	// tabela do banco de dados
	$tabela = $tabela_banco[21];
	
	// query
	$query = "select *from $tabela where id='$pagina';";

}else{
	
	// tabela do banco de dados
	$tabela = $tabela_banco[3];
	
	// query
	$query = "select *from $tabela where uid='$uid';";

};

// dados da query
$dados = retorne_dados_query($query);

// separa os dados
$topo = $dados[TOPO];
$url_root_grande = $dados[URL_ROOT_GRANDE];

// obtem largura e a altura da imagem
list($largura, $altura) = getimagesize($url_root_grande);

// valida o modo
switch($modo){

	case 1: // topo
		$topo -= NUMERO_PIXELS_INCREMENTA_ATUALIZAR_CAPA;
	break;
	
	case 2: // fundo
		$topo += NUMERO_PIXELS_INCREMENTA_ATUALIZAR_CAPA;
	break;

};

// valida topo
if($topo >= NUMERO_PIXELS_INCREMENTA_ATUALIZAR_CAPA){
	
	// valor padrão
	$topo = 0;
	
};

// calculando alturas
$altura_1 = ($altura - $altura_capa);
$altura_2 = abs($topo);

// valida alturas e modo
if($altura_2 > $altura_1 and $modo == 1){
	
	// retorno
	return null;
	
};

// valida topo
if($topo <= NUMERO_PIXELS_INCREMENTA_ATUALIZAR_CAPA_PARAR){
	
	// retorno nulo
	return null;
	
};

// valida o modo da página
if($modo_pagina == true){
	
	// query
	$query = "update $tabela set topo='$topo' where id='$pagina';";
	
}else{
	
	// query
	$query = "update $tabela set topo='$topo' where uid='$uid';";
	
};

// roda a query
retorne_dados_query($query);

// adiciona pixels aos valores
$topo .= "px";

// atualiza o array de retorno
$array_retorno["dados"] = "
<script>
	document.getElementById(\"$idcampo\").style.backgroundPosition = '50% $topo';
</script>

";

// retorno
return json_encode($array_retorno);

};

?>