<?php
	include 'php/header.php';
?>

<div class="container-fluid" style="margin-left:20%; margin-right:20%">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-body"  style="background-color:#5cb85c">
          <h1 style="color:white"> Users </h1>
          <h2 style="color:white"> 9000 </h2>
        </div>
      </div>
    </div>
    <!-- Modal Look up -->
    <div class="col-md-6" >
      <div class="panel panel-default">
        <div class="panel-body"  style="background-color:#d9534f">
          <h1 style="color:white"> Quizes </h1>
          <h2 style="color:white"> 9000 </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>ID</th>
          <th>Email </th>
          <th>Password</th>
        </tr>
      </thead>
      <?php
        $result = getBasicData(array("userID", "email", "password"), "USERS");
        if(mysql_num_rows($result) > 0) {
          while($row = mysql_fetch_array($result)){
            echo "<tr>
                    <td>$row[0]</td>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                  </tr> ";
          }
        }
      ?>
    </table>
  </div>
</div>
