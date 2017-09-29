
// escreve um depoimento
function escrever_depoimento(idcampo_1, idcampo_2, uidamigo){

// depoimento
var v_depoimento = obtem_valor_campo(idcampo_1, 1);

// setando variaveis globais
v_variaveis_javascript['depoimento_escreveu'] = v_depoimento;
v_variaveis_javascript['uidamigo_depoimento'] = uidamigo;

// limpa campo de depoimento
seta_valor_campo(idcampo_1, null, 2);

// move o foco
document.getElementById(idcampo_1).focus();

// limpa campo de mensagem de sucesso ou erro
document.getElementById(idcampo_2).innerHTML = "";

// valida o depoimento
if(v_depoimento.length == 0 || uidamigo.length == 0){

	// retorno nulo
	return null;
	
};

// escreve o depoimento
executador_acao(null, 34, idcampo_2);

};
