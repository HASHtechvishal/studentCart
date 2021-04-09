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
			<td>welcome to ecom website your account details are as below :</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>name: {{$name}}</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>mobile: {{$mobile}}</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Email: {{$email}}</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Password: ******* (as chosen by you)</td>
		</tr>
		<tr>
			<td>thanks for login,</td>
		</tr>
	</table>
</body>
</html>