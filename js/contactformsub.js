function submitForm(){

  //get vars from input
  var name = $("#name").val();
  var email = $("#email").val();
  var message = $("#message").val();

  //post variables to contactForm-message.php
  $.ajax({
    type: "POST",
    url: "php/contactForm-message.php",
    data: "name=" + name + "&email=" + email + "&message=" + message,
    success:function(text){
      //if the function is successful, display to the
      //user that it has been submitted
      if (text == "success"){
        document.getElementById("msgSubmit").className = "";
        document.getElementById("msgSubmit").className = "h4 text-center";
      } else {
        //otherwise display an error
        alert("There was a problem with the system, please try again later");
      }
    }
  });
}
