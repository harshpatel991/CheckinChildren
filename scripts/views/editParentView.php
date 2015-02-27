<?php


?>


<form method="post" action="../scripts/controllers/form_handlers/editParentFormHandler.php">
    Name:
    <input type="text" name="parent_name" > <br>
    Email:
    <input type="text" name="email"><br>
    Address:
    <input type="text" name="address"> <br>
    Phone number:
    <input type="text" name="phone_number"> <br>

    <input type="hidden" name="role" value="parent">

    <input type="submit" value="Submit" name="submit">
</form>


