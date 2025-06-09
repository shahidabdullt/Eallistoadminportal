<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inventory App</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CSS + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    /* Navbar */
    .navbar { padding: .5rem 1rem; }
    .navbar-brand { color: #e63946; font-weight: bold; }
    .nav-link { color: #333; font-weight: 500; }
    .nav-link:hover { color: #000; }

    /* Show dropdown on hover */
    .dropdown:hover .dropdown-menu {
      display: block;
      margin-top: 0;
    }

    /* Card-style items */
    .dropdown-menu {
      width: 600px; /* adjust to taste */
      padding: 1rem 0;
      border-radius: .5rem;
      box-shadow: 0 4px 12px rgba(0,0,0,.1);
    }
    .dropdown-grid {
      display: flex;
      padding: 0 1rem;
    }
    .dropdown-col {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: .75rem;
      padding-right: 1rem;
      border-right: 1px solid #eee;
    }
    .dropdown-col:last-child {
      border-right: none;
      padding-right: 0;
      padding-left: 1rem;
    }
    .dropdown-item-card {
      display: flex;
      align-items: start;
      gap: .75rem;
      padding: .5rem;
      border-radius: .5rem;
      text-decoration: none;
      color: #333;
      transition: background .2s;
    }
    .dropdown-item-card:hover {
      background: #f8f9fa;
    }
    .dropdown-item-card .bi {
      font-size: 1.5rem;
      color: #e63946;
    }
    .dropdown-item-card small {
      color: #6c757d;
    }

    /* Footer links */
    .dropdown-footer {
      display: flex;
      justify-content: space-between;
      padding: .5rem 1rem 1rem;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
      <a class="navbar-brand" href="#">Sortly</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ms-auto align-items-center">

          <!-- Features (hover menu) -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="featuresDropdown">Features</a>
            <ul class="dropdown-menu" aria-labelledby="featuresDropdown">
              <li><a class="dropdown-item" href="#">Feature A</a></li>
              <li><a class="dropdown-item" href="#">Feature B</a></li>
              <li><a class="dropdown-item" href="#">Feature C</a></li>
            </ul>
          </li>

          <!-- Solutions (card-style hover menu) -->
          <li class="nav-item dropdown ms-3">
            <a class="nav-link dropdown-toggle" href="#" id="solutionsDropdown">Solutions</a>
            <div class="dropdown-menu" aria-labelledby="solutionsDropdown">
              
              <div class="dropdown-grid">
                <!-- Use Cases Column -->
                <div class="dropdown-col">
                  <strong>USE CASES</strong>
                  <a href="#" class="dropdown-item-card">
                    <i class="bi bi-box"></i>
                    <div>
                      <div>Inventory Management</div>
                      <small>Manage, organize, and track all your business’s inventory.</small>
                    </div>
                  </a>
                  <a href="#" class="dropdown-item-card">
                    <i class="bi bi-truck"></i>
                    <div>
                      <div>Supplies Tracking</div>
                      <small>Track the supplies, materials, and parts your business uses.</small>
                    </div>
                  </a>
                  <a href="#" class="dropdown-item-card">
                    <i class="bi bi-gear"></i>
                    <div>
                      <div>Asset Tracking</div>
                      <small>Track tools, equipment, and other high-value assets with ease.</small>
                    </div>
                  </a>
                </div>

                <!-- Industries Column -->
                <div class="dropdown-col">
                  <strong>INDUSTRIES</strong>
                  <a href="#" class="dropdown-item-card">
                    <i class="bi bi-cone-striped"></i>
                    <div>
                      <div>Construction</div>
                      <small>Manage construction inventory and tools across all job sites.</small>
                    </div>
                  </a>
                  <a href="#" class="dropdown-item-card">
                    <i class="bi bi-heart-pulse"></i>
                    <div>
                      <div>Medical</div>
                      <small>Seamlessly manage medical supplies & equipment on-the-go.</small>
                    </div>
                  </a>
                  <a href="#" class="dropdown-item-card">
                    <i class="bi bi-archive"></i>
                    <div>
                      <div>Warehouse</div>
                      <small>Simplify warehouse operations with smarter inventory tracking.</small>
                    </div>
                  </a>
                </div>
              </div>

              <hr class="my-2">

              <div class="dropdown-footer">
                <a href="#" class="text-decoration-none">Solutions →</a>
                <a href="#" class="text-decoration-none">Industries →</a>
              </div>
            </div>
          </li>

          <li class="nav-item ms-3"><a class="nav-link" href="#">Enterprise</a></li>
          <li class="nav-item ms-3"><a class="nav-link" href="#">Pricing</a></li>

          <!-- Learn (simple dropdown) -->
          <li class="nav-item dropdown ms-3">
            <a class="nav-link dropdown-toggle" href="#" id="learnDropdown">Learn</a>
            <ul class="dropdown-menu" aria-labelledby="learnDropdown">
              <li><a class="dropdown-item" href="#">Blog</a></li>
              <li><a class="dropdown-item" href="#">Help Center</a></li>
            </ul>
          </li>

          <li class="nav-item ms-4"><a class="nav-link" href="#">Login</a></li>
          <li class="nav-item ms-3">
            <a class="btn btn-danger px-4" href="#">Start Free Trial</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero, Solutions grid, etc. (unchanged) -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
