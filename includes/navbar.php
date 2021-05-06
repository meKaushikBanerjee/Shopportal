<nav class="navbar navbar-expand-lg">
  <a class="navbar-brand" href="/">Kaushik's</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon dropdown-toggle"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-md-center js-navbar-collapse" id="navbarsExample10">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
        <div class="dropdown-content" aria-labelledby="dropdown10">
          <div class="row">
            <div class="column category-header">
              <h5>Electronics</h5>
              <a class="dropdown-item" href="category.php?pcat=4&scat=4">Mobile</a>
              <a class="dropdown-item" href="category.php?pcat=4&scat=7">Desktop</a>
              <a class="dropdown-item" href="category.php?pcat=4&scat=6">Laptop</a> 
              <a class="dropdown-item" href="category.php?pcat=4&scat=3">Television</a>
              <a class="dropdown-item" href="category.php?pcat=4&scat=2">Led Television</a>
              <a class="dropdown-item" href="category.php?pcat=4&scat=5">Mobile Accessories</a>
            </div>
            <div class="column category-header">
              <h5>Furniture</h5>
              <a class="dropdown-item" href="category.php?pcat=5&scat=10">Sofa</a>
              <a class="dropdown-item" href="category.php?pcat=5&scat=11">Dining Table</a>
              <a class="dropdown-item" href="category.php?pcat=5&scat=9">Bed</a>
            </div>
            <div class="column category-header">
              <h5>Books</h5>
              <a class="dropdown-item" href="category.php?pcat=3&scat=8">Comics</a>
            </div>
            <div class="column category-header">
              <h5>Fashion</h5>
              <a class="dropdown-item" href="category.php?pcat=6&scat=12">Men Footware</a>
            </div>
          </div>
          <!--<div class="row">
            <div class="column category-header">
              <h5>Category 1</h5>
              <a class="dropdown-item" href="#">Link 1</a>
              <a class="dropdown-item" href="#">Link 2</a>
              <a class="dropdown-item" href="#">Link 3</a>
            </div>
            <div class="column category-header">
              <h5>Category 2</h5>
              <a class="dropdown-item" href="#">Link 1</a>
              <a class="dropdown-item" href="#">Link 2</a>
              <a class="dropdown-item" href="#">Link 3</a>
            </div>
            <div class="column category-header">
              <h5>Category 3</h5>
              <a class="dropdown-item" href="#">Link 1</a>
              <a class="dropdown-item" href="#">Link 2</a>
              <a class="dropdown-item" href="#">Link 3</a>
            </div>
            <div class="column category-header">
              <h5>Category 3</h5>
              <a class="dropdown-item" href="#">Link 1</a>
              <a class="dropdown-item" href="#">Link 2</a>
              <a class="dropdown-item" href="#">Link 3</a>
            </div>
          </div>-->
        </div>
      </li>
      <!--<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
        <div class="dropdown-menu" aria-labelledby="dropdown10">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>-->
      <?php 
        if(isset($_SESSION['login']))
        {
          if($_SESSION['login'] == 1)
          { 
      ?>
            <li class="nav-item">
              <a class="nav-link" href="login-signup.php">Login/Signup</a>  
            </li>
      <?php
          }
        }
        if(isset($_SESSION['logout']))
        {
          if($_SESSION['logout'] == 1)
          {
      ?>
            <li class="nav-item">
              <a class="nav-link" href="logout.php">Logout</a>  
            </li>
      <?php
          }
        }
        else
        {
      ?>
          <li class="nav-item">
            <a class="nav-link" href="login-signup.php">Login/Signup</a>  
          </li>
      <?php
        }
      ?>
      <li class="nav-item">
        <a class="nav-link" href="contact-us.php">Contact</a>
      </li>
    </ul>
  </div>
</nav>