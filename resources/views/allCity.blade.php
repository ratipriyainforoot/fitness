<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>City List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">City List</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard" style="min-height: 500px;">
      <div class="row">
        <div class="card p-4">
          <div class="card-body">
            <!-- All State Table -->
            @if($cities->count() > 0)
                    <div class="table-responsive">
                      <table class="table table-bordered text-center">
                        <tr>
                          <th>City Name</th>
                          <th>State Name</th>
                          <th>Action</th>
                        </tr>
                        @foreach($cities as $city)
                          <tr>
                                <td>
                                        {{$city->name}}
                                </td>
                                <td>
                                    @php
                                        $stateDetails = \App\Models\State::where('id',$city->state_id)->first();
                                    @endphp
                                    {{$stateDetails->name}}
                                </td>
                              <td>
                                  <button data-bs-toggle="modal" data-bs-target="#editCity{{$city->id}}" class="btn btn-sm btn-success" title="Edit State">
                                      <i class="bi bi-pen"></i>
                                  </button>
                                  <button data-bs-toggle="modal" data-bs-target="#deleteCity{{$city->id}}" class="btn btn-sm btn-danger" title="Remove State">
                                      <i class="bi bi-trash"></i>
                                  </button>
                              </td>
                          </tr>
                          {{-- Edit City Modal --}}
                          <div class="modal fade" id="editCity{{$city->id}}" tabindex="-1" data-bs-backdrop="false">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-body">
                                    <!-- Edit City Form -->
                                    <form class="row needs-validation" novalidate method="POST" action="{{route('edit-city')}}">
                                      @csrf
                                      <input type="hidden" name="id" value="{{$city->id}}">
                                      <div class="row mb-3">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-floating">
                                                <select name="state_id" id="floatingCouponCode" class="form-control" required>
                                                    <option value="">Select state</option>
                                                    @php
                                                        $states = \App\Models\State::get();
                                                    @endphp
                                                    @foreach ($states as $state)
                                                        <option value="{{$state->id}}" {{($state->name == $stateDetails->name) ? "selected" : ""}}>{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                              <label for="floatingCouponCode">State Name</label>
                                              <div class="invalid-feedback">Please select state.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-floating">
                                              <input type="text" value="{{$city->name}}" name="name" class="form-control" id="floatingCouponCode" placeholder="State Name" required>
                                              <label for="floatingCouponCode">City Name</label>
                                              <div class="invalid-feedback">Please enter city name.</div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                      </div>
                                    </form>
                                    <!-- End Edit City Form -->
                                </div>
                                
                              </div>
                            </div>
                          </div>
                          {{-- Edit City Modal End --}}
                          {{-- Delete City Modal --}}
                          <div class="modal fade" id="deleteCity{{$city->id}}" tabindex="-1" data-bs-backdrop="false">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-body">
                                    <!-- Delete City Form -->
                                    <form class="row needs-validation" novalidate method="POST" action="{{route('delete-city')}}">
                                      @csrf
                                      <input type="hidden" name="id" value="{{$city->id}}">
                                      <div class="row mb-3">
                                        <div class="text-center">
                                          <h5 class="text-danger">Do You Want to Delete </h5>
                                          <h4><b>{{$city->name}}</b></h4>
                                        </div>
                                      </div>
                                      <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                      </div>
                                    </form>
                                    <!-- End Delete Coupon Form -->
                                </div>
                                
                              </div>
                            </div>
                          </div>
                          {{-- Delete Coupon Modal End --}}
                        @endforeach
                      </table>
                    </div>
                    @else
                      <div class="text-center">
                        <p class="text-danger">
                          No City added yet
                        </p>
                        <a href="{{route('add-city')}}" class="btn btn-primary">
                          Add City
                        </a>
                      </div>
                    @endif
              {{$cities->links()}}
              <!-- End State Table -->

            </div>
          </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

<x-admin-footer/>