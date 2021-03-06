<?PHP
  require('app-lib.php');
  isset($_POST['a'])? $action = $_POST['a'] : $action = "";
  $msg = null;
  if($action == "doLogin") {
    $chkLogin = false;
    isset($_POST['fldUsername'])?
      $uName = $_POST['fldUsername'] : $uName = "";
    isset($_POST['fldPassword'])?
      $uPassword = $_POST['fldPassword'] : $uPassword = "";
      $hashedPassword = hash("md5", $uPassword);
    //Hashed login
    openDB();
    $query =
      "
      SELECT
        lpa_user_ID,
        lpa_user_username,
        lpa_user_password
      FROM
        lpa_users
      WHERE
        lpa_user_username = '$uName'
      AND
        lpa_user_password = '$hashedPassword'
      LIMIT 1
      ";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    if($row['lpa_user_username'] == $uName) {
      if($row['lpa_user_password'] == $hashedPassword) {
        $_SESSION['authUser'] = $row['lpa_user_ID'];
        if(!empty($_SESSION['authUser'])){
          header("Location: index.php");
          exit;
        }
      }
    }

    if($chkLogin == false) {
      $msg = "Login failed! Please try again.";
      gen_log($uName, $msg);
      }

    //Non hashed login
    openDB();
    $query =
      "
      SELECT
        lpa_user_ID,
        lpa_user_username,
        lpa_user_password
      FROM
        lpa_users
      WHERE
        lpa_user_username = '$uName'
      AND
        lpa_user_password = '$uPassword'
      LIMIT 1
      ";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    if($row['lpa_user_username'] == $uName) {
      if($row['lpa_user_password'] == $uPassword) {
        $_SESSION['authUser'] = $row['lpa_user_ID'];
        if(!empty($_SESSION['authUser'])){
          header("Location: index.php");
          $msg = "Login successful!";
          gen_log($uName, $msg);
          exit;
        }
      }
    }

    if($chkLogin == false) {
      $msg = "Login failed! Please try again.";
      gen_log($uName, $msg);
      }
  }
 build_header();
?>
  <div id="contentLogin">
    <form name="frmLogin" id="frmLogin" method="post" action="login.php">
      <div class="titleBar">User Login</div>
      <div id="loginFrame">
        <div class="msgTitle">Please supply your login details:</div>
        <div>Username:</div>
        <input type="text" name="fldUsername" id="fldUsername">
        <div>Password:</div>
        <input type="password" name="fldPassword" id="fldPassword">
        <div class="buttonBar">
          <button type="button" onclick="do_login()">Login</button>
          <button type="button" onclick="navMan('reg.php')">Register</button>
        </div>
      </div>
      <input type="hidden" name="a" value="doLogin">
    </form>
 </div>
<script>
  var msg = "<?PHP echo $msg; ?>";
  if(msg) {
    alert(msg);
  }
  $( "#contentLogin").center().cs_draggable({
      handle : ".titleBar",
      containment : "window"
    });

  $("#frmLogin").keypress(function(e) {
    if(e.which == 13) {
      $(this).submit();
    }
  });

</script>
<?PHP
build_footer();
?>
