<?php
2	 
3	/* start the session */
4	session_start();
5	 
6	?>
7	 
8	<!DOCTYPE html>
9	<html lang="en">
10	 
11	<head>
12	 <title>Check Login</title>
13	 <meta charset = "utf8" />
14	</head>
15	 
16	<body>
17	 
18	<?php
19	 
20	 $host_db = "SERVER O IP";
21	 $user_db = "USER_BD";
22	 $pass_db = "PASSWORD";
23	 $db_name = "NOMBRE_BD";
24	 $tbl_name = "NOMBRE_TABLA";
25	 
26	// Connect to server and select databse.
27//	mysql_connect("$host_db", "$user_db", "$pass_db")or die("Cannot Connect to Data Base.");
28	 
29	//mysql_select_db("$db_name")or die("Cannot Select Data Base");
30	 
31	// sent from form
32	$username = $_POST['username'];
33	$password = $_POST['password'];
34	 
35//	$sql= "SELECT * FROM $tbl_name WHERE NombreUsuario = '$username' and Password='$password'";
36	 
37	$result=mysql_query($sql);
38	 
39	// counting table row
40	$count = mysql_num_rows($result);
41	// If result matched $username and $password

//Yii::$app->getSecurity()->validatePassword ($password, $hash);
42	 
43	//if($count == 1){

if(Yii::$app->getSecurity()->validatePassword ($password, $username){
44	 
45	 $_SESSION['loggedin'] = true;
46	 $_SESSION['username'] = $username;
47	 $_SESSION['start'] = time();
48	 $_SESSION['expire'] = $_SESSION['start'] + (5 * 60) ;
49	 
50	echo "<br> Bienvenido! " . $_SESSION['username'];
51	 
52	}
53	 else {
54	 echo "<br/>Username o Password estan incorrectos.<br>";
55	 
56	 echo "<a href='main_login.html'>Volver a Intentarlo</a>";
57	}
58	 
59	?>
60	 
61	</body>
62	</html>
- See more at: http://velozityweb.com/blog/php/login-de-usuarios-y-creacion-de-sesiones-con-php-y-mysql/#sthash.JYkAoXNH.dpuf