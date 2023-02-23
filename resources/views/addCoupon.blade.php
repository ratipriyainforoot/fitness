<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Coupon Code</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Add Coupon Code</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="card p-4">
            <div class="card-body">

              <!-- Add Coupon Code Form -->
              <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('add-coupon-store')}}">
                @csrf
                <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" name="coupon_code" class="form-control" id="floatingCouponCode" placeholder="Coupon Code" required>
                      <label for="floatingCouponCode">Coupon Code</label>
                      <div class="invalid-feedback">Please enter coupon code.</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                        <select name="type" class="form-control" id="floatingCouponType" required>
                            <option value="">Select Discount Type</option>
                            <option value="flat_discount">Flat Discount</option>
                            <option value="percentage_discount">Percentage Discount</option>
                        </select>
                      <label for="floatingCouponType">Discount Type</label>
                      <div class="invalid-feedback">Please select discount type.</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                      <input type="text" name="value" class="form-control" id="floatingDiscountValue" placeholder="Discount Value" required>
                      <label for="floatingDiscountValue">Discount Value</label>
                      <div class="invalid-feedback">Please enter discount value.</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                      <input type="date" name="start_date" class="form-control" id="floatingStartDate" placeholder="Start Date" required>
                      <label for="floatingStartDate">Start Date</label>
                      <div class="invalid-feedback">Please select start date.</div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                      <input type="date" name="end_date" class="form-control" id="floatingEndDate" placeholder="Discount Value" required>
                      <label for="floatingEndDate">End Date</label>
                      <div class="invalid-feedback">Please select end date.</div>
                    </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>
              <!-- End Coupon Code Form -->

            </div>
          </div>
      </div>
    </section>

  </main>
  <!-- End #main -->

<x-admin-footer/>