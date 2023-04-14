<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Country</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Add Country</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="card p-4">
            <div class="card-body">

              <!-- Add Category Form -->
              <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('add-country-store')}}">
                @csrf
                <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" name="name" class="form-control" id="floatingFname" placeholder="Country name" required>
                      <label for="floatingFname">Country Name</label>
                      <div class="invalid-feedback">Please enter country Name.</div>
                    </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>
              <!-- End Add Employee Form -->

            </div>
          </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

<x-admin-footer/>