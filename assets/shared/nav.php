<?php 
session_start();
include("/xampp/htdocs/BeyondWords/assets/generalPHP/authentication.php");
include("header.php");
include("/xampp/htdocs/BeyondWords/assets/generalPHP/configureDB.php");

if(isset($_POST["logout"])){
  session_unset();
  session_destroy();
  header("location: /BeyondWords/assets/user/login.php");
}

class cartObject{
  public $bookName;
  public $ISBN;
  public $price;
  public $image;
  public $quantity;

  function __construct($bookName, $ISBN, $price, $image, $quantity){
    $this->bookName = $bookName;
    $this->ISBN = $ISBN;
    $this->price = $price;
    $this->image = $image;
    $this->quantity = $quantity;
  }
};

//Searching books function

if(isset($_GET["search"])){
  $searched = $_GET["searched"];
  header("location: /BeyondWords/assets/book/searchBooks.php?searched=".$searched);
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/BeyondWords/">BeyondWords</a>
    <?php if(isset($_SESSION["user"])) : ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          My Account
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/BeyondWords/assets/book/availableBooks.php">Available Books</a>
          <a class="dropdown-item" href="/BeyondWords/assets/book/cart.php">My Cart</a>
          <a class="dropdown-item" href="/BeyondWords/assets/user/orders.php">My Orders</a>
        </div>
      </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" name="searched" placeholder="Search available books" aria-label="Search">
        <button class="btn btn-outline-success" name="search" type="submit">Search</button>
      </form>
      <ul class="nav navbar-nav ml-auto">
              
               <form method="POST"> <li><button class="btn btn-danger" name="logout">Log Out <i class="fas fa-sign-out-alt"></i></button></li></form>
                <?php else : ?>
                <ul id="navbar-left" class="nav navbar-nav ml-auto">
                <li class="mx-3"><a href="/BeyondWords/assets/user/register.php">Register <i class="fa fa-user-plus"></i></a></li>
                <li><a href="/BeyondWords/assets/user/login.php">Log In <i class="far fa-user"></i></a></li>
                <?php endif; ?>
            </ul>
    </div>
  </div>
</nav>