

<?php 


   $hn = 'localhost'; //hostname
    $db = 'yussufa_pbl'; //database
    $un = 'yussufa_pbl'; //username
   $pw = 'mypassword'; //password

 $conn = new mysqli($hn, $un, $pw, $db);

  if ($conn->connect_error) die($conn->connect_error);
  
$query = "SELECT user_code,user_description FROM user_codes ";
$result = $conn->query($query);
 

echo '

   <form action="sectiona.php" method="post">
    First Name <input type="text" name="fname"> <br>
     Last Name <input type="text" name="lname"> <br>
  User Type <select name = "user_code"> ';
while ($row = mysqli_fetch_assoc($result)){
      echo '<option value =" '.$row['user_code'].'">'.$row['user_description'].'</option>';
}
   echo ' </select> <br>

      E-mail <input type="text" name="email"> <br>
      Password <input type="password" name="password"> <br>
           <input type="submit" value="Submit">
 </form>

';
  if (isset($_POST['fname'])&&
  isset($_POST['lname'])&& 
  isset($_POST['email']) && 
  isset($_POST['password']))
  { 

    $fname   = get_post($conn, 'fname');
    $lname    = get_post($conn, 'lname');
    $email     = get_post($conn, 'email');
    $password     = get_post($conn, 'password');
    $query    = "INSERT INTO user_profiles(fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$password')";
    $result2   = $conn->query($query);

  	if (!$result2) echo "INSERT failed: $query<br>" .
      $conn->error . "<br><br>";
  }


function get_post ($conn, $var){
       return $conn->real_escape_string($_POST[$var]);
}

?>
