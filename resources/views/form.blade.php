<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap + DataTables CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" rel="stylesheet">

  <style>
    body {
    background: #f4f6f8;
    font-family: 'Segoe UI', sans-serif;
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

  .page-content {
    margin-left: 220px;
    padding: 80px 30px 30px 30px;
  }

  h2 {
    color: #2c3e50;
    font-weight: 700;
    margin-bottom: 30px;
    text-align: center;
  }

  .form-label {
    font-weight: 600;
    color: #2c3e50;
  }

  .form-select {
    background-color: #fef9e7;
    border-color: #dadfe1;
    color: #2c3e50;
    font-weight: 500;
    border-radius: 6px;
  }

  .form-select:focus {
    border-color: #2c3e50;
    box-shadow: 0 0 6px rgba(44, 62, 80, 0.3);
  }

  table.dataTable {
    border: 1px solid #dadfe1;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    background-color: #ffffff;
  }

  table.dataTable thead {
    background-color: #2c3e50;
    color: #ffffff;
    font-weight: bold;
    font-size: 1rem;
  }
    .form-control,
  .form-select,
  textarea.form-control {
    height: 45px;
    font-size: 15px;
    margin-top: 5px;
  }

  textarea.form-control {
    height: auto; /* So the intro box can be multiline */
    resize: vertical;
  }

  label.form-label {
    font-size: 15px;
    font-weight: 500;
  }

  .btn-primary {
    padding: 10px;
    font-size: 16px;
  }
  table.dataTable tbody tr:nth-of-type(even) {
    background-color: #f8f9fa;
  }

  table.dataTable tbody tr:nth-of-type(odd) {
    background-color: #ffffff;
  }

  table.dataTable tbody tr:hover {
    background-color: #ecf0f1;
  }

  .dataTables_wrapper .dataTables_filter input,
  .dataTables_wrapper .dataTables_length select {
    border: 1px solid #dadfe1;
    border-radius: 6px;
    padding: 6px;
    background-color: #ffffff;
    color: #2c3e50;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button {
    border-radius: 4px;
    margin: 2px;
    padding: 5px 10px;
    background-color: #ecf0f1;
    border: none;
    color: #2c3e50;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background-color: #2c3e50 !important;
    color: #ffffff !important;
  }

  .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #34495e;
    color: #ffffff;
  }

  .btn-primary:hover {
    background-color: #0056b3 !important;
    border-color: #0056b3 !important;
  }
  </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top p-3">
  <div class="container-fluid d-flex justify-content-between">
    <h5 class="mb-0 text-dark">Add New Club</h5>
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
<!-- TABLE SECTION -->
<div class="page-content px-4">
  <h2 class="mb-4">Existing Clubs</h2>
  <div class="table-responsive">
    <table id="clubTable" class="table table-striped table-bordered align-middle">
      <thead class="table-dark">
        <tr>
          <th>Sl.No</th>
          <th>Club Name</th>
          <th>Introduction</th>
          <th>Coordinator</th>
          <th>Email</th>
          <th>Year Started</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($clubs as $club)
        <tr>
          <td>{{ $loop->iteration }}</td>


          <td>{{ $club->club_name }}</td>
          <td>{{ $club->introduction }}</td>
          <td>{{ $club->staff_coordinator_name }}</td>
          <td>{{ $club->staff_coordinator_email }}</td>
          <td>{{ $club->year_started }}</td>

          <td>
            <button class="btn btn-sm btn-outline-primary edit-btn"
  data-id="{{ $club->id }}"
  data-name="{{ $club->club_name }}"
  data-intro="{{ $club->introduction }}"
  data-mission="{{ $club->mission }}"
  data-coord="{{ $club->staff_coordinator_name }}"
  data-email="{{ $club->staff_coordinator_email }}"
  data-year="{{ $club->year_started }}"
  data-logo="{{ asset('storage/' . $club->logo) }}"
  data-staffphoto="{{ asset('storage/' . $club->staff_coordinator_photo) }}">
  Edit
