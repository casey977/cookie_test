const confirm_button = document.getElementById("Confirm");

console.log(confirm_button);

confirm_button.addEventListener("click", handle_confirm_button);

async function handle_confirm_button() {
	const data = {
		email: document.getElementById("Email").value,
		password: document.getElementById("Password").value,
	}

	const data_stringified = JSON.stringify(data);

	const res = await fetch("/api/login", {
		method: "POST",
		headers: {
			'Content-Type': 'application/json',
			'Accept': 'application/json',
		},
		body: data_stringified
	});

	const resBody = await res.json();
	console.log(resBody);
	console.log(document.cookie);
	window.location.href = "/dashboard";
}