<?php 
// SOLANO, Meryll Dayne B.
// ITMC231 Platform Technologies
// BS IT - 2ND YEAR
// Final Requirement
// Honor Code:
// This is my not fully my own work and I have received some help from the internet that helped in completing this. 
// I have integrated some ideas that I have found available on the internet.
// I sked help from my classmates and friends, while some, I just get the ideas from internet resources.
// I am well aware of the policies stipulated in the handbook regarding academic dishonesty. 
// If proven guilty, I won't be credited any points for this endeavor.

	include "database_conn.php";
	session_start();
	
	// if the edit button has been set/declared
	if (isset($_GET['edit'])) {
		$ID = $_GET['edit'];
		$update = true;
		$record = mysqli_query($database_conn, "SELECT * FROM db_signup_data WHERE ID=$ID");

		// if the account was found in the database
		if (@count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$username = $n['username'];
			$password = $n['password'];
		}
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="edit_profile.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,600" rel="stylesheet" type="text/css">
		<title>Your Profile</title>
	</head>
	<body>
		<div class="home_nav">
			<a class="active" href="home.php"><i class="fa fa-home"></i> Home</a>
		</div>
	
		<!-- display prompt message -->
		<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
		<?php endif ?>
		<!-- select all data from the table in the database -->
		<?php $results = mysqli_query($database_conn, "SELECT * FROM db_signup_data"); ?>

		<table>
			<thead>
				<tr>
					<th>Username</th>
					<th>Password</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>
			
			<!-- display all the data from the table in the database -->
			<?php while ($row = mysqli_fetch_array($results)) { ?>
				<tr>
					<td><?php echo $row['username']; ?></td>
					<td><?php echo $row['password']; ?></td>
					<td>
						<a href="profile.php?edit=<?php echo $row['ID']; ?>" class="edit_btn" onclick="return confirm('Edit Your Profile?');">Edit</a>  
					</td>
					<td>
						<a href="login.php?del=<?php echo $row['ID']; ?>" class="del_btn" onclick="return confirm('Delete Your Account?');">Delete</a>
					</td>
				</tr>
			<?php } ?>
		</table>

		<!-- table allotted for profile update -->
		<form method="post" action="database_conn.php" >
			<div class="input-group">
				<label>Username</label>
				<input type="hidden" name="ID" value="<?php echo $ID; ?>">
				<input type="text" name="username" value="<?php echo $username;?>">
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="hidden" name="ID" value="<?php echo $ID; ?>">
				<input type="text" name="password" value="<?php echo $password;?>">
			</div>
			<div class="input-group">
				<?php if ($update == true): ?>
				<button class="btn" type="submit" name="update" style="background: #556B2F;" >Save Changes</button>
				<?php endif ?>
			</div>
		</form>
	</body>
</html>