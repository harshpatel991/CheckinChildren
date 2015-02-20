


<h2>Login</h2>
<form method="post" action="../scripts/controllers/loginController.php">

    Email: <input type="text" name="email" id="email">
    <br><br>
    Password: <input type="text" name="password" id="password">
    <br><br>
    <input type="submit" name="submit" value="Login" id="submit">
</form>


------------LOGIN AS:------------<br>
<a href="javascript:void(0)" onclick="autoFillUser(0);">Company - bigcompany1@gmail.com</a><br>
<a href="javascript:void(0)" onclick="autoFillUser(1);">Manager - manager6@gmail.com</a><br>
<a href="javascript:void(0)" onclick="autoFillUser(2);">Employee - baba_ganush2@gmail.com</a><br>
<a href="javascript:void(0)" onclick="autoFillUser(3);">Parent - parent19@gmail.com</a><br>


<script><!-- TODO: move this to js folder -->
    var emails = ["bigcompany1@gmail.com", "manager6@gmail.com", "baba_ganush2@gmail.com", "parent19@gmail.com" ];
    var passwords = ["password1", "password6", "password2", "password19"];

    var emailBox=document.getElementById("email");
    var passwordBox=document.getElementById("password");
    var submitBox=document.getElementById("submit");

    function autoFillUser(index) {
        emailBox.value = emails[index];
        passwordBox.value = passwords[index];
        submitBox.click();
    }
</script>
    <input type="submit" name="submit" value="Login">
</form>
<a href="createCompany.php">Register New Company</a>

