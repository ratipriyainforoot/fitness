<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Project</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Add Project</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Add project Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                    <form class="p-4 row g-3 needs-validation" novalidate action="{{route('add-project-store')}}" method="POST">
                        @csrf
    
                        <div class="col-12">
                          <label for="yourUsername" class="form-label">Project Name</label>
                          <div class="input-group has-validation">
                            <input type="text" name="project" class="form-control" id="yourUsername" placeholder="Ecommerce, Landing Page, Wordpress" required>
                            <div class="invalid-feedback">Enter Project Name.</div>
                          </div>
                        </div>
                        
                        <div class="col-12">
                          <button class="btn btn-primary w-100" type="submit">Add Project</button>
                        </div>
                    </form>
                </div>
              </div>

            </div>
            <!-- End Add Project Card -->
          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main>
  <!-- End #main -->

<x-admin-footer/>