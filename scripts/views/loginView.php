<!--<form method="post" action="../scripts/controllers/loginController.php">-->
<!---->
<!--    <div class="form-group">-->
<!--        <label for="email">Email: </label>-->
<!--        <input name="email" id="email" class="form-control">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="password">Password:</label>-->
<!--        <input type="text" name="password" id="password" class="form-control" >-->
<!--    </div>-->
<!---->
<!--    <input type="submit" name="submit" value="Login" class="btn btn-primary" id="submit">-->
<!--</form>-->


<a class="btn btn-default" onclick="autoFillUser(0);">Company - bigcompany1@gmail.com ID: 1</a><br>
<a class="btn btn-default" onclick="autoFillUser(1);">Manager - manager6@gmail.com ID at facility 1 at company 1</a><br>
<a class="btn btn-default" onclick="autoFillUser(2);">Employee - baba_ganush2@gmail.com at facility 1 at company 1</a><br>
<a class="btn btn-default" onclick="autoFillUser(3);">Employee - employee17@gmail.com at facility 5 at company 5</a><br>
<a class="btn btn-default" onclick="autoFillUser(4);">Parent - parent19@gmail.com</a><br>
<br>
<a class="btn btn-default" onclick="autoFillUser(5);">Company - bigcompany3@gmail.com ID: 3</a><br>
<a class="btn btn-default" onclick="autoFillUser(6);">Employee - employee4@gmail.com  at facility 2 at company 1</a><br>
<a class="btn btn-default" onclick="autoFillUser(7);">Employee - employee15@gmail.com  at facility 3 at company 3</a><br>


<script><!-- TODO: move this to js folder -->
    var emails = ["bigcompany1@gmail.com", "manager6@gmail.com", "baba_ganush2@gmail.com", "employee17@gmail.com", "parent19@gmail.com", "bigcompany3@gmail.com", "employee4@gmail.com", "employee15@gmail.com"];
    var passwords = ["password1", "password6", "password2", "password17", "password19", "password3", "password4", "password15"];

    var emailBox=document.getElementById("email");
    var passwordBox=document.getElementById("password");
    var submitBox=document.getElementById("submit_login");

    function autoFillUser(index) {
        emailBox.value = emails[index];
        passwordBox.value = passwords[index];
        submitBox.click();
    }
</script>


