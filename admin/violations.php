<?php

   $query = "SELECT * FROM violation ORDER BY id DESC";
   $result = mysqli_query($conn, $query);


     echo '
     <style>

       th,td{width: 20%;text-align: center;border: 1px solid black;}

     </style>


     <table>
       <tr>
         <th>User </th>
         <th>Type </th>
         <th>Category </th>
         <th>Place </th>
         <th>Full Details </th>
       </tr>';
      while ($row = mysqli_fetch_array($result)) {
       echo '
         <tr>
           <td>'. $row["userUid"].'</td>
           <td>'. $row["type"].'</td>
           <td>'. $row["category"].'</td>
           <td>'. $row["place"].'</td>
           <td><a href = "violation-details.php?q='.$row["id"].'"; target = "_blank">Click here</a></td>
         </tr>    ';

     }
    echo "</table>";
   

 ?>
