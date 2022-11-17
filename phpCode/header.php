<header>
  <!-- Delete later  -->
  <div id="header">
    <div id="title">
      <!-- Will eventually be link to home page/index -->
      <h1>Backlit Books</h1>
    </div>
    <span> <i class="fa-solid fa-books"></i></span>
    <?php if (isset($_SESSION['store'])) : ?>
      <form id="searchForm" action="Search.php" method="GET">
        <div id="searchBar">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder=" Search" name="search_term">
        </div>
        <button id="searchButton" type="submit" name="search" value="submit">See all results</button>
      </form>
    <?php endif; ?>


    <?php if (isset($_SESSION['id'])) : ?>

      <div class="nav">
        <label> <a href="Storefront.php">Store</a></label>
        <label>My Library</label>
        <label id="lastNav">My Account</label>
      </div>
    <?php endif; ?>
    <div id="loginAndReg" class="nav">
      <label><a href="Login.php"> Login </a></label>
      <label id="noBorder"><a href="Register.php">Register</a></label>
    </div>
  </div>
</header>