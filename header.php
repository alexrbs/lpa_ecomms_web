<!DOCTYPE html>
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
    <div id="header">
      <div style="margin-left: 10px">
        Interface Sample Website
      </div>
    </div>
    <div style="text-align:right">Welcome <?php echo $displayName; ?>
        <br> Status: <?php echo $displayGroup ?> //added to display user privileges
    </div>
    <div style="clear: right"></div>
