<!DOCTYPE html>
<?PHP
  $authChk = true;
  require('app-lib.php');
  build_header($displayName);
  isset($_POST['a'])? $action = $_POST['a'] : $action = "";
  if(!$action){
      isset($_REQUEST['a'])? $action = $_REQUEST['a'] : $action = "";
  }
  isset($_REQUEST['sid'])? $sid = $_REQUEST['sid'] : $sid = "";
  if(!$sid) {
      isset($_POST['sid'])? $sid = $_POST['sid'] : $sid = "";
  }
  isset($_POST['txtSearch'])? $txtSearch = $_POST['txtSearch'] : $txtSearch = "";
  if (!$txtSearch) {
      isset($_REQUEST['txtSearch'])? $txtSearch = $_REQUEST['txtSearch']:$txtSearch = "";
  }
  isset($_REQUEST['quantity'])? $quantity = $_REQUEST['quantity'] : $quantity = "";
  if(!$quantity) {
      isset($_POST['quantity'])? $quantity = $_POST['quantity'] : $quantity = "";
  }

?>

<?php
    if ($action == "addToCar") {
        $ses = "Cart".$sid;
        $_SESSION[$ses] += $quantity;
    }
?>
  <div id="content">
    <?PHP build_navBlock(); ?>
    <div id="mainC">
    <div class="PageTitle">Product List</div>

  <form action="" method="post">
    <div class="displayPane">
      <div>
        <input id="txtSearch" name="txtSearch" value="" placeholder="Search...." style="width: calc(90% - 115px)">
        <button type="submit">Search</button>
		  </div>
    </div>
    <input type="hidden" name="a" value="search">

  </form>

<?PHP
    if($action == "search") {
      isset($_POST['txtSearch'])? $itmSearch = $_POST['txtSearch'] : $itmSearch = "";
      $itemNum = 1;
      openDB();
      $query = "SELECT * FROM lpa_stock " .
        "WHERE lpa_stock_name LIKE '%$itmSearch%' " .
        "AND lpa_stock_status = 'a' " .
        "ORDER BY lpa_stock_name ASC";
      $result = $db->query($query);
      while ($row = $result->fetch_assoc()) {
        if ($row['lpa_stock_image']) {
          $prodImage = $row['lpa_stock_image'];
        } else {
          $prodImage = "question.png";
        }
        $sid = $row['lpa_stock_ID'];
        ?>
        <div class="productListItem">
          <div
            class="productListItemImageFrame"
            style="background: url('images/<?PHP echo $prodImage; ?>') no-repeat center center;">
          </div>
          <div class="prodTitle"><?PHP echo $row['lpa_stock_name']; ?></div>
          <div class="prodDesc"><?PHP echo $row['lpa_stock_desc']; ?></div>
          <div class="prodOptionsFrame">
            <div class="prodPriceQty">
              <div class="prodPrice">$<?PHP echo $row['lpa_stock_price']; ?></div>
              <div class="prodQty">QTY:</div>
              <div class="prodQtyFld">
                <input
                  name="quantity<?PHP echo $sid; ?>"
                  id="quantity<?PHP echo $sid; ?>"
                  type="number"
                  value="1">
              </div>
            </div>
            <div class="prodAddToCart">
              <button
                type="button"
                onclick="addToCar(<?PHP echo $sid; ?>)">
                Add To Cart
              </button>
            </div>
          </div>
          <div style="clear: left"></div>
        </div>
      <?PHP } ?>
        </div>
      </div>
    <?PHP } ?>
  <script>
    var action = "<?php echo $action; ?>";
  	var search = "<?php echo $txtSearch; ?>";
  	if(action == "addToCar") {
  		alert("Item Added to the Shopping Cart!");
  		navMan("shop.php?a=search&txtSearch=" + search);
  	}
  	function addToCar(ID) {
  		var Quantity=$("#quantity" + ID).val();
  		window.location = "shop.php?a=addToCar&sid=" +
  		ID + "&quantity=" + Quantity;
  	}
  	function loadURL(URL) {
        window.location = URL;
    }
	</script>

<?PHP
  build_footer();
?>
