<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>
            Daily Progress Form - Fit-Me Application
        </title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="container">  
            <div class="title">Daily Progress Form</div>
            <form name="input" action="logForm.php" method="post">
                <div class="user-details">
                <div class="input-box">
                        <span class="details">Log ID</span>
                        <input type="text" name="log_id" placeholder="Enter Log ID" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Member ID</span>
                        <input type="text" name="member_id" placeholder="Enter your Member ID" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Updated Weight</span>
                        <input type="text" name="member_weight" placeholder="Updated Weight" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Targeted Muscle Group</span>
                        <input type="text" name="log_muscle" placeholder="Targeted Muscle Group.." required>
                    </div>
                    <div class="input-box">
                        <span class="details">Type of Exercise</span>
                        <input type="text" name="log_exercises" placeholder="Type of Exercises.." required>
                    </div>
                    <div class="input-box">
                        <span class="details">Workout Hours</span>
                        <input type="text" name="log_hours" placeholder="Workout Hours" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Food</span>
                        <input type="text" name="log_food" placeholder="Food Intake" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Calories Intake</span>
                        <input type="text" name="log_calories" placeholder="Calories Intake" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Protein Intake</span>
                        <input type="text" name="log_protein" placeholder="Protein Intake" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Date</span>
                        <input type="text" name="log_date" placeholder="Date" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Local Time</span>
                        <input type="text" name="log_time" placeholder="Local Time" required>
                    </div>
                    </div>
                    <div class="button">
                        <input type="submit" name="record_progress" value="Record Progress">
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
 
  

if (isset($_POST["record_progress"]))
{

$log_id=$_POST["log_id"];
if($log_id!=NULL) {
$member_id=$_POST["member_id"];
$member_weight=$_POST["member_weight"];
$log_muscle=$_POST["log_muscle"];
$log_exercises=$_POST["log_exercises"];
$log_hours= $_POST["log_hours"];
$log_food= $_POST["log_food"];
$log_calories= $_POST["log_calories"];
$log_protein= $_POST["log_protein"];
$log_date=$_POST["log_date"];
$log_time=$_POST["log_time"];

// INSERT INTO product VALUES ('1','Slanty','30','1','1','masala','50');
$sql_insert2 = "insert into DailyProgressLog values ('{$log_id}','{$log_date}','{$log_time}','{$member_weight}','{$member_id')";



// echo $sql_insert;
 $query_id2 = oci_parse($con, $sql_insert2);
 $runselect = oci_execute($query_id2);
 
 if (!$runselect) 
 {
 $er=oci_error($query_id2);
 echo "Query1 not executed.<br>";
 echo $er['message'];

 }
 else

 {
    echo '<script>alert("Progress Recorded")</script>';
 }
}

}

