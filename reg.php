<?PHP
  require('app-lib.php');
  isset($_POST['a'])? $action = $_POST['a'] : $action = "";
  if(!$action) {
    isset($_REQUEST['a'])? $action = $_REQUEST['a'] : $action = "";
  }
  build_header($displayName);
?>

  <div id="content">
    <?PHP // build_navBlock(); ?>
    <div style="margin-right: 40%; margin-left: 40%">
      <div class="PageTitle">New Customer Registration</div>
      <div style="float: left; line-height: 30px">
        <b>First Name: </b><br>
        <b>Last Name: </b><br>
        <b>User Address: </b><br>
        <b>Phone Number: </b><br>
        <b>User Name: </b><br>
        <b>User Password: </b><br>
        <b>Confirm Password: </b><br>
        <b>User Group: </b>

      </div>
      <div style="text-align: right">
        <input name="fldfirstName" id="fldfirstName" style="width: 200px">
        <input name="fldlastName" id="fldlastName" style="width: 200px">
        <input name="flduserAddress" id="flduserAddress" style="width: 200px">
        <input name="fldphoneNum" id="fldphoneNum" style="width: 200px">
        <input name="flduserName" id="flduserName" style="width: 200px">
        <input name="flduserPass" id="flduserPass" style="width: 200px">
        <input name="fldconfPass" id="fldconfPass" style="width: 200px">
        <input name="flduserGroup" id="flduserGroup" style="width: 200px">
      </div>
      <div id="regBut">
        <button type="button" id="btnReg">REGISTER</button>
        <button type="button" id="btnCancel" onclick="navMan('login.php')">CANCEL</button>
      </div>
    </div>
  </div>
<?PHP
build_footer();
?>
