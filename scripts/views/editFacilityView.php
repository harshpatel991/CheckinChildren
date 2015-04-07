<?php

require_once(dirname(__FILE__).'/../models/dao/facilityDAO.php');
require_once(dirname(__FILE__).'/../models/facilityModel.php');

$facilityDAO=new facilityDAO();
$facility=$facilityDAO->find($_GET['facility_id']);
?>

<form method="post" action="../scripts/controllers/form_handlers/editFacilityFormHandler.php">
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="<?php echo $facility->address; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" value="<?php echo $facility->phone; ?>" class="form-control">
    </div>
    <input type="hidden" name="company_id" id="company_id" value="<?php echo $facility->company_id; ?>">
    <input type="hidden" name="facility_id" id="facility_id" value="<?php echo $_GET['facility_id']; ?>">


    <input type="submit" value="Submit" name="submit" class="btn btn-primary">
</form>

<hr>

<a id="home" href="displayFacilities.php?facility_id=<?php echo $_GET['facility_id']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Facility Info</a>
