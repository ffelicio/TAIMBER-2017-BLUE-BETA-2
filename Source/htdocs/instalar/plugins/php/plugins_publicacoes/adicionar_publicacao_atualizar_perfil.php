<?php

// adiciona uma publicacao ao atualizar o perfil
function adicionar_publicacao_atualizar_perfil(){

// globals
global $idioma_sistema;
global $variavel_campo;
global $tabela_banco;
global $codigos_especiais;

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

// dados novos
$dados_novos = false;

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
		
		// valor de requeste
		$valor_requeste = remove_html($_REQUEST[$campo_elemento_nome]);

		// valida o tipo de campo que sera atualizado
		switch(converte_campo_perfil_numero_texto($campo)){
			
			case 2:
			// descobre o sexo do usuario ao inves do numero
			$valor_requeste = retorne_modo_sexo_usuario($valor_requeste);
			break;

		};

		// campo data
		if($contador == 4){

			// valores de request
			$dia = retorne_campo_formulario_request(37);
			$mes = retorne_campo_formulario_request(38);
			$ano = retorne_campo_formulario_request(39);

			// valor de requeste
			$valor_requeste = $dia.$codigos_especiais[10].$mes.$codigos_especiais[10].$ano;

		};
			
		// valida alteracoes
		if($valor_campo != $valor_requeste){
			
			// atualiza a lista
			$lista .= $codigos_especiais[0].$codigos_especiais[4].$campo.$codigos_especiais[5].$idioma_sistema[325].$valor_requeste.$codigos_especiais[1];
			
			// informa que atualizou dados novos
			$dados_novos = true;
			
		};

		// atualiza o contador
		$contador++;
		
	};

};

// valida dados novos
if($dados_novos == true){
	
	// atualiza a lista com nome de usuario
	$array_publicacao[TEXTO] = $codigos_especiais[8].retorne_nome_usuario_logado().$idioma_sistema[324].$codigos_especiais[1].$lista;

};

// publica o conteudo de usuario
publicar_conteudo_usuario($array_publicacao, 3);

};

?>