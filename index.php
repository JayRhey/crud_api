<?php include './view/header/header.php'; ?>

<body>
  <nav>
    <div class="nav-wrapper">
      <div class="container">
        <a href="#" class="brand-logo">Logo</a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li><a href="/">Home</a></li>
              <li><a href="/">About</a></li>
          </ul>
      </div>
    </div>
  </nav><br>
  <div class="container">
    <div class="row">
      <div class="col s12 m12 l12 xl12">
        <div class="card blue-grey darken-1">
          <div class="card-content white-text">
            <span class="card-title">Personal Information</span>
            <div class="responsive-table">
            <table>
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Cell No.</th>
                  <th>Address</th>
                  <th>Email</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody id="dataTable">
               <!-- Data will be dynamically appended here -->
             </tbody>
            </table>
            </div>
          </div>
          <div class="card-action">
            <a href="#" id="createUser" data-target="modal1" class="modal-trigger">Create User</a>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include './view/footer/footer.php'; ?>
