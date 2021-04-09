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
			<td>please click on below link to activate your account :</td>
		</tr>
		
		<tr>
			<td><a href="{{url('confirm/'.$code)}}">confirm account</a></td>
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