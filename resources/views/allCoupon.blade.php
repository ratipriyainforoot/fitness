<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Coupon Codes</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Coupon Codes</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard" style="min-height: 500px;">
      <div class="row">
        <div class="card p-4">
          <div class="card-body">
            <!-- All Employee Table -->
            @if($coupons->count() > 0)
                    <div class="table-responsive">
                      <table class="table table-bordered text-center">
                        <tr>
                          <th>Coupon Code</th>
                          <th>Type</th>
                          <th>Discount</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Action</th>
                        </tr>
                        @foreach($coupons as $coupon)
                          <tr>
                              <td>
                                    {{$coupon->coupon_code}}
                              </td>
                              <td>
                                    {{$coupon->type}}
                              </td>
                              <td>
                                    {{$coupon->value}}
                              </td>
                              <td>
                                    {{$coupon->start_date}}
                              </td>
                              <td>
                                    {{$coupon->end_date}}
                              </td>
                              <td>
                                  <button data-bs-toggle="modal" data-bs-target="#editCoupon{{$coupon->id}}" class="btn btn-sm btn-success" title="Edit Coupon">
                                      <i class="bi bi-pen"></i>
                                  </button>
                                  <button data-bs-toggle="modal" data-bs-target="#deleteCoupon{{$coupon->id}}" class="btn btn-sm btn-danger" title="Remove Coupon">
                                      <i class="bi bi-trash"></i>
                                  </button>
                              </td>
                          </tr>
                          {{-- Edit Coupon Modal --}}
                          <div class="modal fade" id="editCoupon{{$coupon->id}}" tabindex="-1" data-bs-backdrop="false">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-body">
                                    <!-- Edit Coupon Form -->
                                    <form class="row needs-validation" novalidate method="POST" action="{{route('edit-coupon')}}">
                                      @csrf
                                      <input type="hidden" name="id" value="{{$coupon->id}}">
                                      <div class="row mb-3">
                                        <div class="col-md-12 mb-3">
                                            <div class="form-floating">
                                              <input type="text" value="{{$coupon->coupon_code}}" name="coupon_code" class="form-control" id="floatingCouponCode" placeholder="Coupon Code" required>
                                              <label for="floatingCouponCode">Coupon Code</label>
                                              <div class="invalid-feedback">Please enter coupon code.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-floating">
                                                <select name="type" class="form-control" id="floatingCouponType" required>
                                                    <option value="">Select Discount Type</option>
                                                    <option {{($coupon->type == 'flat_discount') ? 'selected' : ''}} value="flat_discount">Flat Discount</option>
                                                    <option {{($coupon->type == 'percentage_discount') ? 'selected' : ''}} value="percentage_discount">Percentage Discount</option>
                                                </select>
                                              <label for="floatingCouponType">Discount Type</label>
                                              <div class="invalid-feedback">Please select discount type.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-floating">
                                              <input type="text" value="{{$coupon->value}}" name="value" class="form-control" id="floatingDiscountValue" placeholder="Discount Value" required>
                                              <label for="floatingDiscountValue">Discount Value</label>
                                              <div class="invalid-feedback">Please enter discount value.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-floating">
                                              <input type="date" value="{{$coupon->start_date}}" name="start_date" class="form-control" id="floatingStartDate" placeholder="Start Date" required>
                                              <label for="floatingStartDate">Start Date</label>
                                              <div class="invalid-feedback">Please select start date.</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-floating">
                                              <input type="date" value="{{$coupon->end_date}}" name="end_date" class="form-control" id="floatingEndDate" placeholder="Discount Value" required>
                                              <label for="floatingEndDate">End Date</label>
                                              <div class="invalid-feedback">Please select end date.</div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                      </div>
                                    </form>
                                    <!-- End Edit Coupon Form -->
                                </div>
                                
                              </div>
                            </div>
                          </div>
                          {{-- Edit Coupon Modal End --}}
                          {{-- Delete Coupon Modal --}}
                          <div class="modal fade" id="deleteCoupon{{$coupon->id}}" tabindex="-1" data-bs-backdrop="false">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-body">
                                    <!-- Delete Coupon Form -->
                                    <form class="row needs-validation" novalidate method="POST" action="{{route('delete-coupon')}}">
                                      @csrf
                                      <input type="hidden" name="id" value="{{$coupon->id}}">
                                      <div class="row mb-3">
                                        <div class="text-center">
                                          <h5>{{$coupon->coupon_code}} </h5>
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
                          No Coupon added yet
                        </p>
                        <a href="{{route('add-coupon')}}" class="btn btn-primary">
                          Add Coupon
                        </a>
                      </div>
                    @endif
              {{$coupons->links()}}
              <!-- End Coupon Codes Table -->

            </div>
          </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

<x-admin-footer/>