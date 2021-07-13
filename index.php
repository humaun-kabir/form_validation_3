<?php
    if(isset($_POST['submit'])){

        if($_POST['name'] == ""){
            $error_msg['name'] = "Name is required";
        }
        
        $name = $_POST['name'];
        if(!preg_match("/^([a-zA-Z' ]-)*$/",$name)){
            $error_msg['name'] = "only letters allowed";
        }

        $roll = $_POST['roll'];
        if(empty($roll)){
            $error_msg['roll'] = "Roll is required";
        }
        else  if(!is_numeric($roll)){
            $error_msg['roll'] = "only number input";
        }
        else if((strlen($roll) !=6)){
            $error_msg['roll'] = "only input 6 digits number";
        }

        $reg = $_POST['reg'];
        if(empty($reg)){
            $error_msg['reg'] = "Registration is required";
        }
        else  if(!is_numeric($reg)){
            $error_msg['reg'] = "only number input";
        }
        else if((strlen($reg) !=6)){
            $error_msg['reg'] = "only input 6 digits number";
        }

        $dept = $_POST['dept'];
        if($dept == "NULL"){
            $error_msg['dept'] = "Department is required";
        }

        $shift = $_POST['shift'];
        if($shift == "NULL"){
            $error_msg['shift'] = "Shift is required";
        }

        $sem = $_POST['sem'];
        if($sem == "NULL"){
            $error_msg['sem'] = "Semester is required";
        }

        if(empty($_POST['sex'])){
            $error_msg['sex'] = "gender is required";
        }

        $uname = $_POST['uname'];
        if(!(preg_match("/^[A_Za-z][A-Za-z0-9]{5,21}$/",$uname))){
            $error_msg['uname'] = "username is invalid";
        }

        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];
        if(!$pass){
            $error_msg['pass'] = "Password is required";
        }
        if(!$pass2){
            $error_msg['pass2'] = "Confirmed your password";
        }

        if($pass != $pass2){
            $error_msg['pass3'] = "Password don't match";
        }
        if(strlen($pass) >= 8 && (strlen($pass2) <=20)){
            $error_msg['pass3'] = "Password must be 8-20";
        }
        $website = $_POST['website'];
        if(!filter_var($website,FILTER_VALIDATE_URL)){
            $error_msg['website'] = "invalid website address";
        }

        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error_msg['email'] = "invalid email";
        }

        if($_FILES['img']['name']){

           //if($_FILES['img']['size'] <= (1024*1024)) && ($_FILES['img']['type'] == "image/jpeg") && ($_FILES['img']['type'] == "image/png"){

                move_uploaded_file($_FILES['img']['tmp_name'],"upload/" .time() .rand() .$_FILES['img']['name']);

            
        }
        else{
            $error_msg['img'] = "Image is required";
        }

        if(empty($_POST['agree'])){
            $error_msg['agree'] = "please checked";
        }


    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form validation</title>

    <style>
        .form-validation {
            width: 450px;
            margin: 0 auto;
            background: #ddd;
            padding: 20px 50px;
            box-sizing: border-box;
        }

        .label {
            float: left;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            padding-bottom: 10px;
            padding-top: 10px;
        }

        .text {
            float: left;
            width: 300px;
            height: 30px;
            padding: 5px;
            box-sizing: border-box;
        }

        .row {
            float: left;
            width: 100%;
            margin-bottom: 5px;
        }

        h2 {
            text-align: center;
            text-transform: uppercase;
        }

        .btn {
            float: right;
            padding: 10px 15px;
            font-size: 16px;
            text-transform: uppercase;
            font-weight: bold;
            color: #555;
            border: 1px solid #eee;
            background: #fff;

        }

        .error {
            color: #cc0000;
            padding-top: 5px;
            float: left;
            width: 100%;

        }
    </style>
</head>

