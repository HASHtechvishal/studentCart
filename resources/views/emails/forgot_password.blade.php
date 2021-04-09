<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>email</title>
</head>
<body>
	<table>
		<tr>
			<td>dear {{$name}}!</td>
		</tr>
		<tr>
			<td>you have request to recover your password, new password info is below:</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Password: {{$password}}</td>
		</tr>
		<tr>
			<td>thanks for login,</td>
		</tr>
	</table>
</body>
</html>