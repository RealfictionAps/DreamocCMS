<?php
include('includes/psl-config.php');

$dbConnection = new mysqli(HOST, USER, PASSWORD, DATABASE);

$query = "SELECT id FROM members";
$result = mysqli_query($dbConnection, $query);
//echo $result;

if(empty($result)) {
				
				$query = "CREATE TABLE members (
                          id int(11) NOT NULL AUTO_INCREMENT,
                          username varchar(30) NOT NULL,
                          serverpass varchar(100) NOT NULL,
						  admin varchar(100) NOT NULL,
                          email varchar(50) NOT NULL,
                          password char(128) NOT NULL,
						  salt char(128) NOT NULL,
						  PRIMARY KEY (id)
                          ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";
                $result = mysqli_query($dbConnection, $query);
				
// ------------------------------------------------------------------------------------------

				$query = "CREATE TABLE user_meta (
                          id int(11) NOT NULL AUTO_INCREMENT,
						  user_id int(11) NOT NULL,
                          weatherapp varchar(30) NOT NULL,
                          filename varchar(100) NOT NULL,
                          username varchar(50) NOT NULL,
                          password char(128) NOT NULL,
						  PRIMARY KEY (id)
                          ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";
                $result = mysqli_query($dbConnection, $query);
				
// -------------------------------------------------------------------------------------------

				$query = "CREATE TABLE login_attempts (
                          user_id int(11) NOT NULL,
                          time varchar(30) NOT NULL
						  ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
                $result = mysqli_query($dbConnection, $query);


			$query = "INSERT INTO login_attempts (user_id, time) VALUES
					(1, '1385995353'),
					(1, '1386011064')";
					$result = mysqli_query($dbConnection, $query);
			
			$query = "INSERT INTO members (id, username, serverpass, admin, email, password, salt) VALUES
			(1, 'test_user', '0000', 'yes', 'test@example.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef')";
				$result = mysqli_query($dbConnection, $query);
				
				
echo "
<div align='center'>
<strong>Setup done</strong>
<br><br>
<a href='login.php'>Go to login page</a>.
</div>
";
}
else {
	echo "setup was already done";
}


?>