<header>
  <div id="header">
    <div id="title">
      <!-- Will eventually be link to home page/index -->
      <h1>Backlit Books</h1>
    </div>
    <span> <i class="fa-solid fa-books"></i></span>
    <?php if (isset($searchbar)) : ?>
      <form id="searchForm" action="Search.php" method="GET">
        <div id="searchBar">
          <input type="text" placeholder=" Search" name="search_term">
          <button id="searchButton" type="submit" name="search" value="submit"> <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </div>
      </form>
    <?php endif; ?>
    <?php if (!isset($SignedOut)) : ?>
      <div class="nav">
        <label> <a href="Storefront.php">Store</a></label>
        <label>My Library</label>
        <label id="lastNav">My Account</label>
      </div>
    <?php endif; ?>
    <?php if (isset($SignedOut)) : ?>
      <div id="loginAndReg" class="nav">
        <label><a href="Login.php"> Login </a></label>
        <label id="noBorder"><a href="Register.php">Register</a></label>
      </div>
    <?php endif; ?>
  </div>
</header>