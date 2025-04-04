<?php

//Call This Function In Your App Entry Point If You Are Building a Multiple PAge Application
function ScreenRouter()
{
  //calling database
  require "system_files/libraries/db_config.php";
  //checking if linking is set
  if (isset($_GET['s'])) {
    $store_name = mysqli_real_escape_string($conn, $_GET['s']);
    //getting all screen from database
    $sql = "SELECT * FROM stores WHERE store_name = '$store_name'";
    $res = mysqli_query($conn, $sql);
    //checking if screen exist in database
    if (mysqli_num_rows($res) > 0) {
        echo "<script>window.location.href='?s=view_store&&store=".$store_name."'</script>";
    } else {
      //checking if screen exist
      if (file_exists("screens/" . $_GET['s'] . "")) {
        require "screens/" . $_GET['s'] . "";
      } else {
        echo '
              <div style="min-height: 100vh;" class="page-wrap d-flex flex-row align-items-center">
              <div class="container">
                  <div class="row justify-content-center">
                      <div class="col-md-12 text-center">
                          <span class="display-1 d-block">404</span>
                          <div class="mb-4 lead">The page you are looking for was not found.</div>
                          <a href="./" class="btn btn-link">Back to Home</a>
                      </div>
                  </div>
              </div>
            </div>    
        ';
      }
    }
  } else {
    homepage();
  }
}
