<?php 
include("/xampp/htdocs/BeyondWords/assets/admin/shared/adminNav.php");

//Select categories from database
$select = "SELECT * FROM `books` LEFT JOIN `authors` ON books.author = authors.id LEFT JOIN `categories` ON books.category = categories.id";
$selectQuery = mysqli_query($connect, $select);

//Delete categories from database
if(isset($_GET["delete"]))
{
    $deletedISBN = $_GET["delete"];
    $delete = "DELETE FROM `books` WHERE ISBN = $deletedISBN";
    $deleteQuery = mysqli_query($connect, $delete);
    header("location: listBooks.php");
}
?>

<script>
  $(".more").toggle(function(){
      $(this).text("less..").siblings(".complete").show();    
  }, function(){
      $(this).text("more..").siblings(".complete").hide();    
  });
</script>

<div class="container mt-5 col-10">
  <h1 class="text-center mb-5">Books</h1>
  <table class="table table-striped table-dark">
    <thead>
      <tr>
        <th class="text-center">ISBN</th>
        <th class="text-center">Name</th>
        <th class="text-center">Price</th>
        <th class="text-center">Stock</th>
        <th class="text-center">Author</th>
        <th class="text-center">Category</th>
        <th class="text-center">Image</th>
        <th class="text-center">Description</th>
        <th colspan="2" class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($selectQuery as $selected){ ?>
      <tr>
        <td class="text-center">
          <?php echo $selected["ISBN"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["bookName"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["price"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["stock"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["authorName"]; ?>
        </td>
        <td class="text-center">
          <?php echo $selected["catName"]; ?>
        </td>
        <td class="text-center">
        <img style="width: 100%;" src="<?php echo $selected["image"]; ?>">
        </td>
        <td class="text-center">

        <span class="teaser"><?php echo subtr($selected["bookDesc"],0,100); echo 1; ?></span>

        <span class="complete"> <?php echo $selected["bookDesc"]; echo 2; ?></span>

        <span class="more">more...</span>
  
        </td>
        <td class="text-center"><a name="delete" href="/BeyondWords/assets/admin/book/listBooks.php?delete=<?php echo$selected["ISBN"]; ?>"class="btn btn-danger" onclick="return confirm('Would you like to delete book <?php echo $selected['bookName']; ?> with ID &rdquo;<?php echo $selected['ISBN']; ?>&rdquo; (This action cannot be reversed)')">Delete</a></td>
        <td class="text-center"><a name="edit" href="/BeyondWords/assets/admin/book/addBooks.php?edit=<?php echo$selected["ISBN"]; ?>" class="btn
            btn-info">Edit</a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>


<?php 
include("/xampp/htdocs/BeyondWords/assets/shared/footer.php");
?>