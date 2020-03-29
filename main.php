<?php
session_start();

$login = 0;
if (isset($_COOKIE['username'])){
    if ($_COOKIE['username'] == $_SESSION['username'] 
    && $_COOKIE['password'] == $_SESSION['password']){
        $login = 1;
        
    } else {
    	$login = 0;
    }
} else {
    $login = 0;
}

$module = "";
if (isset($_GET['module'])){
    $module = $_GET['module'];
} else {
    $module = 'home';
}

$categoryArray=array("Book","Clothes","Electronics","Game","Work","Decoration","Others");
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Barter Fly</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link href='../css/fonts.css' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/leaflet.css" />
		<link rel="stylesheet" href="../css/main.css">

        <script src="../js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script type="text/javascript">
			function validatePost(f){
				
	            var valid = true;
	            if (f.PostTitle.value == ""){
	                document.getElementById('PostTitleMsg').innerHTML = "Please input your post title";
	                valid = false;
	               
	            } else {
	                document.getElementById('PostTitleMsg').innerHTML = "";
	            }
	            
	            
	            if (f.Description.value == ""){
	                document.getElementById('DescriptionMsg').innerHTML = "Please input the discription of the product";
	                valid = false;
	               
	            } else {
	                document.getElementById('DescriptionMsg').innerHTML = "";
	            }
	            
	            if (f.Category.value == ""){
	                document.getElementById('CategoryMsg').innerHTML = "Please input cataory";
	                valid = false;
	              
	            } else {
	                document.getElementById('CategoryMsg').innerHTML = "";
	            }
	            
	             return valid;
	
	        }
	       
		
			function search(mode,category)  {
				//mode: 0 Title/ 1 Category
		 	    var xmlHttp=null;
		        if(window.XMLHttpRequest){
		            xmlHttp=new XMLHttpRequest();
		        }
		        else if(window.ActiveXObject){
		            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		        }
		        if(xmlHttp!=null){
		            
		            xmlHttp.onreadystatechange=function()
		            {
		                if(xmlHttp.readyState==4)
		                {
		                    document.getElementById("searchMessage").innerHTML=xmlHttp.responseText;
		                }
		            }
		            var url;
		            if (mode==0){
		            	if(document.getElementById("searchTitle").value=="")
		            	{
		            		document.getElementById("searchMessage").innerHTML="<div class='error-page-wrapper'>Please input your criteria</div>";
		            		return;
		            	}
		            	else
		            		{
		            			url="../server/search.php?Mode=0&PostTitle="+document.getElementById("searchTitle").value;
		            		}
		            }
		            if (mode==1)
		            	url="../server/search.php?Mode=1&Category="+category;
		            xmlHttp.open("GET",url,true);
		            xmlHttp.send(null);
		        }
			}
		</script>
    </head>
    <body>

        <!-- Navigation & Logo-->
        <div class="mainmenu-wrapper">
	        <div class="container">
	        	<div class="menuextras extras">
					<ul>
							<?php if ($login == 1) { ?> 
				        <div> Welcome, 
				        	<a href="personal.php?module=info" target="_self"><?=$_COOKIE['username']?></a>   
				        	<span>&nbsp;&nbsp;</span>
				        	[<a href="logout.php?">Logout</a>]
				        </div>
				        
				            <?php } else { ?> 
				        <span style='cursor: pointer' onclick="gotoLogin('main.php?module=<?=$module?>')" >Login</span>
				            <?php } ?>
         
		        	</ul>
		        </div>
		        <nav id="mainmenu" class="mainmenu">
					<ul>
						<li class="logo-wrapper"><a href="../index.php"><img src="../img/logo.png" alt="LOGO IMG"></a></li>
						<li <?php if ($module=='home' ) {echo 'class="active"'; }?>>
							<a href="main.php?">HOME</a>
						</li>
						<li <?php if ($module=='search') {echo 'class="active"'; }?>>
							<a href="main.php?module=search">SEARCH</a>
						</li>
						<li <?php if ($module=='buy') {echo 'class="active"'; }?>>
							<a href="main.php?module=buy">BUY</a>
						</li>
						<li <?php if ($module=='sell') {echo 'class="active"'; }?>>
							<a href="main.php?module=sell">SELL</a>
						</li>
						<!--li>
							<a href="personal.php?">PERSONAL</a>
						</li-->
					</ul>
				</nav>
			</div>
		</div>
 
<?php
    
	    switch ($module) {
		case 'home': require('main_home.php');break;
		case 'buy': require('main_buy.php');break;
		case 'search': require('main_search.php');break;
		case 'sell': require('main_sell.php');break;

		default: require('pagenotfound.php');
	}
?>
	
<?php
	require('frame_footer.php');
?>
	
        <!-- Javascripts -->
        <script src="../js/jquery-1.9.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/leaflet.js"></script>
        <script src="../js/jquery.fitvids.js"></script>
        <script src="../js/jquery.sequence-min.js"></script>
        <script src="../js/jquery.bxslider.js"></script>
        <script src="../js/main-menu.js"></script>
        <script src="../js/template.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>