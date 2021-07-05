<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <title>
            Exercise Plan Report - Fit-Me Application
        </title>
        <link rel="stylesheet" href="style1.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
  <body>  Exercise Plan Report
    

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

    $sql_select = "select * from workoutplan";
    $query_id3 = oci_parse($con, $sql_select);
    $runselect = oci_execute($query_id3);
    $sql_select1 = "select * from exerciseplan";
    $query_id4 = oci_parse($con, $sql_select1);
    $runselect1 = oci_execute($query_id4);
    if ($runselect && $runselect1) 
    {
           while($row = oci_fetch_array($query_id3, OCI_BOTH+OCI_RETURN_NULLS)) 
           {

            $row1=oci_fetch_array($query_id4, OCI_BOTH+OCI_RETURN_NULLS);

               $r0 = $row[0];
               $r1 = $row[1];
               $r2 = $row[2];
               $r3 = $row1[0];
               $r4 = $row1[1];
               $r5 = $row1[2];

 


               echo "<table class='table-body'>";
               echo "<br><br>";   
               echo "<tr align = middle>"."<td>"."Plan ID"."</td>"."<td>".$r0."</td>"."</tr>";
               echo "<tr align = middle>"."<td>"."Plan Type"."</td>"."<td>".$r1."</td>"."</tr>";
               echo "<tr align = middle>"."<td>"."Member ID"."</td>"."<td>".$r2."</td>"."</tr>";
               echo "<tr align = middle>"."<td>"."Type of Exercise"."</td>"."<td>".$r3."</td>"."</tr>";
               echo "<tr align = middle>"."<td>"."Targeted Muscle Group"."</td>"."<td>".$r4."</td>"."</tr>";
               echo "<tr align = middle>"."<td>"."Workout Hours"."</td>"."<td>".$r5."</td>"."</tr>";
               echo "</table>";
               echo "<br>";   
            } 
        }
    
   else
   {
   $er=oci_error($query_id3);
   echo "Query not executed.<br>";
   echo $er['message'];
   }

  


    
?>