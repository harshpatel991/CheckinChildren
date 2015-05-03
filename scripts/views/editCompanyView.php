<?php
require_once(dirname(__FILE__).'/../controllers/authController.php');
require_once(dirname(__FILE__) . '/../models/dao/companyDAO.php');
require_once(dirname(__FILE__).'/../models/companyModel.php');

$companyDAO=new companyDAO();
$company=$companyDAO->find($_COOKIE[cookieManager::$userId]);

?>

<h1>Edit Account Profile</h1>
<form method="post" action="../scripts/controllers/form_handlers/editCompanyFormHandler.php">
    <div class="form-group">
        <label for="parent_name">Name</label>
        <input type="text" name="company_name" id="company_name" value="<?php echo $company->company_name; ?>" class="form-control">
    </div>

<div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="<?php echo $company->email; ?>" class="form-control">
</div>

<div class="form-group">
    <label for="address">Address</label>
    <input type="text" name="address" id="address" value="<?php echo $company->address; ?>" class="form-control">
</div>

<div class="form-group">
    <label for="phone_number">Phone Number</label>
    <input type="text" name="phone_number" id="phone_number" value="<?php echo $company->phone; ?>" class="form-control">
</div>

<input type="submit" value="Submit" name="submit" class="btn btn-primary">
</form>

<hr>

<a id="home" href="displayCompanyInfo.php" class="btn btn-danger"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Account Profile</a>