<body>
    <div class="form-validation">
        <h2>Create Student Account</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr class="row">
                    <td class="label">
                        <label for="name">Name</label>
                    </td>
                    <td>
                        <input type="text" class="text" id="name" name="name" placeholder="Name">
                        <?php
                            if(isset($error_msg['name'])){
                                echo"<div class='error'>". $error_msg['name']."</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr class="row">
                    <td class="label">
                        <label for="roll">Roll</label>
                    </td>
                    <td>
                        <input type="text" class="text" id="roll" name="roll" placeholder="Roll">
                        <?php
                            if(isset($error_msg['roll'])){
                                echo"<div class='error'>". $error_msg['roll']."</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr class="row">
                    <td class="label">
                        <label for="reg">Registration</label>
                    </td>
                    <td>
                        <input type="text" class="text" id="reg" name="reg" placeholder="Registration">
                    
                    <?php
                            if(isset($error_msg['reg'])){
                                echo"<div class='error'>". $error_msg['reg']."</div>";
                            }
                    ?>
                    </td>
                </tr>

                <tr class="row">
                    <td class="label"><label for="dept">Department</label></td>
                    <td>
                        <select name="dept" id="dept" class="text">
                            <option value="NULL">--Select Department</option>
                            <option value="cse">Computer Science</option>
                            <option value="eee">Electrical & Electronics</option>
                            <option value="civil">Civil</option>
                        </select>
                        <?php
                            if(isset($error_msg['dept'])){
                                echo"<div class='error'>". $error_msg['dept']."</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr class="row">
                    <td class="label"><label for="shift">Department</label></td>
                    <td>
                        <select name="shift" id="shift" class="text">
                            <option value="NULL">--Shift--</option>
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                            <option value="3rd">3rd</option>
                        </select>
                        <?php
                            if(isset($error_msg['shift'])){
                                echo"<div class='error'>". $error_msg['shift']."</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr class="row">
                    <td class="label"><label for="sem">Department</label></td>
                    <td>
                        <select name="sem" id="sem" class="text">
                            <option value="NULL">--Select Semester--</option>
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                            <option value="3rd">3rd</option>
                            <option value="4th">4th</option>
                            <option value="5th">5th</option>
                            <option value="6th">Final</option>
                        </select>
                        <?php
                            if(isset($error_msg['sem'])){
                                echo"<div class='error'>". $error_msg['sem']."</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr class="row">
                    <td class="label"><label for="sex">Gender</lable></td>
                    <td><input type="radio" name="sex" id="sex" value="male" <?php if(isset($sex) && $sex = 'male') echo 'checked = "checked"'; ?>>
                    <label for="sex">Male</label>
                    <input type="radio" name="sex" id="sex" value="female" <?php if(isset($sex) && $sex = 'female') echo 'checked = "checked"'; ?>>
                    <label for="sex">Female</label>
                    <?php
                            if(isset($error_msg['sex'])){
                                echo"<div class='error'>". $error_msg['sex']."</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr class="row">
                    <td class="label"><label for="uname">Username</lable></td>
                    <td> <input type="text" class="text" placeholder="Username" id="uname" name="uname">
                    <?php
                            if(isset($error_msg['uname'])){
                                echo"<div class='error'>". $error_msg['uname']."</div>";
                            }
                        ?>
                
                </td>
                </tr>

                <tr class="row">
                    <td class="label"><label for="pass">Password</lable></td>
                    <td> <input type="text" class="text" placeholder="password" id="pass" name="pass"> 
                    <?php
                            if(isset($error_msg['pass'])){
                                echo"<div class='error'>". $error_msg['pass']."</div>";
                            }

                            if(isset($error_msg['pass3'])){
                                echo"<div class='error'>". $error_msg['pass3']."</div>";
                            }
                    ?>
                    </td>
                </tr>

                <tr class="row">
                    <td class="label"><label for="pass2">Confirm Password</lable></td>
                    <td> <input type="text" class="text" placeholder="Confirm password" id="pass2" name="pass2">
                    <?php
                            if(isset($error_msg['pass'])){
                                echo"<div class='error'>". $error_msg['pass']."</div>";
                            }                       
                    ?>
                </td>
                </tr>
                <tr class="row">
                    <td class="label"><label for="uname">Username</lable></td>
                    <td> <input type="text" class="text" placeholder="Username" id="uname" name="uname">

                    <?php
                            if(isset($error_msg['uname'])){
                                echo"<div class='error'>". $error_msg['uname']."</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr class="row">
                    <td class="label"><label for="website">Website</lable></td>
                    <td> <input type="text" class="text" placeholder="Website" id="website" name="website">

                    <?php
                            if(isset($error_msg['website'])){
                                echo"<div class='error'>". $error_msg['website']."</div>";
                            }
                    ?>
                </td>
                </tr>

                <tr class="row">
                    <td class="label"><label for="email">Email</lable></td>
                    <td> <input type="text" class="text" placeholder="Email" id="email" name="email">

                    <?php
                            if(isset($error_msg['email'])){
                                echo"<div class='error'>". $error_msg['email']."</div>";
                            }
                    ?>
                </td>
                </tr>

                <tr class="row">
                    <td class="label">
                        <label for="img">Image</label>
                    </td>
                    <td><input type="file" name="img" id="img">
                    <?php
                            if(isset($error_msg['img'])){
                                echo"<div class='error'>". $error_msg['img']."</div>";
                            }
                    ?>
                
                </td>
                </tr>
                
                <tr class="row">
                    <td class="label">
                        <input type="checkbox" name="agree" id="agree" value="yes" <?php if(isset($agree) && $agree='yes') echo 'checked = "checked"' ?>>
                        <label for="agree">I agree Team of Service and Privacy Policy</label>
                        <?php
                            if(isset($error_msg['agree'])){
                                echo"<div class='error'>". $error_msg['agree']."</div>";
                            }
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><input class="btn" type="submit" name="submit"></td>
                </tr>
            </table>
            
        </form>
    </div>
</body>

</html>