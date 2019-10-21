<?PHP
  require('app-lib.php');
  isset($_REQUEST['a'])? $action = $_REQUEST['a'] : $action = "";
  if(!$action) {
    isset($_POST['a'])? $action = $_POST['a'] : $action = "";
  }
  build_header($displayName);

  $clientID = gen_ID();
  isset($_POST['fldfirstName'])? $clientName = $_POST['fldfirstName'] : $clientName = "";
  isset($_POST['fldlastName'])? $clientLast = $_POST['fldlastName'] : $clientLast = "";
  isset($_POST['flduserAddress'])? $clientAdd = $_POST['flduserAddress'] : $clientAdd = "";
  isset($_POST['fldphoneNum'])? $clientNum = $_POST['fldphoneNum'] : $clientNum = "";
  isset($_POST['flduserName'])? $clientUname = $_POST['flduserName'] : $clientUname = "";
  isset($_POST['flduserPass'])? $clientUpass = $_POST['flduserPass'] : $clientUpass = "";
  isset($_POST['fldconfPass'])? $clientUconfP = $_POST['fldconfPass'] : $clientUconfP = "";
  $mode = "reg";

  if($action == "reg") {
    $query =
      "INSERT INTO lpa_clients (
         lpa_client_ID,
         lpa_client_fistname,
         lpa_client_lastname,
         lpa_client_address,
         lpa_client_phone
       ) VALUES (
         '$clientID',
         '$clientName',
         '$clientLast',
         '$clientAdd',
         '$clientNum'
       )
      ";

      $query =
      "INSERT INTO lpa_users (
         lpa_user_username,
         lpa_user_password,
         lpa_user_firstname,
         lpa_user_lastname,
         lpa_user_group,
         lpa_user_status
       ) VALUES (
         '$clientUname',
         '$clientUpass',
         '$clientName',
         '$clientLast',
         'costumer',
         '1'
       )
      ";

      openDB();
      $result = $db->query($query);
      if($db->error) {
        printf("Errormessage: %s\n", $db->error);
        exit;
      } else {
        header("Location: reg.php?a=reg=".$clientID);
        exit;
      }
    }
?>

  <div id="content">
    <?PHP // build_navBlock(); ?>
    <div style="margin-right: 40%; margin-left: 40%">
      <div class="PageTitle">New Customer Registration</div>
      <form name="frmUserReg" id="frmUserReg" method="post" action="<?PHP echo $_SERVER['PHP_SELF']; ?>">
        <div style="float: left; line-height: 30px">
          <b>First Name: </b><br>
          <b>Last Name: </b><br>
          <b>User Address: </b><br>
          <b>Phone Number: </b><br>
          <b>User Name: </b><br>
          <b>User Password: </b><br>
          <b>Confirm Password: </b><br>
        </div>
        <div style="text-align: right">
          <input name="fldfirstName" id="fldfirstName" value="<?PHP echo $clientName ?>" style="width: 200px">
          <input name="fldlastName" id="fldlastName" value="<?PHP echo $clientLast ?>" style="width: 200px">
          <input name="flduserAddress" id="flduserAddress" value="<?PHP echo $clientAdd ?>" style="width: 200px">
          <input name="fldphoneNum" id="fldphoneNum" value="<?PHP echo $clientNum ?>" style="width: 200px">
          <input name="flduserName" id="flduserName" value="<?PHP echo $clientUname ?>" style="width: 200px">
          <input name="flduserPass" id="flduserPass" value="<?PHP echo $clientUpass ?>" style="width: 200px">
          <input name="fldconfPass" id="fldconfPass" value="<?PHP echo $clientUconfP ?>" style="width: 200px">
        </div>
      </form>
      <div id="regBut">
        <button type="button" id="btnReg">REGISTER</button>
        <button type="button" id="btnCancel" onclick="navMan('login.php')">CANCEL</button>
      </div>
      <input name="a" id="a" value="<?PHP echo $mode; ?>" type="hidden">
    </div>
  </div>

  <script>
    $("#btnReg").click(function(){
        $("#frmUserReg").submit();
    });
  </script>
  <?PHP build_footer(); ?>
