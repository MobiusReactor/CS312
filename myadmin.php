<?php
	include 'php/header.php';
?>
<script>

function deleteRow(id, button) {
  $.ajax(
  {
    type : 'POST',
    url : './php/deleterow.php',
    data: { ID : id,
            DB : button  },
    success: function(response){
      if(response == "true") {
        alert(response);
        success = true;
      } else {
        alert(response);
        success = false;
      }
    },
    async: false
  });
  return success;
  
}

  $(function () {

    $(".user, .quiz, .answers, .quest").hide();
    
    $(".link1, .link2, .link3, .link4").bind("click", function () {

      $(".user, .quiz, .answers, .quest").hide();        

      if ($(this).attr("class") == "link1")
      {
        $(".user").show();
      }
      if($(this).attr("class") == "link2")
      { 
        $(".quiz").show();
      }
      if($(this).attr("class") == "link3")
      {
        $(".answers").show();
      }
      if($(this).attr("class") == "link4")
      {
        $(".quest").show();
      }
    });
  });
  $(document).on('click', '.usr, .qts, .ans, .qs', function () { // <-- changes
    if($(this).attr("class").indexOf("usr") > -1){
      var $bt = "user";
    }
    if($(this).attr("class").indexOf("qts") > -1){
      var $bt = "quiz";
    }
    if($(this).attr("class").indexOf("ans") > -1){
      var $bt = "answer";
    }
    if($(this).attr("class").indexOf("qs") > -1){
      var $bt = "question";
    }

     var $row = $(this).closest("tr");        // Finds the closest row <tr> 
     var $id = $row.find("td:nth-child(1)").text();  // Finds the 1st <td> element;
     if (confirm(
        "You are about to delete the " + $bt + " and all data associated with it. Do you want to continue?")
        ){
            if(deleteRow($id, $bt)){
              alert($bt + " successfully deleted");
              $row.remove();
            }else {
              alert($bt + " deletion was unsuccessful");
            }

     }
     return false;
 });
 
</script>

<?php if (isset($_SESSION['admin'])) : ?>
	<div class="container-fluid" style="margin-left:20%; margin-right:20%">
	  <div class="row">
		<div class="col-md-3">
		  <div class="panel panel-default" align="center">
			<a href="#" class="link1" style="text-decoration:none;">
			  <div class="panel-body"  style="background-color:#7986CB">
			    <h1 style="color:white"> Users </h1>
			    <h2 style="color:white"> <?php echo getCount("USERS");?> </h2>
			  </div>
			</a>
		  </div>
		</div>
		<!-- Modal Look up -->
	
		<div class="col-md-3" >
		  <div class="panel panel-default"  align="center">
			<a href="#" class="link2" style="text-decoration:none;">
			  <div class="panel-body"  style="background-color:#5C6BC0">
			    <h1 style="color:white"> Quizes </h1>
			    <h2 style="color:white"> <?php echo getCount("QUESTS");?> </h2>
			  </div>
			</a>
		  </div>
		</div>
		<div>
		  <div class="col-md-3" >
			<div class="panel panel-default">
			  <a href="#" class="link3" style="text-decoration:none;">
			    <div class="panel-body"  style="background-color:#3F51B5" align="center">
			      <h1 style="color:white"> Answers </h1>
			      <h2 style="color:white"> <?php echo getCount("ANSWERS");?> </h2>
			    </div>
			  </a>
			</div>
		  </div>
		</div>
		<div class="col-md-3" >
		  <div class="panel panel-default"  align="center">
			<a href="#" class="link4" style="text-decoration:none;">
			  <div class="panel-body"  style="background-color:#3949AB">
			    <h1 style="color:white"> Questions </h1>
			    <h2 style="color:white"> <?php echo getCount("QUESTIONS");?> </h2>
			  </div>
			</a>
		  </div>
		</div>
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
			                  <button type=\"button\" class=\"btn btn-xs btn-danger pull-right usr\">
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
			            <td><button type=\"button\" class=\"btn btn-xs btn-danger pull-right qts\">Delete</button></td>
			          </tr>";
			  }  
			}
		  ?>
		</table>
	  </div> 
	  <div class="row answers">
		<table class="table table-condensed">
		  <thead>
			<tr>
			  <th>ID</th>
			  <th>Answered By </th>
			  <th>Question ID</th>
			  <th>Answer</th>
			</tr>
		  </thead>
		  <?php
			$result = getBasicData(array("answerID", "answeredBy", "questionID", "answer"), "ANSWERS");
			if(mysqli_num_rows($result) > 0) {
			  while($row = mysqli_fetch_array($result)){
			    echo "<tr>
			            <td>$row[0]</td>
			            <td>$row[1]</td>
			            <td>$row[2]</td>
			            <td>$row[3]</td>
			            <td><button type=\"button\" class=\"btn btn-xs btn-danger pull-right ans\">Delete</button></td>
			          </tr>";
			  }  
			}
		  ?>
		</table>
	  </div> 
	  <div class="row quest">
		<table class="table table-condensed">
		  <thead>
			<tr>
			  <th>Question ID</th>
			  <th>Questionnaire ID </th>
			  <th>Question Type</th>
			  <th>Question</th>
			  <th>Options </th>
			</tr>
		  </thead>
		  <?php
			$result = getBasicData(array("questionID", "questionnaireID", "questionType", "question", "options"), "QUESTIONS");
			if(mysqli_num_rows($result) > 0) {
			  while($row = mysqli_fetch_array($result)){
			    echo "<tr>
			            <td>$row[0]</td>
			            <td>$row[1]</td>
			            <td>$row[2]</td>
			            <td>$row[3]</td>
			            <td>$row[4]</td>
			            <td><button type=\"button\" class=\"btn btn-xs btn-danger pull-right qs\">Delete</button></td>
			          </tr>";
			  }  
			}
		  ?>
		</table>
	  </div> 
	</div>

<?php else : ?>
	<p>Error, access denied</p>
<?php endif; ?>

