
// som de sistema
function som_sistema(modo, idcampo_1){

// pasta com sons de sistema
var v_pasta_sons_sistema = v_variaveis_javascript['pasta_sons_sistema'];

// valida o modo
switch(modo){

    case 0:
	// som de nova mensagem de chat
	url_som = v_pasta_sons_sistema + "pling.mp3";
    break;

};

// html
html = "<audio src='" + url_som + "' autoplay>";

// som do sistema
$("#" + idcampo_1).append(html);

};
