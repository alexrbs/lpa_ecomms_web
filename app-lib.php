<?PHP
/**
 * Set the global time zone
 *   - for Brisbane Australia (GMT +10)
 */
date_default_timezone_set('Australia/Queensland');


/**
 * Global variables
 */

// Database instance variable
$db = null;
$displayName = "";
$displayGroup = "";

// Start the session
session_name("lpaecomms");
session_start();

isset($_SESSION["authUser"])?
  $authUser = $_SESSION["authUser"] :
  $authUser = "";

if(isset($authChk) == true) {
  if($authUser) {
    openDB();
    $query = "SELECT * FROM lpa_users WHERE lpa_user_ID = '$authUser' LIMIT 1";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $displayName = $row['lpa_user_firstname']." ".$row['lpa_user_lastname'];
    $displayGroup = $row['lpa_user_group'];
  } else {
    header("location: login.php");
  }
}

/**
 * Connect to database Function
 * - Connect to the local MySQL database and create an instance
 */
function openDB() {
  global $db;
  if(!is_resource($db)) {
    /* Conection String eg.: mysqli("localhost", "lpaecomms", "letmein", "lpaecomms")
     *   - Replace the connection string tags below with your MySQL parameters
     */
    $db = new mysqli(
      "localhost",
      "root",
      "",
      "lpa_ecomms"
    );
    if ($db->connect_errno) {
      echo "Failed to connect to MySQL: (" .
        $db->connect_errno . ") " .
        $db->connect_error;
    }
  }
}

/**
 * Close connection to database Function
 * - Close a connection to the local MySQL database instance
 * @throws Exception
 */
function closeDB() {
  global $db;
  try {
    if(is_resource($db)) {
      $db->close();
    }
  } catch (Exception $e)
  {
    throw new Exception( 'Error closing database', 0, $e);
  }
}


/**
 * System Logout check
 *
 *  - Check if the logout button has been clicked, if so kill session.
 */
if(isset($_REQUEST['killses']) == "true") {
  $_SESSION = array();
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
      $params["path"], $params["domain"],
      $params["secure"], $params["httponly"]
    );
  }
  session_destroy();
  header("location: login.php");
}




/**
 *  Build the page header function
 */
function build_header() {
  global $displayName;
  global $displayGroup;

  include 'header.php';
}


//Begining of the function Build the Navigation block with an administrator check

function build_navBlock() {
  global $displayGroup;
  /*
  Coloquei as condicoes 'if' e 'else' dentro dessa funcao que constroi o navBlock
  O 'if' verifica se a variavel $displayGroup tem o valor "administrator". Se sim, ela monta o navBlock que esta dentro
  da condicao. Se nao, ela vai para o 'else' e monta aquele navBlock sem aquela div de registro
  */
  if ($displayGroup == "administrator") { //Condiction to build the navBlock with the admin tab 'register'
    ?>
    <div id="navBlock">
      <div id="navHeader">MAIN MENU</div>
      <div id="navHome"class="navItem" onclick="navMan('index.php')">HOME</div>
      <div id="navStock"class="navItem" onclick="navMan('stock.php')">STOCK</div>
      <div id="navSales" class="navItem" onclick="navMan('sales.php')">SALES</div>
      <div id="navReg" class="navItem" onclick="navMan('reg.php')">REGISTER</div>
      <div class="menuSep"></div>
      <div id="navLog" onclick="navMan('login.php?killses=true')">LOGOUT</div>
    </div>
    <?PHP
  }else {      //If it does not fall under the admin condiction it builds the navBlock without the admin tab 'register'
      ?>
        <div id="navBlock">
          <div id="navHeader">MAIN MENU</div>
          <div id="navHome"class="navItem" onclick="navMan('index.php')">HOME</div>
          <div id="navStock"class="navItem" onclick="navMan('stock.php')">STOCK</div>
          <div id="navSales" class="navItem" onclick="navMan('sales.php')">SALES</div>
          <div class="menuSep"></div>
          <div id="navLog" onclick="navMan('login.php?killses=true')">LOGOUT</div>
        </div>
      <?PHP
  }
}
//End of the Navigation Block function

//Generating ID from the last ID registered on the database
function gen_ID() {
  openDB();
  global $db;
  $query = "SELECT lpa_inv_no FROM lpa_invoices ORDER BY lpa_inv_no DESC LIMIT 1";
  $result = $db->query($query);
  $row = $result->fetch_assoc();
  $ID = (int) $row['lpa_inv_no'];
  return $ID + 1;
  
}

/**
 *  Build the page footer function
 */
function build_footer() {
  include 'footer.php';
}


?>
