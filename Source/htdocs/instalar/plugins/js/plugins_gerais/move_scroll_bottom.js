
// move o scroll para o rodape ou bottom
function move_scroll_bottom(idcampo_1){

// move para bottom
$("#" + idcampo_1).animate({ scrollTop: $("#" + idcampo_1)[0].scrollHeight}, 1000);
  
};
