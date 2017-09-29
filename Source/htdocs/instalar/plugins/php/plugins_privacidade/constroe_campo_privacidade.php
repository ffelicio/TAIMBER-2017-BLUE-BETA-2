<?php

// constroe o campo de privacidade
function constroe_campo_privacidade(){

// globals
global $idioma_sistema;
global $tabela_banco;
global $variavel_campo;

// valida usuario dono do perfil
if(retorne_usuario_dono_perfil(retorne_idusuario_request()) == false){

    // retorno nulo
    return null;
	
};

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_sessao(false, false);

// separa os dados do perfil
$dados_perfil = $dados_compilados_usuario[$tabela_banco[12]];

// array com campos
$array_campos = explode(",", $idioma_sistema[158]);

// array com campos de tabelas
$array_campos_tabela = explode(",", CAMPO_TABELA_PRIVACIDADE_CORPO);

// contador
$contador = 0;

// lista campos disponiveis
foreach($array_campos as $campo){

// valida campo
if($campo != null){
	
	// campo de tabela
	$campo_tabela = $array_campos_tabela[$contador];
	
	// trata o campo do formulario
	$campo_tabela = trata_campo_tabela($campo_tabela, false);
	
	// nome de campo elemento html
	$campo_elemento_nome = "campo_edita_perfil_$campo_tabela";
    
	// valor de campo
	$valor_campo = $dados_perfil[$campo_tabela];
	
	// atualiza o contador
	$contador++;

	// trata o campo
	$campo = trata_campo_tabela($campo, false);

	// descricao
	$descricao = $array_campos[$contador - 1];
	
	// valida o campo de notícias, e por padrão desabilita em caso de nenhuma configuração
	if($contador == 11 and $valor_campo == null){
		
		// desabilita as notícias em caso de nenhuma configuração
		$valor_campo = true;
		
	};
	
	// valida tipo de campo de formulario
	switch($contador){
		
		case 4:
		$campos_html .= "
		<div class='classe_separa_campo_formulario_edita_privacidade'>
			<textarea cols='10' rows='10' placeholder='$descricao' name='$campo_elemento_nome'>$valor_campo</textarea>
		</div>
		";
		break;

		default: // checkbox
		$icampo[0] = codifica_md5($campo_elemento_nome.data_atual());
		$icampo[1] = codifica_md5(data_atual().$campo_elemento_nome);

		// valida configuracao
		if($valor_campo == true){
			// configuracao setado
		    $setado = "checked";
		}else{
			// configuracao setado
			$setado = null;
		};

		// eventos
		$eventos[0] = "onchange='seta_valor_checkbox_campo_privacidade(\"$icampo[0]\", \"$icampo[1]\");'";
		
		// campos html
		$campos_html .= "
		<input type='hidden' name='$campo_elemento_nome' id='$icampo[0]' value='$valor_campo'>
			
			<div class='classe_separa_campo_formulario_edita_privacidade'>
			
				<div class='classe_separa_campo_formulario_edita_privacidade_switch'>
				
					<label class='switch'>
						<input type='checkbox' id='$icampo[1]' $setado $eventos[0]>
						<div class='slider round'></div>
					</label>
					
				</div>
				
			<span>
				$descricao
			</span>
			
		</div>
		";
		
	};
	
	};

};

// url de pagina de acoes
$url_pagina_acoes = PAGINA_ACOES;

// html
$html = "
<div class='classe_edita_perfil_privacidade_titulo classe_cor_3'>$idioma_sistema[159]</div>
	<form action='$url_pagina_acoes' method='POST'>
		<input type='hidden' name='$variavel_campo[2]' value='33'>

		<div class='classe_div_campos_formulario_ed_perfil classe_cor_2'>
			$campos_html
		</div>
		
		<div class='classe_div_salvar_formulario_ed_perfil cor_borda_div'>

		<input type='submit' value='$idioma_sistema[12]' onclick='executador_acao(null, 3, null);'>

	</form>
</div>
";

// retorno
return $html;

};

?>