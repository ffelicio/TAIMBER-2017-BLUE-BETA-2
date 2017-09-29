
// seta uma classe em todos os elementos
function seta_elementos_classe(classe_1, classe_2, classe_3){

// classe_1 e a classe a ser pesquisada
// classe_2 e a classe a ser removida
// classe_3 e a classe a ser adicionada

// pegando elementos
var elements = document.getElementsByClassName(classe_1);

// obtendo elementos
for(var i = 0; i < elements.length; i++){

	// id de campo
    var idcampo_1 = $(elements[i]).attr("id");

	// remove classes antigas
	$("#" + idcampo_1).removeClass(classe_2);
	$("#" + idcampo_1).removeClass(classe_3);

};

};
