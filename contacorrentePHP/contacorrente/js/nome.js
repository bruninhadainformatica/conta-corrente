// pergunta ao usuario e atualiza o elemento
function trocarNome() {
	// seleciona os elementos
	var elMsg = document.getElementById('mensagemBemVindo');
	var elNome = document.getElementById('nome_usuario');
	// pede ao usuario que digite o nome
	var nome = prompt('Digite seu nome, por favor') || "fulano";
	// atualiza o texto do elemento
	elNome.innerHTML = nome;
	// atualiza o CSS do elemento
	// elMsg.style.visibility = 'visible';
}

// ao carregar todos os elementos da pagina, depois de 5 segundos
// invoca a funcao que troca o nome do usuario
function onLoaded() {
	// registra no console
	console.log("loaded");
	// apos 1 segundos (1000 ms) invoca a funcao trocar nome
	setTimeout(function () {
		trocarNome();
	}, 1000);
}