<?php
	include 'php/header.php';
?>
<script>

function deleteRow(id) {
  $.ajax(
  {
    type : 'POST',
    url : './php/deleterow.php',
    data: { userId : id },
    success: function(response){
      if(response == "true") {
        success = true;
      } else {
        success = false;
      }
    },
    async: false
  });
  return success;
}

  $(function () {

    $(".user, .quiz").hide();
    
    $(".link1, .link2").bind("click", function () {

      $(".user, .quiz").hide();        
        
      if ($(this).attr("class") == "link1")
      {
        $(".user").show();
      }
      else 
      { 
        $(".quiz").show();
      }
    });
  });
  $(document).on('click', 'button.del', function () { // <-- changes
     //alert("You are about to delete user!");
     var $row = $(this).closest("tr");        // Finds the closest row <tr> 
     var $id = $row.find("td:nth-child(1)").text();  // Finds the 1st <td> element;
     alert("You are about to delete user!");
     if(deleteRow($id)){
      alert("Used successfully deleted");
      $row.remove();
     }else{
      alert("User deletion was unsuccessful");
     }
     return false;
 });
</script>
<div class="container-fluid" style="margin-left:20%; margin-right:20%">
  <div class="row">
  <a href="#" class="link1">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-body"  style="background-color:#5cb85c" align="center">
          <h1 style="color:white"> Users </h1>
          <h2 style="color:white"> 9000 </h2>
        </div>
      </div>
    </div>
    </a>
    <!-- Modal Look up -->
    <a href="#" class="link2">
    <div class="col-md-6" >
      <div class="panel panel-default"  align="center">
        <div class="panel-body"  style="background-color:#d9534f">
          <h1 style="color:white"> Quizes </h1>
          <h2 style="color:white"> 9000 </h2>
        </div>
      </div>
    </div>
    </a>
  </div>
  <div class="row user">
    <table id="choose-address-table" class="table table-condensed">
      <thead>
        <tr>
          <th>ID</th>
          <th>Email </th>
          <th>Password</th>
        </tr>
      </thead>
      <?php
        $result = getBasicData(array("userID", "email", "password"), "USERS");
        if(mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_array($result)){
            echo "<tr>
                    <td>$row[0]</td>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    <td>
                          <button type=\"button\" class=\"btn btn-xs btn-danger pull-right del\">
                                  Delete</button>
                    </td>
                  </tr>";
          }  
        }
      ?>
    </table>
  </div>
  <div class="row quiz">
    <table class="table table-condensed">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name </th>
          <th>Created by</th>
        </tr>
      </thead>
      <?php
        $result = getBasicData(array("questID", "questName", "createdBy"), "QUESTS");
        if(mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_array($result)){
            echo "<tr>
                    <td>$row[0]</td>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    <td><button type=\"button\" class=\"btn btn-xs btn-danger pull-right\">Delete</button></td>
                  </tr>";
          }  
        }
      ?>

  </div> 
</div>
