<h1>Create Parent</h1>
<form method="post" action="../scripts/controllers/form_handlers/createParentFormHandler.php">
    <div class="form-group">
        <label for="name">Parent Name</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>

    <div class="form-group">
        <label for="email">Parent Email</label>
        <input type="text" name="email" id="email" class="form-control">
    </div>

    <div class="form-group">
        <label for="phone">Parent Phone Number</label>
        <input type="text" name="phone" id="phone" class="form-control">
    </div>

    <div class="form-group">
        <label for="addr">Parent Address</label>
        <input type="text" name="addr" id="addr" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Parent Password</label>
        <input type="text" name="password" id="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="preferences">Alert Preferences</label>
        <br />
        Receive Texts &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="texting" id="texting" value="text"> <br />
        Receive Emails &nbsp;&nbsp;<input type="checkbox" name="emailing" id="emailing" value="email">
    </div>

    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
</form>

