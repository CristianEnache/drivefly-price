<nav class="navbar navbar-expand-md bg-light navbar-light shadow-sm px-sm-0">
   <div class="container-fluid">
       <a class="navbar-brand" href="#"><i class="fa d-inline fa-lg fa-plane"></i><strong> rishi2</strong></a>
       <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent"> <span class="navbar-toggler-icon"></span> </button>
     <div class="collapse navbar-collapse justify-content-between" id="navbar2SupportedContent">
       <ul class="navbar-nav">
         <li class="nav-item mx-2 active">
           <a class="nav-link" href="home.php">Home</a>
         </li>
         <li class="nav-item mx-2">
           <a class="nav-link" href="daily.php">Daily</a>
         </li>
         <li class="nav-item mx-2">
           <a class="nav-link" href="stats.php">Stats</a>
         </li>
         <li class="nav-item mx-2">
           <a class="nav-link" href="levels.php">Levels</a>
         </li>
         <li class="nav-item mx-2">
           <a class="nav-link" href="monthly.php">Monthly</a>
         </li>
         <li class="nav-item dropdown mx-2">
           <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Other</a>
           <div class="dropdown-menu" aria-labelledby="dropdown01">
             <a class="dropdown-item" href="daily_without_terminal.php">Daily without terminal</a>
             <a class="dropdown-item" href="prices.php">Prices</a>
             <a class="dropdown-item" href="products.php">Products</a>
             <a class="dropdown-item" href="extra_payments.php">Extra payments</a>
             <a class="dropdown-item" href="alerts.html">Alerts</a>
             <a class="dropdown-item" href="logs.php">Logs</a>
           </div>
         </li>
       </ul>
       <div class="d-inline-flex">
           <form class="form-inline my-2 my-lg-0 mx-2" onsubmit="return false;">
               <div class="input-group">
                 <input class="form-control data_search" type="text" placeholder="Search">
                 <div class="input-group-append">
                     <button class="btn btn-outline-secondary trigger_search">Search</button>
                 </div>
               </div>
           </form>
           <ul class="navbar-nav">
             <li class="nav-item">
               <a class="nav-link" href="add.php"><i class="fa d-inline fa-lg fa-plus-circle"></i></a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="#"><i class="fa d-inline fa-lg fa-cog"></i></a>
             </li>
             <li class="nav-item">
               <a class="nav-link" href="logout.php"><i class="fa d-inline fa-lg fa-sign-out-alt"></i></a>
             </li>
           </ul>
       </div>
     </div>
   </div>
</nav>
