<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title></title>
	<style type="text/css">
		.navbar{
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 0.7rem 2rem;
			top: 0;
			left: 0;
			z-index: 1;
			width: 100%;
			/*border-bottom: solid 3px white;*/
			opacity: 0.97;
		}

		header h1{
			font-size: 20px;

		}

		header h1 a{

			text-decoration: none;
		}

		header ul{
			list-style: none;
			display: flex;

		}

		header ul a{
			color: wheat;
			box-shadow: 2px 1px 3px teal;
			padding: 0.25rem;
			margin: 0 0.25rem;
			text-decoration: none;
		}

		header ul a:hover{
			color: teal;
			border-bottom: 2px solid teal;
			
		}

		header ul a img:hover{
			filter: invert(50%);
			
		}


	</style>
</head>
<body>

	<header class="navbar w3-black">
		<h1>
			<a href="index.php">
				<i>Stanvic</i>
			</a>
		</h1>

		<ul class="w3-small w3-hide-small">
			<li><a href="index.php">Categories</a></li>
			<li><a href="logout.php">About</a></li>
			<li><a href="login.php">Login</a></li>
		</ul>



		<!--the dropdown menu for small screens-->
		<nav class="w3-col s2 w3-hide-medium w3-hide-large">
			<div class="w3-right">
				<a href="#"  onclick="myFunction('Demo1')" class="w3-btn"><img src="img/menu-icon.png" height="16" width="27"></a>
			</div>
		</nav>

	</header>



	<div class="w3-padding w3-text-light-grey w3-black w3-hide w3-hide-medium w3-hide-large w3-animate-top" id="Demo1">
				
		<ul class="w3-ul" style="border-top: none;">
			<li class=" w3-block w3-button"><a href="index.html" class="w3-hover-lightgrey w3-left-align w3-button w3-block"><i>Home</i></a></li>
			
			<li class="w3-block w3-button"><a href="about_us.html" class="w3-hover-lightgrey w3-left-align w3-button w3-block"><i>About</i></a></li>

			<li class="w3-block w3-button"><a href="#contact" class="w3-hover-lightgrey w3-left-align w3-button w3-block"><i>Login</i></a></li>
		</ul>
	</div>
	<!--header ends-->

<script type="text/javascript">
	
  function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
    } else { 
      x.className = x.className.replace(" w3-show", "");
    }
  }
</script>

</body>
</html>