<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>Create a Company</title>
</head>
<body>
<form method="post" action="../scripts/controllers/createCompanyController.php">
  Company Name:
  <input type="text" name="company_name" > <br>
  Company address:
  <input type="text" name="address"> <br>
  Phone number:
  <input type="text" name="phone_number"> <br>
  Company Email:
  <input type="text" name="email"><br>
  Company Password:
  <input type="text" name="password"><br>
  <input type="hidden" name="role" value="company">
  <input type="submit" value="Submit" name="submit">
</form>
</body>
</html>

<?php
