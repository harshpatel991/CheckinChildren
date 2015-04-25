<?php
/**
 * The view that contains the html one sees when creating a manager
 * It contains a form for inputs needed to construct a valid employee model
 * The form submits to the createManagerFormHandler
 */
?>

<h1>Create Manager</h1>
<form method="post" action="../scripts/controllers/form_handlers/createManagerFormHandler.php">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>

    <div class="form-group">
        <label for="facility_id">Facility Id</label>
        <input type="text" name="facility_id" id="facility_id" class="form-control">
    </div>

    <div class="form-group">
        <label for="phone_number">Phone Number</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control">
    </div>

    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" class="form-control">
    </div>


    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" name="password" id="password" class="form-control">
    </div>

    <input type="submit" name="submit" value="Register" class="btn btn-primary">
</form>
