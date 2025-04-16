<?php
session_start();
include('includes/dbconnection.php');

if (strlen($_SESSION['detsuid']==0)) {
  header('location:logout.php');
} else {
  $uid = $_SESSION['detsuid'];

  if (isset($_POST['update'])) {
    $eid = $_GET['editid'];
    $item = $_POST['item'];
    $cost = $_POST['cost'];
    $date = $_POST['date'];

    $query = mysqli_query($con, "UPDATE tblexpense SET ExpenseItem='$item', ExpenseCost='$cost', ExpenseDate='$date' WHERE ID='$eid' AND UserId='$uid'");
    if ($query) {
      echo "<script>alert('Expense updated successfully');</script>";
      echo "<script>window.location.href='manage-expense.php'</script>";
    } else {
      echo "<script>alert('Update failed');</script>";
    }
  }

  if (isset($_GET['editid'])) {
    $eid = $_GET['editid'];
    $query = mysqli_query($con, "SELECT * FROM tblexpense WHERE ID='$eid' AND UserId='$uid'");
    $row = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Expense</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>
  <h2>Update Expense</h2>
  <form method="post">
    <label>Expense Item:</label><br>
    <input type="text" name="item" value="<?php echo $row['ExpenseItem']; ?>" required><br><br>
    
    <label>Expense Cost:</label><br>
    <input type="text" name="cost" value="<?php echo $row['ExpenseCost']; ?>" required><br><br>
    
    <label>Expense Date:</label><br>
    <input type="date" name="date" value="<?php echo $row['ExpenseDate']; ?>" required><br><br>
    
    <input type="submit" name="update" value="Update">
  </form>
</body>
</html>

<?php
  }
}
?>
