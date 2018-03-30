window.onload = (function(){

	notificacoes_request_permission();

	document.querySelector('#notificacao1').addEventListener('click', function() {
		var opt = {
			body: "aaaaa",
			//icon: "alerta.png"
		}
		notificacoes("Uma nova mensagem", opt)
	}, false);
});