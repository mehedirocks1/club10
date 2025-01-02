<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
      margin: 0;
      height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .sidebar {
      background: #343a40;
      color: white;
      height: 100vh;
      padding: 20px;
    }

    .sidebar h4 {
      text-align: center;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .sidebar .nav-item {
      margin-bottom: 10px;
    }

    .sidebar .nav-item a {
      display: block;
      padding: 10px 15px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      color: white;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .sidebar .nav-item:nth-child(odd) a {
      background-color: #6c757d;
    }

    .sidebar .nav-item:nth-child(even) a {
      background-color: #495057;
    }

    .sidebar .nav-item a:hover {
      background-color: #17a2b8;
      color: white;
    }

    .sidebar .submenu {
      padding-left: 20px;
    }

    .sidebar .submenu a {
      background-color: #5a6268 !important;
      margin-top: 5px;
    }

    .sidebar .submenu a:hover {
      background-color: #17a2b8 !important;
    }

    .header {
      background-color: #007bff;
      color: white;
      padding: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header h1 {
      font-size: 1.5rem;
      margin: 0;
    }

    .header .user-info {
      display: flex;
      align-items: center;
    }

    .header .user-info span {
      margin-right: 15px;
      font-weight: bold;
    }

    .main-content {
      padding: 20px;
    }

    .dashboard-boxes {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .dashboard-box {
      padding: 20px;
      color: white;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
      text-align: center;
      font-size: 1.2rem;
    }

    .dashboard-box:nth-child(1) {
      background-color: #ff6f61;
    }

    .dashboard-box:nth-child(2) {
      background-color: #6bc5d2;
    }

    .dashboard-box:nth-child(3) {
      background-color: #ffd166;
    }

    .dashboard-box:nth-child(4) {
      background-color: #6b5b95;
    }

    @media (max-width: 768px) {
      .sidebar {
        height: auto;
        margin-bottom: 20px;
      }

      .header {
        flex-wrap: wrap;
        text-align: center;
      }

      .header .user-info {
        margin-top: 10px;
      }
    }
  </style>
</head>
<body>
  <div class="container-fluid h-100">
    <div class="row h-100">
      <!-- Sidebar -->
      <div class="col-lg-2 col-md-3 sidebar">
        <h4>Dashboard</h4>
        <ul class="nav flex-column">
          <!-- Manage Users -->
          <li class="nav-item">
            <a href="#manageUsersMenu" data-bs-toggle="collapse">Manage Users</a>
            <div class="collapse submenu" id="manageUsersMenu">
              <a href="#" class="nav-link">View Roles</a>
              <a href="#" class="nav-link">View Users</a>
              <a href="#" class="nav-link">Menu Permission</a>
              <a href="#" class="nav-link">Add User/Admin</a>
            </div>
          </li>
          <!-- Manage Profile -->
          <li class="nav-item">
            <a href="#manageProfileMenu" data-bs-toggle="collapse">Manage Profile</a>
            <div class="collapse submenu" id="manageProfileMenu">
              <a href="#" class="nav-link">Your Profile</a>
              <a href="#" class="nav-link">Change Password</a>
            </div>
          </li>
          <!-- Site Settings -->
          <li class="nav-item">
            <a href="#siteSettingsMenu" data-bs-toggle="collapse">Site Settings</a>
            <div class="collapse submenu" id="siteSettingsMenu">
              <a href="#" class="nav-link">Change Logo</a>
              <a href="#" class="nav-link">View Contact</a>
              <a href="#" class="nav-link">View Slider</a>
              <a href="#" class="nav-link">View About</a>
            </div>
          </li>
          <!-- Manage Members -->
          <li class="nav-item">
            <a href="#manageMembersMenu" data-bs-toggle="collapse">Manage Members</a>
            <div class="collapse submenu" id="manageMembersMenu">
              <a href="#" class="nav-link">View Members</a>
              <a href="#" class="nav-link">View Members Editor</a>
            </div>
          </li>
        </ul>
      </div>

      <!-- Main Content -->
      <div class="col-lg-10 col-md-9">
        <!-- Header -->
        <div class="header">
          <h1>Welcome to Dashboard</h1>
          <div class="user-info">
            <span>Mehedi Hasan</span>
            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
              @csrf
              <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
          </div>
        </div>

        <!-- Dashboard Boxes -->
        <div class="main-content">
          <div class="dashboard-boxes">
            <div class="dashboard-box">Users</div>
            <div class="dashboard-box">Orders</div>
            <div class="dashboard-box">Revenue</div>
            <div class="dashboard-box">Feedback</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
