<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

<?php
// define variables and set to empty values
$nameErr =$facErr =  "";
$name = $comment = $facility_id = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["facility_id"]))
    {
        $facErr = "Facility id is required";
    }
    else
    {
        $facility_id = test_input($_POST["facility_id"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>Create a parent!</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>
    Name: <input type="text" name="name" value="IE John Smith">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    Address: <input type="text" name="facility_id" value="IE 501 S. Sixth St APT 520 Champaign IL 61820">
    <span class="error">* <?php echo $facErr; ?></span>
    <br><br>
    Phone Number: <input type="text" name="facility_id" value="IE 8475555120">
    <span class="error">* <?php echo $facErr; ?></span>
    <br><br>
    Email: <input type="text" name="facility_id" value="IE gobbluth@bluthconstruction.com">
    <span class="error">* <?php echo $facErr; ?></span>
    <br><br>

    <input type="submit" name="submit" value="Submit">
</form>


</body>
</html>