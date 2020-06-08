<?php

   $query = "SELECT * FROM report ORDER BY id DESC";
   $result = mysqli_query($conn, $query); ?>

   <style>

     th,td{width: 20%;text-align: center;border: 1px solid black;}
     #search{font-size: 16px;padding: 5px; margin: 5px;}

   </style>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
   <input type="text" id="search" placeholder="Start typing...." autofocus>
   <table>
     <thead>
     <tr>
       <th>User </th>
       <th>Boarding </th>
       <th>Vehicle Number </th>
       <th>Full Details </th>
     </tr>
   </thead>
   <tbody id = "myTable">
   <?php while ($row = mysqli_fetch_array($result)) {
     echo '
       <tr>
         <td>'. $row["userUid"].'</td>
         <td>'. $row["boarding"].'</td>
         <td>'. $row["vehicleNum"].'</td>
         <td><a href = "user-details.php?q='.$row["id"].'"; target = "_blank">Click here</a></td>
       </tr>    ';
   } ?>
 </tbody>
 </table>

 <script>
   $(window).ready(function() {
     $("#search").on('keyup', function() {
       var value = $(this).val().toLowerCase();
       $("#myTable tr").filter(function(){
         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
       });
     });
   });
</script>
