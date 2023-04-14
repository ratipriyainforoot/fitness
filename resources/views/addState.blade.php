<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add State</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Add State</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="card p-4">
            <div class="card-body">

              <!-- Add State Form -->
              <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('add-state-store')}}">
                @csrf
                <div class="col-md-12 mb-3">
                    <div class="form-floating">
                        <select name="country_id" id="floatingCouponCode" class="form-control" required>
                            <option value="">Select Country</option>
                            @php
                                $countries = \App\Models\Country::get();
                            @endphp
                            @foreach ($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                      <label for="floatingCouponCode">Country Name</label>
                      <div class="invalid-feedback">Please select country name.</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" name="name" class="form-control" id="floatingFname" placeholder="State name" required>
                      <label for="floatingFname">State Name</label>
                      <div class="invalid-feedback">Please enter state Name.</div>
                    </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>
              <!-- End Add State Form -->

            </div>
          </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

<x-admin-footer/>