</button>


            <form action="{{ route('clubs.destroy', $club->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                Delete
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<!-- FORM SECTION -->
<div class="d-flex justify-content-center" style="margin-left: 220px; padding: 80px 20px 20px; background: #f4f6f8;">
  <div class="card p-3" style="width: 100%; max-width: 500px; box-shadow: 0 0 10px rgba(0,0,0,0.05); border-radius: 10px;">
    <div class="card-body p-3">
      <h5 class="text-center mb-3" style="color: #2c3e50; font-weight: 600;">Add / Update Club</h5>

      <form method="POST" action="{{ route('clubs.store') }}" enctype="multipart/form-data" id="clubForm">
        @csrf
        <div id="methodField"></div>

        <div class="mb-3">
          <label for="club_name" class="form-label">Club Name</label>
          <input type="text" class="form-control" id="club_name" name="club_name" placeholder="Enter club name" required>
        </div>

        <div class="mb-3">
          <label for="logo" class="form-label">Club Logo</label>
          <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
          <div class="mt-2">
            <img id="logoPreview" src="" style="max-height: 80px;" alt="Logo Preview">
          </div>
        </div>

        <div class="mb-3">
          <label for="introduction" class="form-label">Introduction</label>
          <textarea class="form-control" id="introduction" name="introduction" rows="3" placeholder="Brief description" required></textarea>
        </div>

        <div class="mb-3">
          <label for="mission" class="form-label">Mission</label>
          <textarea class="form-control" name="mission" id="mission" rows="2" placeholder="Enter club's mission" required></textarea>
        </div>

        <div class="mb-3">
          <label for="staff_coordinator_name" class="form-label">Staff Coordinator Name</label>
          <input type="text" class="form-control" id="staff_coordinator_name" name="staff_coordinator_name" placeholder="Staff name" required>
        </div>

        <div class="mb-3">
          <label for="staff_coordinator_email" class="form-label">Staff Email</label>
          <input type="email" class="form-control" id="staff_coordinator_email" name="staff_coordinator_email" placeholder="Email" required>
        </div>

        <div class="mb-3">
          <label for="staff_coordinator_photo" class="form-label">Staff Coordinator Photo</label>
          <input type="file" class="form-control" id="staff_coordinator_photo" name="staff_coordinator_photo" accept="image/*">
          <div class="mt-2">
            <img id="staffPhotoPreview" src="" style="max-height: 80px;" alt="Staff Photo Preview">
          </div>
        </div>

        <div class="mb-3">
          <label for="year_started" class="form-label">Year Started</label>
          <input type="text" class="form-control" id="year_started" name="year_started" placeholder="e.g., 2024" required>
        </div>

        <input type="hidden" id="club_id" name="club_id">

        <button type="submit" class="btn btn-primary w-100">Submit</button>
        <button type="button" class="btn btn-secondary w-100 mt-2" onclick="resetForm()">Cancel Edit</button>
      </form>
    </div>
  </div>
</div>

<script>
  const form = document.getElementById('clubForm');
  const methodField = document.getElementById('methodField');

  document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function () {
      methodField.innerHTML = '<input type="hidden" name="_method" value="PUT">';
      form.action = `/clubs/${this.dataset.id}`;

      document.getElementById('club_name').value = this.dataset.name;
      document.getElementById('introduction').value = this.dataset.intro;
      document.getElementById('mission').value = this.dataset.mission;
      document.getElementById('staff_coordinator_name').value = this.dataset.coord;
      document.getElementById('staff_coordinator_email').value = this.dataset.email;
      document.getElementById('year_started').value = this.dataset.year;
      document.getElementById('club_id').value = this.dataset.id;

      // Show logo preview only if present
      const logoUrl = this.dataset.logo;
      const staffPhotoUrl = this.dataset.staffphoto;

      document.getElementById('logoPreview').src = logoUrl ? logoUrl : '';
      document.getElementById('staffPhotoPreview').src = staffPhotoUrl ? staffPhotoUrl : '';
    });
  });

  function resetForm() {
    form.reset();
    form.action = "{{ route('clubs.store') }}";
    methodField.innerHTML = '';
    document.getElementById('logoPreview').src = '';
    document.getElementById('staffPhotoPreview').src = '';
  }
</script>





<!-- SCRIPTS -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


