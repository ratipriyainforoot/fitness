<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add City</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Add City</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="card p-4">
            <div class="card-body">

              <!-- Add City Form -->
              <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('add-city-store')}}">
                @csrf
                <div class="col-md-12 mb-3">
                    <div class="form-floating">
                        <select name="state_id" id="floatingCouponCode" class="form-control" required>
                            <option value="">Select State</option>
                            @php
                                $states = \App\Models\State::get();
                            @endphp
                            @foreach ($states as $state)
                                <option value="{{$state->id}}">{{$state->name}}</option>
                            @endforeach
                        </select>
                      <label for="floatingCouponCode">State Name</label>
                      <div class="invalid-feedback">Please select state name.</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" name="name" class="form-control" id="floatingFname" placeholder="City name" required>
                      <label for="floatingFname">City Name</label>
                      <div class="invalid-feedback">Please enter city Name.</div>
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