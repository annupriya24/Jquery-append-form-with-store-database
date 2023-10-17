<?php
// Change this to your connection info.
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'test';

// Try and connect using the info above.
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$query = "SELECT * FROM state ORDER BY state_name ASC"; 
    $result = $con->query($query); ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> jQuery conditionize Plugin Example </title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!-- conditionize CSS -->
<link rel="stylesheet" href="css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<!-- conditionize JS -->
<script src="dist/conditionize.min.js"></script>
    <!-- Demo CSS -->
    <link rel="stylesheet" href="css/demo.css">
</head>
 <body>
<main>
 <article>
    <p>The following is the example of display form fields based on selection. </p>
<form id="myForm" enctype="multipart/form-data">
  <h1>Conditionize</h1>

  <select name="select-control">
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three. Wow, you will see the new control below...</option>
  </select>

  <div data-cond="[name=select-control] == 3">
     <label> 
      <input type="text" name="name" id="name" placeholder="Name">
   
      <input type="text" name="email" id="email" placeholder="Email">
  
      <input type="text" name="mobile" id="mobile" placeholder="Mobile">
      <input type="text" name="address" id="address" placeholder="Address">
      <select id="state" name="state">
    <option value="">Select State</option>
    <?php 
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">State not available</option>'; 
    } 
    ?>
</select>
<select id="city" name="city">
    <option value="">Select state first</option>
</select>

     
   </label>
    <button type="button" onclick="submitFormAjax()" class="btn btn-primary mb-3">Submit</button>
  </div>
  
</form> </article>
</main>

<footer class="credit"><a title="Awesome web design code & scripts" href="#" target="_blank">CodeMe</a></footer>
<script>
$('#myForm').conditionize( {
  checkDebounce: 0,
  customToggle: function( $item, show ) {
    if ( show ) {
      $item.stop().slideDown(200);
    } else {
      $item.stop().slideUp(200);
    }
  }
});
</script>
<script type="text/javascript">
 function submitFormAjax() {
    var  xmlhttp;
    if(window.XMLHttpRequest){
      xmlhttp = new XMLHttpRequest();
    }else if(window.ActiveXObject){
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")

    }

    // Instantiating the request object
    xmlhttp.open("POST", "submit_data.php", true);
     // Defining event listener for readystatechange event
    xmlhttp.onreadystatechange = function() {
       // if (this.readyState !== "complete"){
       //    document.getElementById("response_message").innerHTML = "Loading";
       // }
        if (this.readyState === 6 && this.status === 200)
        {
            //alert(this.responseText); // Here is the response
            document.getElementById("response_message").innerHTML = this.responseText;
           // console.log(this.responseText);
        }
    }

    // Retrieving the form data
    var myForm = document.getElementById("myForm");
    var formData = new FormData(myForm);

    // Sending the request to the server
    xmlhttp.send(formData);

}   


</script>
<script>
$(document).ready(function(){
    $('#state').on('change', function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>

 </body>
</html>
