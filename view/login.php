<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Yönetim Paneli</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" href="css/giris.css" />
<script type="text/javascript" src="scripts/jquery-1.6.4.min.js"></script>

<script type="text/javascript"> 
function giris_yap(){
	$(function(){ 
		var sifre = $("#sifre").val();
		var kullanici  = $("#kadi").val(); 
		if(sifre == "" || kullanici == ""){
		 		$("#loader").addClass("error").html("Giriş Başarısız!");
			}else{
				$("#loader").html("<img src='images/loader-giris.png' alt='' />");
				$.ajax({
					url:"controller/proLogin.php",
					data:$("#loginForm").serialize(),
					type:"post",
					success:function(c){
						var res = c.split("|||");
						var class_val = (res[0] == "1" ? "success" : "error");
						$("#loader").addClass(class_val).html(res[1]);
					}	
				});
		}//end if
	});//ready	
} 
</script>
</head>
<body>
 		<div id="header">
        	<div id="header-square">
        	 <div class="header-text">
             	Yönetim Paneli 
             </div>
            </div>
        </div>
 
		<div id="container">
			<form  name="loginForm" id="loginForm" action="javascript:giris_yap();" method="post">
				<div class="login">	<img src="images/lock.png" align="left" alt="" style="margin-top:-10px;"  /> Kullanıcı Girişi </div>
                
				<div class="username-text">Email : </div>
				<div class="password-text">Şifre : </div>
				<div class="username-field">
					<input type="text" name="data[email]" id="kadi" />
				</div>
				<div class="password-field">
					<input type="password" name="data[password]" id="sifre" />
				</div>
                <div class="clear"></div>
                <div id="loader" class="loader"></div>
				<!--<input type="checkbox" name="remember-me" id="remember-me" /><label for="remember-me">Hatırlansın mı ? </label>-->
			 
				<input type="submit" name="submit" value="Giriş" />
		  </form>
		</div>
<div class="clear"></div>
 
</body>
</html>