<h1>Create Employee</h1>
<form method="post" action="../scripts/controllers/form_handlers/createEmployeeFormHandler.php">
    <div class="form-group">
        <label for="name"> Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Employee Email </label>
        <input type="text" name="email" id="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Employee Password</label>
        <input type="text" name="password" id="password" class="form-control">
    </div>

    <input type="hidden" value="employee" name="role" id="role" class="form-control">

    <input type="submit" value="Submit" name="submit" class="btn btn-primary">
</form>

<hr>

<a class="btn btn-danger" id="home" href="index.php"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back to Home</a>
