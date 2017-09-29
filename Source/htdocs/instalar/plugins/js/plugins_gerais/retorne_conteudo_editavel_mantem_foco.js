
// retorna se algum conteudo editável mantem o foco
// usado mais na hora de paginar as imagens do album
// quando se está editando um conteudo e move com as teclas não deixa paginar!
function retorne_conteudo_editavel_mantem_foco(){

// conteudo editável
var contenteditable = document.querySelector('[contenteditable]'), text = contenteditable.textContent;

// valida e retorna
if(text.length > 0){
	
	// está com foco em um conteudo de div editável
	return true;
	
}else{
	
	// está sem foco
	return false;
	
};

};
