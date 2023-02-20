<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Add Category</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="card p-4">
            <div class="card-body">

              <!-- Add Category Form -->
              <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('add-category-store')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" name="title" class="form-control" id="floatingFname" placeholder="banner Title" required>
                      <label for="floatingFname">Category</label>
                      <div class="invalid-feedback">Please enter category name.</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" name="title_ar" class="form-control" id="floatingFname" placeholder="banner Title" required>
                      <label for="floatingFname">Category Arabic</label>
                      <div class="invalid-feedback">Please enter category name(arabic).</div>
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
    <script>
        function triggerUpload() {
            let profileImageUpload = document.getElementById('profileImageUpload');
            profileImageUpload.click();
        }
        function showPreview(event) {
            if(event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById('bannerImagePreview');
                preview.src = src;
            }
        }
    </script>

  </main>
  <!-- End #main -->

<x-admin-footer/>