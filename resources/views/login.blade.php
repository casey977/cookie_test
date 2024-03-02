<!DOCTYPE html>

<html>
	<head>
		<script src="{{asset('scripts/login.js')}}" defer></script>
	</head>
	<body>
		<div id="PanelLogin">
			<div id="PanelBackground">
				Email: <input type="text" id="Email" value="qwerty@qwerty.com"><br>
				Password: <input type="password" id="Password" value="12345678"><br>
				<input type="button" value="Login" id="Confirm">
				<a href="/join">or become member</a>
			</div>
		</div>
	</body>
</html>