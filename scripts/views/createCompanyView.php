
<form method="post" action="../scripts/controllers/form_handlers/createCompanyFormHandler.php">

  <div class="form-group">
    <label for="company_name">Company Name</label>
    <input type="text" name="company_name" id="company_name" class="form-control">
  </div>

  <div class="form-group">
    <label for="address">Company Address</label>
    <input type="text" name="address" id="address" class="form-control">
  </div>

  <div class="form-group">
    <label for="phone_number">Phone Number</label>
    <input type="text" name="phone_number" id="phone_number" class="form-control">
  </div>

  <div class="form-group">
    <label for="email">Company Email</label>
    <input type="text" name="create_email" id="create_email" class="form-control">
  </div>

  <div class="form-group">
    <label for="password">Company Password</label>
    <input type="text" name="create_password" id="create_password" class="form-control">
  </div>

  <input type="hidden" name="role" value="company">
  <input type="submit" value="Submit" name="submit" class="btn btn-primary">
</form>
