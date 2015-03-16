<form method="post" action="../scripts/controllers/loginController.php">

    <div class="form-group">
        <label for="email">Email: </label>
        <input name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input name="password" id="password" class="form-control" >
    </div>

    <input type="submit" name="submit" value="Login" class="btn btn-primary" id="submit">
</form>


<a class="btn btn-default" onclick="autoFillUser(0);">Company - bigcompany1@gmail.com</a><br>
<a class="btn btn-default" onclick="autoFillUser(1);">Manager - manager6@gmail.com</a><br>
<a class="btn btn-default" onclick="autoFillUser(2);">Employee - baba_ganush2@gmail.com</a><br>
<a class="btn btn-default" onclick="autoFillUser(3);">Employee - employee17@gmail.com</a><br>
<a class="btn btn-default" onclick="autoFillUser(4);">Parent - parent19@gmail.com</a><br>


<script><!-- TODO: move this to js folder -->
    var emails = ["bigcompany1@gmail.com", "manager6@gmail.com", "baba_ganush2@gmail.com", "employee17@gmail.com", "parent19@gmail.com" ];
    var passwords = ["password1", "password6", "password2", "password17", "password19"];

    var emailBox=document.getElementById("email");
    var passwordBox=document.getElementById("password");
    var submitBox=document.getElementById("submit");

    function autoFillUser(index) {
        emailBox.value = emails[index];
        passwordBox.value = passwords[index];
        submitBox.click();
    }
</script>


