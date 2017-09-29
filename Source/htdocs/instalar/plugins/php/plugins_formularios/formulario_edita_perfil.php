<?php

// formulario edita perfil de usuario
function formulario_edita_perfil(){

// globals
global $idioma_sistema;
global $variavel_campo;
global $tabela_banco;

// valida usuario dono do perfil
if(retorne_usuario_dono_perfil(retorne_idusuario_request()) == false){

    // retorno nulo
    return null;
	
};

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

// funcoes
$funcao[0] = "auto_ajustar_campo_textarea(this);";

// eventos
$evento[0] = "onkeyup='$funcao[0]'";

// lista campos disponiveis
foreach($array_campos as $campo){

	// campo especial nao aplicado
	$campo_especial = false;

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
		
	};

	// valida tipo de campo padrao
	if(($contador >= 15 and $contador <= 22 and $campo != null) or $contador == 29){
		
		// campos do html
		$campos_html .= "
		<div class='classe_separa_campo_formulario_edita_perfil'>
		<span>$campo:</span>
		<textarea name='$campo_elemento_nome' $evento[0]>$valor_campo</textarea>
		</div>
		";

		// campo especial aplicado
		$campo_especial = true;
		
	};

	// valida campo
	if($campo != null){
	    
		// valida contador
		switch($contador){
        
			case 2:
			$campo_select_option = gerador_select_option_especial($idioma_sistema[36], $idioma_sistema[388], $valor_campo, $campo_elemento_nome, null, null);
			$campos_html .= "
			<div class='classe_separa_campo_formulario_edita_perfil'>
			<span>$campo:</span>
			$campo_select_option
			</div>		
			";
			break;
			
			case 3:
			if(retorne_sexo_usuario($dados_perfil) == true){
				$campo_select_option = gerador_select_option($idioma_sistema[37], $valor_campo, $campo_elemento_nome, null, null);
			}else{
				$campo_select_option = gerador_select_option($idioma_sistema[38], $valor_campo, $campo_elemento_nome, null, null);
			};
			$campos_html .= "
			<div class='classe_separa_campo_formulario_edita_perfil'>
			<span>$campo:</span>
			$campo_select_option
			</div>		
			";
			break;
			
			case 6:
			$campo_select_option = gerador_select_option($idioma_sistema[39], $valor_campo, $campo_elemento_nome, null, null);
			$campos_html .= "
			<div class='classe_separa_campo_formulario_edita_perfil'>
			<span>$campo:</span>
			$campo_select_option
			</div>		
			";
			break;
			
			case 26:
			$campo_select_option = gerador_select_option($idioma_sistema[40], $valor_campo, $campo_elemento_nome, null, null);
			$campos_html .= "
			<div class='classe_separa_campo_formulario_edita_perfil'>
			<span>$campo:</span>
			$campo_select_option
			</div>		
			";
			break;
			
			case 27:
			$campo_select_option = gerador_select_option($idioma_sistema[41], $valor_campo, $campo_elemento_nome, null, null);
			$campos_html .= "
			<div class='classe_separa_campo_formulario_edita_perfil'>
			<span>$campo:</span>
			$campo_select_option
			</div>		
			";
			break;
			
			case 4:
			$campo_select_option = campo_data($campo_elemento_nome, $valor_campo);
			$campos_html .= "
			<div class='classe_separa_campo_formulario_edita_perfil'>
			<span>$campo:</span>
			$campo_select_option
			</div>		
			";
			break;
			
			default:
			// valida campo especial aplicado
			if($campo_especial == false){
			
				// campos do html
				$campos_html .= "
				<div class='classe_separa_campo_formulario_edita_perfil'>
				<span>$campo:</span>
				<input type='text' name='$campo_elemento_nome' value='$valor_campo'>
				</div>
				";
				
			};
			
	};

	    // atualiza o contador
		$contador++;
		
	};
	
};

// url de pagina de acoes
$url_pagina_acoes = PAGINA_ACOES;

// html
$html = "
<form action='$url_pagina_acoes' method='POST'>
<input type='hidden' name='$variavel_campo[2]' value='3'>
<input type='hidden' name='$variavel_campo[6]' value='1'>

<div class='classe_div_campos_formulario_ed_perfil'>
$campos_html
</div>

<div class='classe_div_salvar_formulario_ed_perfil'>
<input type='submit' value='$idioma_sistema[12]'>
</form>

</div>
";

// retorno
return $html;

};

?>