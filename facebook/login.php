<?php
session_start();
include 'config.php';
if (isset($_POST['email'], $_POST['pass'])) {
	$email = mysql_real_escape_string($_POST['email']);
	$pass = md5($_POST['pass']);
	$query = "SELECT * FROM admin WHERE email= '".$email."' AND password= '".$pass."'";
	$res = mysql_query($query);
	if ($result=mysql_num_rows($res)==0) {
		header("location:login.php?msg=Ricontrollare i dati inseriti Username o Password non Corretti");
		
	}else{
	$admin = mysql_fetch_array($res);
	//$_SESSION['info'] = array('nome' => $user->nome,'pass'=> $user->password,'ruolo'=> $user->ruolo,'id'=> $user->idutente);
	setcookie("admin", "1", time() + (60 * 60 * 24 * 365));
	$_SESSION['admin'] = $admin['nome'];
	header("location:index.php");
	// if(!isset($_SESSION['utente'])){
	// mkdir($user['nome'].".".$user['cognome'].$user['idclienti']);
	// /*opendir($_SESSION['utente']['folder'].$_SESSION['utente']['id']);*/
	// header('location:userPage.php');
	// }else{
	// $_SESSION['utente']=array('nome' => $user['nome'],'id'=> $user['idclienti'],'folder'=>$user['nome'].".".$user['cognome']);
	// /*opendir($_SESSION['utente']['folder'].$_SESSION['utente']['id']);*/

	?>
		<?php
	}
}
		// if (isset($_POST['email'],$_POST['pass']))
		// {
			// $email=mysql_real_escape_string($_POST['email']);
			// $pass=md5($_POST['pass']);
			// $query="SELECT * FROM amministratori WHERE username= '$email' AND password= '$pass'";
			// $res=mysql_query($query);
			// if (!$res)
			// {
				// mysql_error();
// 				
			// }
			// $admin=mysql_fetch_array($res);
			// //$_SESSION['info'] = array('nome' => $user->nome,'pass'=> $user->password,'ruolo'=> $user->ruolo,'id'=> $user->idutente);
		// setcookie("admin","2".md5("admin"),time()+(60*60*24*365),"/EcoCalore2012");
			// $_SESSION['admin']=array('nome' => $admin['username'],'id'=> $admin['idamministratori']);
			// header('location:adminPage.php');
		// }
?>

 <?php
include "header2.php";
include "navigation.php";
?>
<div id="title">
<h1>Log In</h1>
<div>
<div class="login_box" style=" margin-bottom: 20px; ">
	<form method="post" action="" class="login_form" style=" width: 700px; margin: 0px auto; text-align: center; border: 1px solid #eee; background-color: #f5f5f5; ">
		<p>
			<label for="nome_utente" style=" font-size: 18px;">Email</label>
			<input type="text" size="10" id="nome_utente" name="email" value="" style=" margin: 10px 0px 10px 35px; width: 200px; height: 30px; font-size: 14px; ">
		</p>
		<p>
			<label for="password" style=" font-size: 18px;">Password</label>
			<input type="password" size="10" id="password" name="pass" value="" style=" margin: 10px 0px 10px 0px; width: 200px; height: 30px; font-size: 14px; ">
		</p>
		<p><input type="submit" name="login" id="login" value="LOGIN" style=" /* margin-left: 610px; */ width: 200px; margin: 0px 10px 0px 90px; "></p>
	</form>
</div>
</div>
</div>
<div>
<?php
if(isset($_GET['msg'])){
	$msg = mysql_real_escape_string($_GET['msg']);
?>
<h3><?= $msg ?></h3>
<?php	
}
 ?>
</div>

<?php
include "navigation_bottom.php";
?>
</body>
</html>