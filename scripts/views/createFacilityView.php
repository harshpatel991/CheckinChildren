<?php
/**
 * The view that contains the html one sees when creating a facility
 * It contains a form for inputs needed to construct a valid facility model
 * The form submits to the createFacilityFormHandler
 */
?>

<h1>Create Facility</h1>
<form method="POST" action="../scripts/controllers/form_handlers/createFacilityFormHandler.php">

    <div class="form-group">
        <label for="address">Facility Address</label>
        <input type="text" name="address" id="address" class="form-control">
    </div>

    <div class="form-group">
        <label for="phone_number">Phone Number</label>
        <input type="text" name="phone_number" id="phone_number" class="form-control">
    </div>

    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
</form>



