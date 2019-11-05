<!DOCTYPE html>
<?PHP
  $total = 0;
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
  <?PHP build_navBlock(); ?>
  <div id="content">
    <div id="mainC">
      <div class="PageTitle">Users Search</div>

      <!-- Search Section Start -->
      <form name="frmSearchUsers" method="post"
          id="frmSearchUsers"
          action="<?PHP echo $_SERVER['PHP_SELF']; ?>">
          <div class="displayPane">
              <div class="displayPaneCaption">Search:</div>
              <div>
                <input name="txtSearch" id="txtSearch" placeholder="Search Users"
                style="width: calc(100% - 200px)" value="<?PHP echo $txtSearch; ?>">
                <button type="button" id="btnSearch">Search</button>
  		          <button type="button" id="btnAddRec">Add</button>
              </div>
          </div>
          <input type="hidden" name="a" value="listUsers">
      </form>
      <!-- Search Section End -->
      <!-- Search Section List Start -->
      <?PHP
        if($action == "listUsers") {
        ?>
      <div>
        <table style="width: calc(100% - 3px);border: #cccccc solid 1px; margin-top: 5px"> <!--start user registration table-->
          <tr style="background: #eeeeee">
            <td style="width: 80px;border-left: #cccccc solid 1px"><b>User Id</b></td>
            <td style="border-left: #cccccc solid 1px"><b>User Name</b></td>
		        <td style="border-left: #cccccc solid 1px"><b>password</b></td>
      		  <td style="border-left: #cccccc solid 1px"><b>First Name</b></td>
      		  <td style="border-left: #cccccc solid 1px"><b>Last Name</b></td>
      		  <td style="border-left: #cccccc solid 1px"><b>Group</b></td>
      		  <td style="border-left: #cccccc solid 1px"><b>Status</b></td>
          </tr>
          <?PHP
            openDB();
            $query =
              "SELECT
                  *
               FROM
                  lpa_users
               WHERE
                  lpa_user_ID LIKE '$txtSearch' AND lpa_user_status <> 'D'
               OR
                  lpa_user_username LIKE '%$txtSearch%' AND lpa_user_status <> 'D'
          		 OR
          			lpa_user_firstname LIKE '%$txtSearch%' AND lpa_user_status <> 'D'
          		 OR
          			lpa_user_lastname LIKE '%$txtSearch%' AND lpa_user_status <> 'D'
          		 OR
          			lpa_user_group LIKE '%$txtSearch%' AND lpa_user_status <> 'D'
          		 OR
          			lpa_user_status LIKE '%$txtSearch%' AND lpa_user_status <> 'D'
          		 ";
            $result = $db->query($query);
            $row_cnt = $result->num_rows;
            if($row_cnt >= 1) {
              while ($row = $result->fetch_assoc()) { //open while statement
                $sid = $row['lpa_user_ID'];
            ?>
            <tr class="hl">
              <td onclick="loadUserItem(<?PHP echo $sid; ?>,'Edit')"
                style="cursor: pointer;border-left: #cccccc solid 1px">
                <?PHP echo $sid; ?>
              </td>
              <td onclick="loadUserItem(<?PHP echo $sid; ?>,'Edit')"
                style="cursor: pointer;border-left: #cccccc solid 1px">
                <?PHP echo $row['lpa_user_username']; ?>
			        </td>
              <td onclick="loadUserItem(<?PHP echo $sid; ?>,'Edit')"
                style="cursor: pointer;border-left: #cccccc solid 1px">
                <?PHP echo $row['lpa_user_password']; ?>
              </td>
			        <td onclick="loadUserItem(<?PHP echo $sid; ?>,'Edit')"
                style="cursor: pointer;border-left: #cccccc solid 1px">
                <?PHP echo $row['lpa_user_firstname']; ?>
              </td>
			        <td onclick="loadUserItem(<?PHP echo $sid; ?>,'Edit')"
                style="cursor: pointer;border-left: #cccccc solid 1px">
                <?PHP echo $row['lpa_user_lastname']; ?>
              </td>
			        <td onclick="loadUserItem(<?PHP echo $sid; ?>,'Edit')"
                style="cursor: pointer;border-left: #cccccc solid 1px">
                <?PHP echo $row['lpa_user_group']; ?>
              </td>
			        <td onclick="loadUserItem(<?PHP echo $sid; ?>,'Edit')"
                style="cursor: pointer;border-left: #cccccc solid 1px">
                <?PHP echo $row['lpa_user_status']; ?>
              </td>
            </tr>
        <?PHP
          } //close while statement
      } else { ?>
          <tr>
            <td colspan="3" style="text-align: center">
            No Records Found for: <b><?PHP echo $txtSearch; ?></b>
            </td>
          </tr>
          <?PHP } ?>
	     </table> <!--end user registration table-->
    </div>
    <?PHP } ?>
    <!-- Search Section List End -->
  </div>
 </div>
 <script>
	var action = "<?PHP echo $action; ?>";
	var search = "<?PHP echo $txtSearch; ?>";
	if(action == "recUpdate") {
	alert("Record Updated!");
	navMan("users.php?a=listUsers&txtSearch=" + search);
	}
	if(action == "recInsert") {
	alert("Record Added!");
	navMan("users.php?a=listUsers&txtSearch=" + search);
	}
	if(action == "recDel") {
	alert("Record Deleted!");
	navMan("users.php?a=listUsers&txtSearch=" + search);
	}
	function loadUserItem(ID,MODE) {
	window.location = "usersadedit.php?sid=" +
	ID + "&a=" + MODE + "&txtSearch=" + search;
	}
	$("#btnSearch").click(function() {
	$("#frmSearchUsers").submit();
	});
	$("#btnAddRec").click(function() {
	loadUserItem("","Add");
	});
	setTimeout(function(){
	$("#txtSearch").select().focus();
	},1);
	</script>

<?PHP
build_footer();
?>
