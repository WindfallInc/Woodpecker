<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Windfall's Woodpecker Notification</title>

<style type="text/css">

body {
    background-color: #f7f6eb;
}

body, p, h1, h2, h3, h4, h5 {
    font-family: 'Oswald', sans-serif;
    font-weight:300;
    font-weight:normal;
    color:#333;
}

table {
	border-collapse: collapse;
}

h1 {
    font-size:23px;
    color:#0381b0;
    margin-top:0;
}

h2 {
    font-size:18px;
    color:#333;
    margin-bottom:0;
}

p {
    font-size:14px;
    line-height:21px;
	margin-bottom:21px;
}

a {
    text-decoration:none;
    color: #65bb8a;
}

p a {
	font-weight: bold;
}

.centered {
	text-align:center;
}
</style>
</head>

<body style="background-color: #f2f2f2;font-family: helvetica, arial, sans-serif;font-weight: normal;color: #333;">
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="backgroundTable" style="border-collapse: collapse;">
<tr>
<td align="center" valign="top" style="padding-bottom:20px;">

		<table width="600" border="0" style="border-collapse: collapse;border-radius: 8px;border: solid 1px #e1d9b0;background-color:#fff;">
		  <tbody>
			<tr>
			  	<td style="padding: 40px; background-color: white;">
					@yield('content')
				  </td>
			</tr>
		  </tbody>
		</table>

</td>
</tr>

</table>

</body>
</html>