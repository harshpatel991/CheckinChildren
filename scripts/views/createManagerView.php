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
        <label for="email">Email</label>
        <input type="text" name="email" id="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" name="password" id="password" class="form-control">
    </div>

    <input type="hidden" name="role" value="manager">
    <input type="submit" name="submit" value="Register" class="btn btn-primary">
</form>
