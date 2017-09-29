
// insere texto em campo de entrada
function inserir_texto_campo_entrada(idcampo_1, texto){
	
var txtarea = document.getElementById(idcampo_1);
if(!txtarea){ return; }

var scrollPos = txtarea.scrollTop;
var strPos = 0;
var br =((txtarea.selectionStart || txtarea.selectionStart == '0') ? "ff" :(document.selection ? "ie" : false));

if(br == "ie"){
	
	txtarea.focus();
	var range = document.selection.createRange();
	range.moveStart('character', -txtarea.value.length);
	strPos = range.texto.length;
	
}else if(br == "ff"){
	
	strPos = txtarea.selectionStart;
	
}

var front =(txtarea.value).substring(0, strPos);
var back =(txtarea.value).substring(strPos, txtarea.value.length);
txtarea.value = front + texto + back;
strPos = strPos + texto.length;

if(br == "ie"){
	
	txtarea.focus();
	var ieRange = document.selection.createRange();
	ieRange.moveStart('character', -txtarea.value.length);
	ieRange.moveStart('character', strPos);
	ieRange.moveEnd('character', 0);
	ieRange.select();
	
}else if(br == "ff"){
	
	txtarea.selectionStart = strPos;
	txtarea.selectionEnd = strPos;
	txtarea.focus();
	
}

txtarea.scrollTop = scrollPos;

};
