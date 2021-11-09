<nav id='nav'>
   <i id="exit" class='bx bxs-exit' ></i>
   <div class="cont-nav d-flex flex-column">
      <div class="brand">
         <img src="images/logo.png" alt="LOGO">
      </div>
      <div class="links">
         <a href="dashboard.php" class="nav-link <?php setActiveClass("Dashboard") ?>"><i class='bx bxs-dashboard'></i> Dashboard</a>
         <li class="nav-link dropdown p-0"> 
            <a class="nav-link dropdown-toggle <?php setActiveClass("Inventory") ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
               <i class='bx bxs-cube'></i> Inventory
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
               <li><a class="dropdown-item" href="inventory.php">View All Items</a></li>
               <li><hr class="dropdown-divider"></li>
               <li><a class="dropdown-item" href="inventory.php?action=add-items">Add items</a></li>
            </ul>
         </li>
         <a href="purchase.php" class="nav-link <?php setActiveClass("Purchase") ?>"><i class='bx bxs-cart-alt'></i> Purchase</a>
         <a href="customers.php" class="nav-link <?php setActiveClass("Customers") ?>"><i class='bx bxs-user-detail'></i> Customers</a>
         <a href="messages.php" class="nav-link <?php setActiveClass("Messages") ?>"><i class='bx bxs-envelope'></i> Messages</a>
         <a href="settings.php" class="nav-link <?php setActiveClass("Settings") ?>"><i class='bx bxs-cog'></i> Settings</a>
      </div>
   </div>
</nav>