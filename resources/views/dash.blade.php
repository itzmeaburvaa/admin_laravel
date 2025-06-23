<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Dashboard</title>

  <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
  <style>
body {
  background: #f4f6f8;
  font-family: 'Segoe UI', sans-serif;
  margin: 0;
}

.navbar {
  background-color: #fff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  z-index: 1000;
}

.sidebar {
  width: 240px;
  background-color: #2c3e50;
  color: #fff;
  height: 100vh;
  position: fixed;
  top: 56px;
  left: 0;
  padding-top: 20px;
}

.sidebar .nav-link {
  color: #dee2e6;
  padding: 12px 20px;
  font-size: 15px;
  border-radius: 4px;
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active {
  background-color: #34495e;
  color: #fff;
}

.main-panel {
  margin-left: 240px;
  padding: 30px 40px;
}

.card {
  border-radius: 1rem;
  transition: all 0.3s ease-in-out;
  border: none;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
}

.card-body {
  text-align: center;
}

.card-title {
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 0.5rem;
}

.fw-bold {
  font-size: 30px;
  font-weight: 700 !important;
}

.footer {
  background-color: #ffffff;
  border-top: 1px solid #dee2e6;
  padding: 15px 0;
  font-size: 14px;
}

</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow-sm">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <h4 class="mb-0 text-dark">Admin Dashboard</h4>
    <a href="{{ url('/logout') }}" class="btn btn-outline-danger">
      <i class="mdi mdi-logout me-1"></i> Sign Out
    </a>
  </div>
</nav>

<div class="container-fluid page-body-wrapper d-flex p-0" style="margin-top: 0px;">
  <!-- Sidebar -->
  <nav class="sidebar">
    <ul class="nav flex-column">
      <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ url('/dashboard') }}">
          <i class="mdi mdi-home me-2"></i> Dashboard
        </a>
      </li>
      <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ url('/form') }}">
          <i class="mdi mdi-plus-box me-2"></i> Add New Club
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ url('/table') }}">
          <i class="mdi mdi-table-large me-2"></i> Tables
        </a>
      </li>
    </ul>
  </nav>

  <!-- Main Content -->
  <div class="main-panel flex-grow-1">
    <div class="content-wrapper">
      <div class="row mb-4">
        <div class="col-12">
          <h3 class="text-dark fw-bold mt-0">Club Enrollment Dashboard</h3>
          <p class="text-muted">Live overview of club enrollments by 1st year students</p>
        </div>
      </div>

      <!-- Summary Cards -->
<div class="row mb-4">
  <div class="col-lg-4 col-md-6">
    <div class="card shadow-sm text-dark" style="background-color: #ffe4ec;">
      <div class="card-body">
        <h5 class="card-title">Total Clubs</h5>
        <h2 class="fw-bold">{{ $totalClubs }}</h2>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6">
    <div class="card shadow-sm text-dark" style="background-color: #fff2e6;">
      <div class="card-body">
        <h5 class="card-title">Total Club Applications</h5>
        <h2 class="fw-bold">{{ $totalApplications }}</h2>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-12">
    <div class="card shadow-sm text-dark" style="background-color: #d2f1f0;">
      <div class="card-body">
        <h5 class="card-title">Total Distinct Students</h5>
        <h2 class="fw-bold">{{ $totalStudents }}</h2>
      </div>
    </div>
  </div>
</div>


      <!-- Charts Row -->
      <!-- Charts Row -->
<div class="row mb-4">
  <div class="col-lg-6">
    <div class="card shadow-sm">
      <div class="card-body text-center">
        <h6 class="fw-semibold mb-3">📊 Department-wise Distribution</h6>
        <canvas id="dept-chart" height="180"></canvas>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card shadow-sm">
      <div class="card-body text-center">
        <h6 class="fw-semibold mb-3">🌟 Top 3 Popular Clubs</h6>
        <canvas id="popular-clubs-chart" height="180"></canvas>
      </div>
    </div>
  </div>
</div>


      <!-- Footer -->
      <footer class="footer mt-auto py-3 bg-light text-center">
        <div class="container">
          <span class="text-muted">© 2025 Club Admin Panel</span>
        </div>
      </footer>

    </div>
  </div>
</div>


<!-- Scripts -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const deptData = @json($departmentDistribution);
  const clubData = @json($popularClubs);

  new Chart(document.getElementById("dept-chart"), {
    type: "bar",
    data: {
      labels: Object.keys(deptData),
      datasets: [{
        label: "Students",
        data: Object.values(deptData),
        backgroundColor: ['#f3e8ff', '#d2f1f0', '#ffe4ec', '#fff7d1', '#d7fcd4']
      }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
  });

  new Chart(document.getElementById("popular-clubs-chart"), {
    type: "bar",
    data: {
      labels: Object.keys(clubData),
      datasets: [{
        label: "Applications",
        data: Object.values(clubData),
        backgroundColor: ['#c4f0ff', '#fcdada', '#ffe4ec']
      }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
  });
</script>
</body>
</html>
