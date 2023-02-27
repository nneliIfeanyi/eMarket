<style type="text/css">
	.navbar{
		display: flex;
		align-items: center;
		justify-content: space-between;
		padding: 0.7rem 2rem;
		
		z-index: 1;
		width: 100%;
		top: 0;
		border-bottom: solid 1px teal;
		opacity: 0.9;
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

	@media(max-width: 668px){
		.navbar{
		padding: 0.3rem 1rem;
		
		}

		header h1{
		font-size: 16px;

	}
	}

}

</style>




<header class="navbar w3-black">
	<h1>
		<a href="index.php">
			<b><i>Admin Dashboard</i></b>
		</a>
	</h1>

	<ul>
		<!--<li><a href="#" class="w3-tiny"> </a></li>
		<li><a href="customers.php">View Customers</a></li>
		<li><a href="orders.php">Check Orders</a></li>-->
		<li><a href="homepage.php" class="w3-small">Home</a></li>
		<li><a href="logout.php" class="w3-small">Logout</a></li>
	</ul>
</header>
