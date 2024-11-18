<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
      <style>/* Assurez-vous que le footer est fixé en bas de la page */
          html, body {
              height: 100%;
              margin: 0;
          }

          body {
              display: flex;
              flex-direction: column;
          }

          .footer {
              margin-top: auto; /* Cela pousse le footer vers le bas */
              background-color: #f8f9fa; /* Couleur de fond pour le footer */
              padding: 10px; /* Espacement interne */
          }

          /* Assurez-vous que le footer est responsive */
          @media (max-width: 576px) {
              .footer .d-sm-flex {
                  flex-direction: column;
                  align-items: center;
              }
              .footer .text-sm-left {
                  text-align: center;
              }
          }
      </style>
  </head>
  <body>
  <div class="container-scroller">
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
              <a class="navbar-brand brand-logo me-5 d-flex align-items-center" href="#">
                  <div class="d-flex align-items-center">
                      <img src="../../assets/images/logo_RHRAD.png" style="position: fixed" alt="logo" width="110" height="60" />
                  </div>
              </a>


          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
              <ul class="navbar-nav navbar-nav-right">
                  <li class="nav-item dropdown">
                      <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="login.php" data-bs-toggle="dropdown">
                          <button type="button" class="btn btn-outline-danger btn-fw">Se déconnecter</button>
                      </a>
              </ul>
          </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
          <nav class="sidebar sidebar-offcanvas" id="sidebar">
              <ul class="nav">
                  <li class="nav-item">
                      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                          <i class="icon-layout menu-icon"></i>
                          <span class="menu-title">Consultation</span>
                          <i class="menu-arrow"></i>
                      </a>
                      <div class="collapse" id="ui-basic">
                          <ul class="nav flex-column sub-menu">
                              <li class="nav-item" style="right: 30px;"> <a class="nav-link" href="consultationProfils.php">Profils des employés</a></li>
                          </ul>
                      </div>
                  </li>
              </ul>
          </nav>
        <!-- partial -->

          <div class="main-panel">
              <div class="content-wrapper">
                  <div class="row">
                      <div class="col-lg-12 grid-margin stretch-card">
                          <div class="card">
                              <div class="card-body">
                                  <h4 class="card-title">Table des employés</h4>

                                  <!-- Formulaire de recherche -->
                                  <form method="GET" action="">
                                      <div class="input-group mb-3">
                                          <input type="text" name="query" class="form-control" style="border-radius: 50px;" placeholder="Recherche rapide avec le nom ou le matricule" aria-label="Recherche" aria-describedby="button-addon2">
                                          <div class="input-group-append">
                                              <button class="btn btn-outline-info" style="position: relative; left: 10px;top: 5px;" type="submit" id="button-addon2">Rechercher</button>
                                          </div>
                                      </div>
                                  </form>
                                  <?php
                                  include_once('traitement.php');
                                  $traitement = new traitement();
                                  $message = '';
                                  $searchResults = [];

                                  // Vérifier s'il y a une requête de recherche
                                  if (isset($_GET['query']) && !empty($_GET['query'])) {
                                      $query = $_GET['query'];
                                      $searchResults = $traitement->search($query, $query);

                                      // Vérifiez si la recherche a retourné des résultats
                                      if (empty($searchResults)) {
                                          $message = 'Employé introuvable';
                                      }
                                  }

                                  // Affichez tous les employés, indépendamment des résultats de la recherche
                                  $employes = $traitement->read();
                                  ?>

                                  <?php if ($message): ?>
                                      <div class="alert alert-danger" role="alert">
                                          <?php echo htmlspecialchars($message); ?>
                                      </div>
                                  <?php endif; ?>

                                  <div class="table-responsive">
                                      <table class="table table-striped">
                                          <thead>
                                          <tr>
                                              <th>N°</th>
                                              <th>Nom</th>
                                              <th>Postnom</th>
                                              <th>Prenom</th>
                                              <th>DateNaissance</th>
                                              <th>NumTelephone</th>
                                              <th>NomDivision</th>
                                              <th>Remuneration</th>
                                              <th>Genre</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          <?php foreach ($employes as $employe): ?>
                                              <tr>
                                                  <td><?php echo htmlspecialchars($employe['id']); ?></td>
                                                  <td><?php echo htmlspecialchars($employe['Nom']); ?></td>
                                                  <td><?php echo htmlspecialchars($employe['Postnom']); ?></td>
                                                  <td><?php echo htmlspecialchars($employe['Prenom']); ?></td>
                                                  <td><?php echo htmlspecialchars($employe['DateNaissance']); ?></td>
                                                  <td><?php echo htmlspecialchars($employe['NumTelephone']); ?></td>
                                                  <td><?php echo htmlspecialchars($employe['NomDivision']); ?></td>
                                                  <td><?php echo htmlspecialchars($employe['Remuneration']); ?></td>
                                                  <td><?php echo htmlspecialchars($employe['Genre']); ?></td>
                                              </tr>
                                          <?php endforeach; ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>


          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
    <?php
    include ('../../partials/footer.php');
    ?>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/template.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page-->
  </body>
</html>