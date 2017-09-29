
// adiciona emoticon em campo especifico
function adicionar_emoticon_campo(url, idcampo_1){

// posicao atual do cursor
var v_posicao = v_variaveis_javascript['posicao_atual_cursor_emoticon'];

// html
var v_html = "<img src='" + url + "'>";

// adiciona imagem em campo
$("#" + idcampo_1).append(v_html);

};
