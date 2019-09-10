<?PHP
  $authChk = true;
  require('app-lib.php');
  isset($_POST['a'])? $action = $_POST['a'] : $action = "";
  isset($_POST['txtSearch'])? $txtSearch = $_POST['txtSearch'] : $txtSearch = "";
  build_header($displayName);
?>

  <div id="content">
    <?PHP build_navBlock(); ?>
    <div id="mainC">
      <div class="PageTitle">Shop Search</div>
      <form name="frmSearchShop" method="post" id="frmSearchShop"
            action="<?PHP echo $_SERVER['PHP_SELF']; ?>">
          <div class="displayPane">
            <div class="displayPaneCaption">Product List:</div>
            <div>
              <input name="txtSearch" id="txtSearch" placeholder="Search Shop"
              value="<?PHP echo $txtSearch; ?>">
              <button type="submit" id="btnSearch">Search</button>
            </div>
          </div>
        <input type="hidden" name="a" value="search">
      </form>

      <?PHP
        if($action == "search") {
          $itemNum = 1;
          openDB();
          $query =
          "SELECT
            *
          FROM
            lpa_stock
          WHERE
            lpa_stock_name LIKE '%$txtSearch%'
          ORDER BY
            lpa_stock_name ASC
          ";
          $result = $db->query($query);
          $cicle = 0;
          while ($row = $result->fetch_assoc()) {
            if ($row['lpa_stock_image']) {
              $prodImage = $row['lpa_stock_image'];
            } else {
              $prodImage = "question.png";
            }
            $prodID = $row['lpa_stock_ID'];
          ?>
          <?PHP if ($cicle <= 11){ ?>
            <div id="prod<?PHP echo $cicle?>" class="productListItem">
              <div class="productListItemImageFrame"
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
                      name="fldQTY-<?PHP echo $prodID; ?>"
                      id="fldQTY-<?PHP echo $prodID; ?>"
                      type="number"
                      value="1">
                  </div>
                </div>
                <div class="prodAddToCart">
                  <button
                    type="button"
                    onclick="addToCart('<?PHP echo $prodID; ?>')">
                    Add To Cart
                  </button>
                </div>
              </div>
            </div>
                <?PHP
                  $cicle ++;
                  }
                  ?>
        <?PHP }?>
        </div>
      </div>
      <?PHP } ?>
    <script>
      function loadURL(URL) {
        window.location = URL;
      }
    </script>
    <?PHP build_footer(); ?>
