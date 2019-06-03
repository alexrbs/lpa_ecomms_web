<?PHP
  $authChk = true;
  require('app-lib.php');
  isset($_POST['a'])? $action = $_POST['a'] : $action = "";
  if(!$action) {
    isset($_REQUEST['a'])? $action = $_REQUEST['a'] : $action = "";
  }
  isset($_POST['txtSearch'])? $txtSearch = $_POST['txtSearch'] : $txtSearch = "";
  if(!$txtSearch) {
    isset($_REQUEST['txtSearch'])? $txtSearch = $_REQUEST['txtSearch'] : $txtSearch = "";
  }
  build_header($displayName);
?>

  <div id="content">
    <?PHP build_navBlock(); ?>
    <div id="mainC">
      <div class="PageTitle">New Customer Registration</div>
      <div>
        <b>First Name: </b>
        <input name="fldfirstName" id="fldfirstName" style="width: 200px; margin-left: 52px">
      </div>
      <div>
        <b>Last Name: </b>
        <input name="fldlastName" id="fldlastName" style="width: 200px; margin-left: 53px">
      </div>
      <div>
        <b>User Address: </b>
        <input name="flduserAddress" id="flduserAddress" style="width: 200px; margin-left: 35px">
      </div>
      <div>
        <b>Phone Number: </b>
        <input name="fldphoneNum" id="fldphoneNum" style="width: 200px; margin-left: 27px">
      </div>
      <div>
        <b>User Name: </b>
        <input name="flduserName" id="flduserName" style="width: 200px; margin-left: 51px">
      </div>
      <div>
        <b>User Password: </b>
        <input name="flduserPass" id="flduserPass" style="width: 200px; margin-left: 25px">
      </div>
      <div>
        <b>Confirm Password: </b>
        <input name="fldconfPass" id="fldconfPass" style="width: 200px; margin-left: 4px">
      </div>
      <div>
        <b>User Group: </b>
        <input name="flduserGroup" id="flduserGroup" style="width: 200px; margin-left: 48px">
      </div>
      <div id="regBut">
        <button type="button" id="btnReg">REGISTER</button>
        <button type="button" id="btnCancel">CANCEL</button>
      </div>
    </div>
  </div>
<?PHP
build_footer();
?>
