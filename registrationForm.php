<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>
            Member Registration Form - Fit-Me Application
        </title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">
            <div class="title">Registration</div>
            <form name="input" action="registrationForm.php" method="post">
                <div class="user-details">
                <div class="input-box">
                        <span class="details">Member ID</span>
                        <input type="text" name="member_id" placeholder="Enter ID" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" name="member_name" placeholder="Enter your name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Username</span>
                        <input type="text" name="member_username" placeholder="Enter your username" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="member_password" placeholder="Enter your Password" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <input type="password" placeholder="Re-enter your Password" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Age</span>
                        <input type="text" name="member_age" placeholder="Enter your age" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Weight</span>
                        <input type="text" name="member_weight" placeholder="Enter your weight" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Height</span>
                        <input type="text" name="member_height" placeholder="Enter your height" required>
                    </div>

                   
                    <div class="gender-info">
                        <input type="radio" name="member_gender" id="dot-1" value="Male">
                        <input type="radio" name="member_gender" id="dot-2" value="Female">
                        <span class="gender-title">Gender</span>
                        <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Male</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Female</span>
                        </label>
                        </div>
                    </div>
                    <div class="input-box">
                        <span class="details">Membership Type</span>
                        <input type="text" name="membership_type" placeholder="Membership Type" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Membership Payment</span>
                        <input type="text" name="membership_payment" placeholder="Membership Payment" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Date</span>
                        <input type="text" name="membership_date" placeholder="Date" required>
                    </div>
                    </div>
                    <div class="button">
                        <input type="submit" value="Register" name="register_member">
                    </div>
                </div>
                
                
            </form>
        </div>
    </body>
</html>

<?php  // creating a database connection 

   $db_sid = 
   "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-VOIORAL)(PORT = 1521))
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = orcl)
    )
  )";            // Your oracle SID, can be found in tnsnames.ora  ((oraclebase)\app\Your_username\product\11.2.0\dbhome_1\NETWORK\ADMIN) 
  
   $db_user = "system";   // Oracle username e.g "scott"
   $db_pass = "fast123";    // Password for user e.g "1234"
   $con = oci_connect($db_user,$db_pass,$db_sid); 
   if(!$con) 
   {  die('Could not connect to Oracle: '); 
     } 

  

if (isset($_POST["register_member"]))
{
 $member_id=$_POST["member_id"];
 if($member_id!=NULL)
 {
 $member_name=$_POST["member_name"];
 $member_username=$_POST["member_username"];
 $member_password=$_POST["member_password"];
 $member_age=$_POST["member_age"];
 $member_weight=$_POST["member_weight"];
 $member_height=$_POST["member_height"];
 $member_bmi=$member_weight/$member_height;
 $member_gender=$_POST["member_gender"];
 $membership_id= $_POST["member_id"];
$membership_payment= $_POST["membership_payment"];
$membership_date= $_POST["membership_date"];
$membership_type= $_POST["membership_type"];

// INSERT INTO product VALUES ('1','Slanty','30','1','1','masala','50');
$sql_insert2 = "insert into applicationAccount values ('{$member_username}','{$member_password}','{$membership_date}','{$membership_date}')";
 $sql_insert1 = "insert into membership values ('{$membership_id}','{$membership_type}','{$membership_date}','{$membership_payment}')";



// echo $sql_insert;
 $query_id2 = oci_parse($con, $sql_insert2);
 $runselect = oci_execute($query_id2);
 
 if (!$runselect) 
 {
 $er=oci_error($query_id2);
 echo "Query1 not executed.<br>";
 echo $er['message'];

 }

 $query_id = oci_parse($con, $sql_insert1);
 $runselect = oci_execute($query_id);
 if (!$runselect) 
 {
 $er=oci_error($query_id);
 echo "Query2 not executed.<br>";
 echo $er['message'];
 echo $membership_id;

 }

 $sql_insert = "insert into member values ('{$member_id}','{$member_name}','{$member_age}','{$member_weight}','{$member_height}','{$member_bmi}','{$member_gender}','{$membership_id}','{$member_username}')";
 $query_id1 = oci_parse($con, $sql_insert);
 $runselect = oci_execute($query_id1);

 if (!$runselect) 
 {
 $er=oci_error($query_id1);
 echo "Query3 not executed.<br>";
 echo $er['message'];
 echo $membership_id;

 }
 echo '<script>alert("Member Registration Successful")</script>';



}
else
{
    echo "NULL ID";
}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
