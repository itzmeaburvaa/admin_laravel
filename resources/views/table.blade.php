<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Club Enrollment Table</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap + DataTables CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  <style>
    body {
      background: #f4f6f8;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #ffffff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      z-index: 1000;
    }

    .sidebar {
      width: 220px;
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
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background-color: #34495e;
      color: #fff;
    }

    .sidebar .menu-icon {
      margin-right: 10px;
    }

    .main-content {
      margin-left: 240px; /* sidebar width + gap */
      padding: 30px;
      margin-top: 70px;
    }

    h2 {
      color: #2c3e50;
      font-weight: 700;
      margin-bottom: 30px;
      text-align: center;
    }

    table.dataTable thead {
      background-color: #2c3e50;
      color: white;
    }

    table.dataTable tbody tr:nth-of-type(even) {
      background-color: #f8f9fa;
    }

    table.dataTable tbody tr:hover {
      background-color: #ecf0f1;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top p-3">
  <div class="container-fluid d-flex justify-content-between">
    <h5 class="mb-0 text-dark">ENROLLMENT TABLE</h5>
    <a href="{{ url('/logout') }}" class="btn btn-outline-danger">
      <i class="mdi mdi-logout me-1"></i> Sign Out
    </a>
  </div>
</nav>

<!-- SIDEBAR -->
<nav class="sidebar" id="sidebar">
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/dashboard') }}">
        <i class="mdi mdi-home menu-icon"></i><span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="{{ url('/form') }}">
        <i class="mdi mdi-plus-box menu-icon"></i><span class="menu-title">Add New Club</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ url('/table') }}">
        <i class="mdi mdi-table-large menu-icon"></i><span class="menu-title">Tables</span>
      </a>
    </li>
  </ul>
</nav>


<!-- MAIN CONTENT -->
<div class="main-content">
  <h2>Club Enrollment Table</h2>

  <!-- FILTERS -->
  <div class="row mb-4">
  <div class="col-md-6">
    <label for="deptFilter" class="form-label fw-semibold">Filter by Department</label>
    <select id="deptFilter" class="form-select">
      <option value="">All Departments</option>
      @foreach ($departments as $dept)
        <option value="{{ $dept }}">{{ $dept }}</option>
      @endforeach
    </select>
  </div>

  <div class="col-md-6">
    <label for="clubFilter" class="form-label fw-semibold">Filter by Club</label>
    <select id="clubFilter" class="form-select">
      <option value="">All Clubs</option>
      @foreach ($clubs as $club)
        <option value="{{ $club->club_name }}">{{ $club->club_name }}</option>
      @endforeach
    </select>
  </div>
</div>

  <!-- TABLE -->
  <div class="table-responsive">
    <table id="clubTable" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Department</th>
          <th>Club Enrolled</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($students as $student)
          <tr>
            <td>{{ $student->name }}</td>
            <td>{{ $student->department }}</td>
            <td>{{ $student->club_enrolled }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
  $(document).ready(function () {
    const table = $('#clubTable').DataTable();

    $('#deptFilter, #clubFilter').on('change', function () {
      const dept = $('#deptFilter').val().toLowerCase();
      const club = $('#clubFilter').val().toLowerCase();

      table.rows().every(function () {
        const data = this.data();
        const deptMatch = !dept || data[1].toLowerCase() === dept;
        const clubMatch = !club || data[2].toLowerCase() === club;

        $(this.node()).toggle(deptMatch && clubMatch);
      });
    });
  });
</script>


</body>
</html>
