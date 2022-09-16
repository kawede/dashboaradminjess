 <?php include("pages/forms/header.php"); ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="./dist/img/AGA_PNG.png" alt="Astute Global Academy" height="60" width="60">
  </div> -->

  <!-- Navbar -->
 <?php include ("pages/forms/nav.php"); ?>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <?php include("pages/forms/menu_left.php") ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include("pages/forms/head.php"); ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php 
      if(isset($_SESSION['user']['niveau'])){
      if($_SESSION['user']['niveau'] === '1'){ 
    ?>
    <section class="content">
        <div class="container-fluid">
        <h5 class="mb-2">Info Box</h5>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">users</span> 
                <span class="info-box-number"><?php echo(comptUsers($db)) ?></span>
              </div>
              <!-- /.info-box-content --> 
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">cour</span>
                <span class="info-box-number"><?php echo(comptUsers($db)) ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fa fa-user"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">formateur</span>
                <span class="info-box-number"><?php echo(comptfomateur($db)) ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">classes crées</span>
                <span class="info-box-number"><?php echo(comptfomateur($db)) ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <?php   
                }
              }
            ?>
              <?php 
          if(isset($_SESSION['user']['niveau'])){
          if($_SESSION['user']['niveau'] === '2'){ 
        ?>
        <div class="col-md-3 col-sm-6 col-12">
           <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                    <i class="fa fa-user" style="font-size:50px"> </i>  
                </div>

                <h3 class="profile-username text-center"><?php echo $_SESSION['user']['user_nom']; ?></h3>

                <p class="text-muted text-center"><?php echo $_SESSION['user']['user_email']; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Satut</b> <a class="float-right"><?php echo $_SESSION['user']['niveau']; ?></a>
                  </li>
                  
                </ul>

                <a href="profile" class="btn btn-danger btn-block"><b>Commencer</b></a>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
         <?php   
               }
              }
            ?>
        </div>
      
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php include("pages/forms/footer.php"); ?>