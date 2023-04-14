<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Country List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Country List</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard" style="min-height: 500px;">
      <div class="row">
        <div class="card p-4">
          <div class="card-body">
            <!-- All Employee Table -->
            @if($countries->count() > 0)
                    <div class="table-responsive">
                      <table class="table table-bordered text-center">
                        <tr>
                          <th>Country Name</th>
                          <th>Action</th>
                        </tr>
                        @foreach($countries as $country)
                          <tr>
                              <td>
                                    {{$country->name}}
                              </td>
                              <td>
                                  <button data-bs-toggle="modal" data-bs-target="#editCountry{{$country->id}}" class="btn btn-sm btn-success" title="Edit Country">
                                      <i class="bi bi-pen"></i>
                                  </button>
                                  <button data-bs-toggle="modal" data-bs-target="#deleteCountry{{$country->id}}" class="btn btn-sm btn-danger" title="Remove Country">
                                      <i class="bi bi-trash"></i>
                                  </button>
                              </td>
                          </tr>
                          {{-- Edit Country Modal --}}
                          <div class="modal fade" id="editCountry{{$country->id}}" tabindex="-1" data-bs-backdrop="false">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-body">
                                    <!-- Edit Country Form -->
                                    <form class="row needs-validation" novalidate method="POST" action="{{route('edit-country')}}">
                                      @csrf
                                      <input type="hidden" name="id" value="{{$country->id}}">
                                      <div class="row mb-3">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-floating">
                                              <input type="text" value="{{$country->name}}" name="name" class="form-control" id="floatingCouponCode" placeholder="Country Name" required>
                                              <label for="floatingCouponCode">Country Name</label>
                                              <div class="invalid-feedback">Please enter country name.</div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                      </div>
                                    </form>
                                    <!-- End Edit Country Form -->
                                </div>
                                
                              </div>
                            </div>
                          </div>
                          {{-- Edit Country Modal End --}}
                          {{-- Delete Country Modal --}}
                          <div class="modal fade" id="deleteCountry{{$country->id}}" tabindex="-1" data-bs-backdrop="false">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-body">
                                    <!-- Delete Country Form -->
                                    <form class="row needs-validation" novalidate method="POST" action="{{route('delete-country')}}">
                                      @csrf
                                      <input type="hidden" name="id" value="{{$country->id}}">
                                      <div class="row mb-3">
                                        <div class="text-center">
                                          <h5 class="text-danger">Do You Want to Delete </h5>
                                          <h4><b>{{$country->name}}</b></h4>
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
                          No Country added yet
                        </p>
                        <a href="{{route('add-country')}}" class="btn btn-primary">
                          Add Country
                        </a>
                      </div>
                    @endif
              {{$countries->links()}}
              <!-- End Coupon Codes Table -->

            </div>
          </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

<x-admin-footer/>