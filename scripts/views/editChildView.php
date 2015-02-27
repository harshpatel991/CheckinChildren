
<p style="color:red">
<?php
    if(isset($_GET['error'])) {
        if($_GET['error'] == 1) {
            echo "Invalid Information";
        }
    }
?>
</p>

<form method="post" action="../scripts/controllers/form_handlers/editChildFormHandler.php">
Name:
    <input type="text" name="child_name" > <br>
Allergies:
    <input type="text" name="allergies"><br>

    <input type="hidden" name="child_id" value="<?php echo $_GET['child_id']; ?>">
    <input type="submit" value="Submit" name="submit">
</form>