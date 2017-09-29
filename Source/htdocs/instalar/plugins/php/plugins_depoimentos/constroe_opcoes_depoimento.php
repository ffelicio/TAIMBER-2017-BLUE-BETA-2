<?php

// constroe opcoes de depoimento
function constroe_opcoes_depoimento($dados, $idcampo_depoimento, $usuario_dono){

// globals
global $idioma_sistema;

// separa os dados
$id = $dados["id"];
$uid = $dados[UID];
$uidamigo = $dados[UIDAMIGO];
$depoimento = $dados[DEPOIMENTO];
$aceito = $dados[ACEITO];
$data = converte_data_amigavel(true, $dados[DATA]);

// retorna se pode excluir o depoimento
if(retorne_pode_excluir_depoimento($dados) == false){
	
	// retorno nulo
    return null;
	
};

// nome de usuario
$nome_usuario = retorne_nome_usuario_logado();

// id de dialogo
$id_dialogo[0] = codifica_md5("id_dialogo_aceita_depoimento_$id".data_atual());

// id de campos
$idcampo[0] = codifica_md5("id_campo_opcao_depoimento_$id".data_atual());

// eventos
$evento[0] = "onclick='excluir_aceitar_depoimento(\"$id\", \"$idcampo[0]\", \"$idcampo_depoimento\", \"1\");'";
$evento[1] = "onclick='excluir_aceitar_depoimento(\"$id\", \"$idcampo[0]\", \"$idcampo_depoimento\", \"2\");'";

// valida depoimento aceito
if($aceito == 1){
	
	// campo aceita
	$campo_aceita = "
	<div class='classe_campo_opcao_depoimento_titulo'>
	$nome_usuario$idioma_sistema[198]
	</div>
	
	<div class='classe_campo_opcao_depoimento_botao'>
	<input type='button' value='$idioma_sistema[32]' $evento[0]>
	</div>
	";
	
	// adiciona dialogo
	$campo_aceita = constroe_dialogo($idioma_sistema[199], $campo_aceita, $id_dialogo[0]);
	
	// campo aceita
	$campo_aceita = "
	<span class='span_link' onclick='exibe_dialogo(\"$id_dialogo[0]\");'>$idioma_sistema[29]</span>
	$campo_aceita
	";
	
}else{

	// campo aceita
	$campo_aceita = "
	<div class='classe_campo_opcao_depoimento_titulo'>
	$nome_usuario$idioma_sistema[201]
	</div>
	
	<div class='classe_campo_opcao_depoimento_botao'>
	<input type='button' value='$idioma_sistema[32]' $evento[1]>
	<input type='button' value='$idioma_sistema[53]' $evento[0]>
	</div>
	";
	
	// adiciona dialogo
	$campo_aceita = constroe_dialogo($idioma_sistema[200], $campo_aceita, $id_dialogo[0]);
	
	// campo aceita
	$campo_aceita = "
	<span class='span_link' onclick='exibe_dialogo(\"$id_dialogo[0]\");'>$idioma_sistema[202]</span>
	$campo_aceita
	";	
	
};

// campo aceita depoimento, neste caso excluir o depoimento
if($uidamigo == retorne_idusuario_logado()){

	// campo aceita
	$campo_aceita = "
	<div class='classe_campo_opcao_depoimento_titulo'>
	$nome_usuario$idioma_sistema[198]
	</div>
	
	<div class='classe_campo_opcao_depoimento_botao'>
	<input type='button' value='$idioma_sistema[32]' $evento[0]>
	</div>
	";
	
	// adiciona dialogo
	$campo_aceita = constroe_dialogo($idioma_sistema[199], $campo_aceita, $id_dialogo[0]);
	
	// campo aceita
	$campo_aceita = "
	<span class='span_link' onclick='exibe_dialogo(\"$id_dialogo[0]\");'>$idioma_sistema[29]</span>
	$campo_aceita
	";	

};

// html
$html = "
<div class='classe_campo_opcao_depoimento' id='$idcampo[0]'>
$campo_aceita
</div>
";

// retorno
return $html;

};

?>