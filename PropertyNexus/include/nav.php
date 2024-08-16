<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("adminDashboard/connection.php");

// Function to fetch the user's first name and admin status
function getUserInfo($userID, $db_conn) {
    $stmt = $db_conn->prepare("SELECT userFname, isAdmin FROM Users WHERE userID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $stmt->bind_result($userFname, $isAdmin);
    $stmt->fetch();
    $stmt->close();
    return [$userFname, $isAdmin];
}
function getPostId($p_ID , $db_conn) {
    $stmt = $db_conn->prepare("SELECT p_ID FROM properties WHERE p_ID = ?");
    $stmt->bind_param("i", $p_ID );
    $stmt->execute();
    $stmt->bind_result($p_ID );
    $stmt->fetch();
    $stmt->close();
    return [$p_ID ];
}

// Handle sign out
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php'); // Redirect to index page after logout
    exit();
}
?>


  <nav>
    <div class="logo">
      
      <a href="index.php"><img  src="images/new_logo.png" alt="Property Nexus Logo"> </a> 
      </div>
    <div class="links">
      <a href="index.php">HOME</a>
      <a href="#Service">SERVICE</a> 
      <a href="sub.php">PREMIUM</a>
      <a href="about.php">ABOUT</a>
      <a href="Q.php">FAQs</a>
      <a href="contact.php">CONTACT</a>
      
      <!-- <a id="darkModeToggle">Dark Mode</a> -->

   
      <?php if (!isset($_SESSION['userID'])): ?>
        <!-- Show Sign In and Register if not logged in -->
      <a  href="login.php" class="btns"> <button>Sign In</button></a>
      <a href="signup.php"class="btns"> <button>Register</button></a>
      <?php else: ?>
        <!-- Show Hello username and Sign Out if logged in -->
        <?php
        $userID = $_SESSION['userID'];
        list($userFname, $isAdmin) = getUserInfo($userID, $db_conn);
        ?><div class="after_logn">
        <?php if (!$isAdmin): ?>

        <a  href=".\include\profile.php"><button  data-id='{$userID}'><i class="fa-solid fa-user"></i></button></a>
        <?php endif; ?>
        <?php if ($isAdmin): ?>
         <a  href="adminDashboard/Dashboard.php"><button> Dashboard</button></a>
        <?php endif; ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="display:inline;">
      
    <a href=""> <button  name="logout" type="submit" class="logout"><i class="fa-solid fa-right-from-bracket"></i></button></a> 
        </div>
        </form>
      <?php endif; ?>
    </div> 
  </nav>
  <script>

document.getElementById("darkModeToggle").addEventListener("click", function() {
    document.body.classList.toggle("dark-mode");
});
</script>
  </script>