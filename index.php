<?php 
include("assets/shared/nav.php");
?>

<span id="d"></span>


<script>
var d = new Date();
document.getElementById("d").innerHTML = d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear() + " - " + d.getHours() + ":" + d.getMinutes() + ":" + d.getSeconds();
</script>

<?php 
include("assets/shared/footer.php");
?>