<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/nav.php");

if(isset($_GET["ISBN"])){
  $ISBN = $_GET["ISBN"];
  $select = "SELECT * FROM `books` LEFT JOIN `authors` ON books.author = authors.id LEFT JOIN `categories` ON books.category = categories.id WHERE ISBN = $ISBN";
  $selectQuery = mysqli_query($connect, $select);
  $bookRow = mysqli_fetch_assoc($selectQuery);
}
// testing cart
// $status = "";
// if(isset($_POST["addCart"])){
//   $select = "SELECT * FROM `books` WHERE ISBN = $ISBN";
// $selectQuery = mysqli_query($connect, $select);
// $cartRow = mysqli_fetch_assoc($selectQuery);
// $ISBN = $cartRow["ISBN"];
// $bookName = $cartRow["bookName"];
// $price = $cartRow["price"];
// $image = $cartRow["image"];

// $cartArray = array(
//   $ISBN=>array(
//     "bookName"=>$bookName,
//     "ISBN"=>$ISBN,
//     "price"=>$price,
//     "quantity"=>1,
//     "image"=>$image)
//   );

//   if(empty($_SESSION["shopping_cart"])){
//     $_SESSION["shopping_cart"] = $cartArray;
//     $status = "<div class='alert alert-success' role='alert'>
//     A simple success alert—check it out!
//   </div>";
//   }
//   else{
//     $array_keys = array_keys($_SESSION["shopping_cart"]);
//     if(in_array($ISBN, $array_keys)){
//       $status = "<div class='alert alert-danger' role='alert'>
//       A simple danger alert—check it out!
//     </div>";
//     }
//     else{
//       $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"], $cartArray);
//       $status = "<div class='alert alert-success' role='alert'>
//       A simple success alert—check it out!
//     </div>";
//     }
//   }

// }


//test cart 2
if(isset($_POST["addCart"])){
  $ISBN = $_GET["ISBN"];
  $cart = $_SESSION["cart"];
  $isFound = false;
  foreach($cart as $item){
    if($item->ISBN == $ISBN){
      if($item->quantity < $bookRow["stock"]) {
          $item->quantity = $item->quantity +1;
      }
      else {
        // NOTIFY USER HE CANT ORDER MORE THAN WHAT IS ALREADY IN STOCK
        echo '<div class=" container alert alert-danger alert-dismissible fade show" role="danger">
        You are trying to add items to your cart more than what is available in stock.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
      }
      $isFound = true;
      break;
    }
  }
  if(!$isFound) {
    if($bookRow["stock"] > 0) {
      $newItem = new cartObject($bookRow["bookName"], $bookRow["ISBN"], $bookRow["price"], $bookRow["image"], 1);
      array_push($cart, $newItem);
      $_SESSION["cart"] = $cart;
    }
  }
  // print_r($_SESSION["cart"]);
  // echo '123';
}

?>
<link rel="stylesheet" href="style.css">

<div class="container mt-3">
  <div class="row">

    <div class="col-3">
    <div class="coverContainer m-auto">
      <img class="bookPicture" src="<?php echo $bookRow["image"]; ?>" />
    </div>
      <div class="mt-2">
            <p class="text-center"> <span class="bolderInfo">Author:</span> <?php echo $bookRow["authorName"]; ?></p>
            <p class="text-center"><span class="bolderInfo">Price:</span> <?php echo $bookRow["price"]; ?> L.E</p>
            <p class="text-center"><span class="bolderInfo">Stock:</span><?php if($bookRow["stock"] > 0) { ?> <span class="inStock"><?php echo $bookRow["stock"]; ?> </span> <?php } else echo " <span class='outOfStock'>Out of Stock</span>"; ?></p>
            <div class="addCartButton">
            <?php if($bookRow["stock"] > 0) : ?>
              <form method="POST"><button class="m-auto d-flex btn btn-outline-success cartButton" name="addCart"><i class="fas fa-cart-plus m-auto"></i><span class="ml-2">Add to Cart</span></button></form>
            <?php else : ?>
            <button disabled="disabled" class="m-auto d-flex btn btn-danger cartButton"><i class="far fa-frown m-auto"></i><span class="ml-2">Out of Stock</span></button>
            <?php endif; ?>
          </div>
      </div>
    </div>
    <div class="col">
    <h1><?php echo $bookRow["bookName"]; ?></h1>
    <p class="bookDescription"><?php echo $bookRow["bookDesc"]; ?></p>

  <?php include("/xampp/htdocs/BeyondWords/assets/shared/footer.php"); ?>
