<?php

// retorna o array de amigos de usuario
function retorne_array_amigos_usuario($nome_pesquisa){

// globals
global $tabela_banco;

// dados de pesquisa
$nome_pesquisa = converte_minusculo($nome_pesquisa);

// dados compilados do usuario
$dados_compilados_usuario = atualiza_retorna_dados_usuario_logado_sessao();

// array com dados de amigos
$array_amizade = $dados_compilados_usuario[$tabela_banco[6]];

// valida se o valor e array
if(is_array($array_amizade) == false){

    // retorno nulo
    return null;

};

// inverte a ordem do array de amigos
$array_amizade = inverte_array($array_amizade);

// numero de amigos
$numero_amigos = retorne_numero_amigos($array_amizade);

// id de usuario logado
$idusuario = retorne_idusuario_logado();

// contador
$contador = 0;

// extraindo amigos de usuario
for($contador == $contador; $contador <= $numero_amigos; $contador++){

	// dados de array de amigos
	$dados = $array_amizade[$contador];

	// separa os dados
	$id = $dados["id"];
	
	// valida id
	if($id != null){
		
		// id de usuario amigo
		$uidamigo = retorne_idamigo_dados_amigo(true, $dados, $idusuario);

		// nome do usuario
		$nome_usuario = converte_minusculo(retorne_nome_usuario(true, $uidamigo));

		// valida nome de pesquisa
		if($nome_pesquisa == null){
			
			// array de retorno
			$array_retorno[][0] = $uidamigo;
			$array_retorno[][1] = $nome_usuario;
			
		}else{
			
			// valida por nome
			if(retorna_palavra_chave_existe_string($nome_usuario, $nome_pesquisa) == true){
				
				// array de retorno
				$array_retorno[][0] = $uidamigo;
				$array_retorno[][1] = $nome_usuario;

			};
			
			
		};

	};
	
};

// retorno
return $array_retorno;

};

?>