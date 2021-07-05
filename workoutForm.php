<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <title>
            Workout Form - Fit-Me Application
        </title>
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body> 
        <div class="container">
            <div class="title">Workout Form</div>
            <form name="input" action="workoutForm.php" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Member ID</span>
                        <input type="text" name="member_id" placeholder="Enter your Member ID" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Plan ID</span>
                        <input type="text" name="plan_id" placeholder="Enter Plan ID" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Targeted Muscle Group</span>
                        <input type="text" name="workout_musclegroup" placeholder="Targeted Muscle Group.." required>
                    </div>
                    <div class="input-box">
                        <span class="details">Type of Exercise</span>
                        <input type="text" name="num_exercises" placeholder="Type of Exercise" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Workout Hours</span>
                        <input type="text" name="workout_hours" placeholder="Workout Hours" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Calories Intake</span>
                        <input type="text" name="calories_intake" placeholder="Calories Intake" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Protein Intake</span>
                        <input type="text" name="protein_intake" placeholder="Protein Intake" required>
                    </div>
                    </div>
                    <div class="plan-info">
                        <input type="radio" name="plan" value="Flexibility" id="plandot-1">
                        <input type="radio" name="plan" value="Balance" id="plandot-2">
                        <input type="radio" name="plan" value="Strength" id="plandot-3">
                        <span class="plan-title">Plan Type</span>
                        <div class="category">
                        <label for="plandot-1">
                            <span class="dot one"></span>
                            <span class="plan">Flexibility</span>
                        </label>
                        <label for="plandot-2">
                            <span class="dot two"></span>
                            <span class="plan">Balance</span>
                        </label>
                        <label for="plandot-3">
                            <span class="dot three"></span>
                            <span class="plan">Strength</span>
                        </label>
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" name="create_plan" value="Create Workout Plan">
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

  

if (isset($_POST["create_plan"]))
{
$member_id=$_POST["member_id"];
$plan_id=$_POST["plan_id"];
 if($plan_id!=NULL) {
 $workout_musclegroup=$_POST["workout_musclegroup"];
 $num_exercises=$_POST["num_exercises"];
 $workout_hours=$_POST["workout_hours"];
 $calories_intake=$_POST["calories_intake"];
 $protein_intake= $_POST["protein_intake"];
 $plan=$_POST["plan"];

$sql_insert2 = "insert into WorkoutPlan values ('{$plan_id}','{$plan}','{$member_id}')";



// echo $sql_insert;
 $query_id2 = oci_parse($con, $sql_insert2);
 $runselect = oci_execute($query_id2);
 
 if (!$runselect) 
 {
 $er=oci_error($query_id2);
 echo "Query1 not executed.<br>";
 echo $er['message'];

 }

 $sql_insert1 = "insert into DietPlan values ('{$calories_intake}','{$protein_intake}')";



// echo $sql_insert;
 $query_id1 = oci_parse($con, $sql_insert1);
 $runselect = oci_execute($query_id1);
 
 if (!$runselect) 
 {
 $er=oci_error($query_id1);
 echo "Query2 not executed.<br>";
 echo $er['message'];

 }

 $sql_insert = "insert into ExercisePlan values ('{$num_exercises}','{$workout_musclegroup}','{$workout_hours}')";



 // echo $sql_insert;
  $query_id = oci_parse($con, $sql_insert);
  $runselect = oci_execute($query_id);
  
  if (!$runselect) 
  {
  $er=oci_error($query_id);
  echo "Query3 not executed.<br>";
  echo $er['message'];
 
  }
 else

 {
    echo '<script>alert("New Workout Form created")</script>';
 }
}

}