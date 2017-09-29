<?php

// visualiza o perfil do usuario
function visualizar_perfil_usuario(){

// globals
global $idioma_sistema;
global $variavel_campo;
global $tabela_banco;

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// separa os dados do perfil
$dados_perfil = $dados_compilados_usuario[$tabela_banco[1]];

// array com campos
$array_campos = explode(",", $idioma_sistema[10]);

// array com campos de tabelas
$array_campos_tabela = explode(",", CAMPO_TABELA_PERFIL_CORPO);

// contador
$contador = 0;

// id de usuario via requeste
$uid = retorne_idusuario_request();

// tipo de acao
$tipo_acao = retorne_tipo_acao_pagina();

// estado do usuario
$estado_usuario = $dados_perfil[ESTADO];
$cidade_usuario = $dados_perfil[CIDADE];

// lista campos disponiveis
foreach($array_campos as $campo){
	
	// valida campo
    if($campo != null){
	
	    // campo de tabela
	    $campo_tabela = $array_campos_tabela[$contador];
	
	    // trata o campo do formulario
	    $campo_tabela = trata_campo_tabela($campo_tabela, false);

	    // valor de campo
	    $valor_campo = $dados_perfil[$campo_tabela];
		$valor_campo_original = $dados_perfil[$campo_tabela];
		
		// valida contador
		switch($contador){
		
			case 2:
			$valor_campo = retorne_sexo_texto_usuario($dados_perfil);
			break;

		};
		
	    // converte para link de pesquisa
	    $valor_campo = constroe_link_pesquisa($valor_campo, $campo_tabela, $valor_campo_original);
	
	    // campos de perfil
	    $campos_perfil .= "
	    <div class='classe_div_perfil_completo_usuario_separa'>
	    <div class='classe_div_perfil_completo_usuario_descricao'>$campo -</div>
	    <div class='classe_div_perfil_completo_usuario_valor'>$valor_campo</div>
	    </div>
	    ";
	
	    // atualiza o contador
	    $contador++;
	
};

};

// limpa campos
$campo = null;

// valida tipo de acao
if($tipo_acao != 3){

	// pagina inicial
	$pagina_inicial = PAGINA_INICIAL;

	// campo visualizar perfil
	$campo[0] = "
	<div class='classe_div_perfil_completo_usuario_visualizar_completo classe_cor_8'>
	<a href='$pagina_inicial?$variavel_campo[5]=$uid&$variavel_campo[2]=3' title='$idioma_sistema[565]'>$idioma_sistema[565]</a>
	</div>
	";

};

// valida cidade e estado
if($cidade_usuario != null and $estado_usuario != null){
	
	// constroe mapa
	$mapa[0] = constroe_mapa($cidade_usuario, $estado_usuario);

};

// html
$html = "
<div class='classe_div_perfil_completo_usuario classe_cor_2'>

$campo[0]
$campos_perfil
$mapa[0]

</div>
";

// retorno
return $html;

};

?>