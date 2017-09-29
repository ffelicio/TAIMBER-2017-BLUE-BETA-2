<?php

// configuracoes de perfil
function configuracoes_perfil(){

// globals
global $idioma_sistema;
global $url_link_acao;
global $tabela_banco;

// modo de configuracao
$modo = retorne_campo_formulario_request(6);

// id de campo de coneudo
$id_campo_conteudo = retorna_idcampo_conteudo_geral();

// id de campo
$idcampo[0] = retorna_idcampo_progresso_gif_geral();

// valida modo
switch($modo){

    case 1:
	$titulo = $idioma_sistema[105];
	$conteudo_configuracao = formulario_altera_senha();
	break;
	
	case 2:
	$titulo = $idioma_sistema[106];
	$conteudo_configuracao = constroe_campo_privacidade();
	break;
	
	case 3:
	$titulo = $idioma_sistema[107];
	$evento[0] = "onclick='carrega_usuarios_bloqueados(\"$id_campo_conteudo\");'";
	break;
	
	case 4:
	$titulo = $idioma_sistema[108];
	$evento[0] = "onclick='carrega_visitas_perfil(\"$id_campo_conteudo\");'";
	break;
	
	case 5:
	$titulo = $idioma_sistema[109];
	$opcoes_adicionais = opcoes_solicitacoes_amizade($id_campo_conteudo);
	$evento[0] = "onclick='carrega_solicitacoes_amizade(\"$id_campo_conteudo\");'";
	remove_notifica(retorne_idusuario_logado(), null, $tabela_banco[6], null);
	break;

	case 6:
	$titulo = $idioma_sistema[110];
	$conteudo_configuracao = campo_limpar_perfil();
	break;
	
	case 7:
	$titulo = $idioma_sistema[154];
	$conteudo_configuracao = campo_excluir_conta();
	break;
	
	case 8:
	$titulo = $idioma_sistema[389];
	$conteudo_configuracao = constroe_campo_alterar_url_usuario(false);
	break;
	
	case 9:
	$titulo = $idioma_sistema[452];
	$conteudo_configuracao = constroe_campo_alterar_email();
	break;
	
    default:
	$titulo = $idioma_sistema[105];
	$conteudo_configuracao = formulario_altera_senha();
	
};

// valida evento de paginacao
if($evento[0] != null){
	
	// progresso
	$progresso[0] = campo_progresso_gif($idcampo[0]);

	// campo de paginacao
    $campo_paginar = "
	$progresso[0]

	<div class='classe_paginador_padrao classe_cor_29 span_link' $evento[0]>
	$idioma_sistema[61]
	</div>
	";

};

// opcoes de configuracoes
$opcoes_configuracoes = constroe_opcoes_configuracoes($modo);

// html
$html = "
<div class='classe_div_titulo_formulario_ed_perfil'>$titulo</div>

<div class='classe_div_campos_formulario_ed_perfil classe_cor_2'>
<div class='classe_opcoes_configuracoes_perfil cor_borda_div'>$opcoes_configuracoes</div>
$opcoes_adicionais
<div class='classe_conteudo_configuracoes_perfil' id='$id_campo_conteudo'>$conteudo_configuracao</div>
$campo_paginar

</div>
";

// retorno
return constroe_conteudo_padrao(true, $html, null);

};

?>