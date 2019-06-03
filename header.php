<!DOCTYPE html>
<?php global $page; ?>
<html>
  <head>
    <title>Interface</title>
    <link href="js/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui-1.12.1.custom/jquery-ui.min.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
  </head>
  <body>
    <?php if($page == 1){?>
    <div id="headerA">
      <div style="margin-left: 15px">
        Logic Peripherals Australia
      </div>
    </div>
    <?php }else{ ?>
      <div id="header">
        <div style="margin-left: 15px">
          Logic Peripherals Australia
        </div>
      </div>
    <?php } ?>
    <div style="clear: right"></div>
  </body>
