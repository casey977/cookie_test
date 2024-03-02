const confirm_button = document.getElementById("Confirm");

confirm_button.addEventListener("click", handle_confirm_button);

async function handle_confirm_button(event) {

	const data = {
		email: document.getElementById("Email").value,
		email2: document.getElementById("Email2").value,
		password: document.getElementById("Password").value,
		password2: document.getElementById("Password2").value,
	}

	data_stringified = JSON.stringify(data);

	console.log(data_stringified);

	const res = await fetch("/api/create_user", {
		method: "POST",
		headers: {
			'Content-Type': 'application/json',
			'Accept': 'application/json',
		},
		body: data_stringified
	});	
}