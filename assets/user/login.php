<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/nav.php");

// if(isset($_POST['login'])){
//   $email = $_POST['email'];
//   $password = $_POST['password'] ;
//   $select = " SELECT * FROM `users` WHERE email = '$email' AND password = '$password' ";
//   $x = mysqli_query($connect , $select);
//   $row = mysqli_num_rows($x);
//   if($row >0) {
//       $_SESSION["user"] = $email;
//   header("location : /BeyondWords/");
//   }
//   else{
//   echo "<div class= ' text-center alert alert-danger '> 
//   wrong password </div> ";

//   }
// }
// 

if(isset($_POST['login'])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $select = "SELECT * FROM `users` WHERE email = '$email' and password = '$password'";
    $selectQuery = mysqli_query($connect, $select);
    $numberOfRows = mysqli_num_rows($selectQuery);
    if($numberOfRows > 0){
        $_SESSION["user"] = $email;
        $_SESSION["cart"] = array();
        $dir = isset($_GET['dir']) ? $_GET['dir'] : "/BeyondWords";
        header("location: $dir");
    }
    else{
        echo "<div class='container alert alert-danger col-6 text-center font-weight-bolder'>
        Wrong email or password
      </div>";
    }
}
?>

<div class="container col-5 mt-5">
    <h1 class="text-center mb-5">Login</h1>
  <form method="POST">
    <div class="form-group">
      <label for="email">Username:</label>
      <input type="text" class="form-control" name="email" id="email" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" id="password" required>
    </div>
        <button type="submit" name="login" class="float-right col-3">Login</button>
  </form>
</div>



<!-- <div class ="container col-4 mt-5" > 
<form method="POST">
 
  <div class="form-group">
    <label  for="email">E-mail: </label>
    <input name="email" type="Email" class="form-control" id="email" aria-describedby="emailHelp" required>
  </div>
  
  <div class="form-group">
    <label for="password">Password:</label>
    <input  type="password" name="password" class="form-control" id="password" required>
  </div>
<div class ="container col-4 mt-2">
  <button type="submit" name="login" class="btn btn-light">log in</button>
</div>

</form>
</div> -->

<?php
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>