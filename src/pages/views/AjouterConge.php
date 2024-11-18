<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RHRAD-CONGE</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Custom Styles */
        .container {
            max-width: 600px; /* Limit the width for better appearance */
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
            border-radius: 10px; /* Rounded corners */
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #007bff; /* Change title color */
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .form-control {
            border-radius: 8px;
        }
    </style>
</head>
<body>
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

<div class="container my-5 py-4">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">Ajouter au Congé</h4>
            <form method="POST" action="enregistrerConge.php">
                <div class="mb-3">
                    <label>Matricule de l'Employé</label>
                    <input type="text" name="Matricule" class="form-control" placeholder="Ex: EMP00123" required>
                </div>
                <div class="mb-3">
                    <label>Nom de l'Employé</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Date d'enregistrement</label>
                    <input type="date" name="Date_Enregistrement" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Date de Début</label>
                    <input type="date" name="DateDebut" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Date de Fin</label>
                    <input type="date" name="DateFin" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Type de Congé</label>
                    <select name="TypeConge" class="form-control" required>
                        <option value="">Sélectionnez le type de congé</option>
                        <option value="annuel">Congé Annuel</option>
                        <option value="maladie">Congé de Maladie</option>
                        <option value="maternite">Congé de Maternité</option>
                        <option value="mariage">Congé de mariage</option>
                        <option value="autre">Autre Congé</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Ajouter le Congé</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back();">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

<!-- container-scroller -->
<!-- plugins:js -->
<script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="../../assets/js/off-canvas.js"></script>
<script src="../../assets/js/template.js"></script>
<script src="../../assets/js/settings.js"></script>
<script src="../../assets/js/todolist.js"></script>
<!-- endinject -->
</body>
</html>
