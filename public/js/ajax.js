//Make an AJAX GET call
//Takes in parameters the target URL and the callback function called on success

function ajaxGet(url, callback) {
	let request = new XMLHttpRequest();
	request.open("GET", url);
	request.addEventListener("load", function() {
		if (request.status >= 200 && request.status < 400) {
			//Calls the callback function passing the response to the request
			callback(request.responseText);
			
		} else {
		      console.error(request.status + "" + request.statusText + "" + url);
		}
	});
	request.addEventListener("error", function() {
		console.error("Erreur réseau avec l'URL" + url);
	});
	request.send(null);
}
