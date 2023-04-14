<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Orders</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Add Orders</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="card p-4">
            <div class="card-body">

              <!-- Add Orders Form -->
              <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('add-order-store')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" name="order_id" class="form-control" id="floatingOrderId" placeholder="Product Name" required>
                      <label for="floatingOrderId">Order Id</label>
                      <div class="invalid-feedback">Please Enter Order Id.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                      <select name="user_id" class="form-control" id="floatingUser" placeholder="price" required>
                        @php
                          $users = \App\Models\User::get();
                        @endphp
                        <option value="">Select user</option>
                        @foreach($users as $user)
                          <option value="{{$user->id}}">
                            {{$user->fname}} ({{$user->lname}})
                          </option>
                        @endforeach
                      </select>
                      <div class="invalid-feedback">Please Select user.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                      <select name="product_id" class="form-control" id="floatingProduct" required>
                        @php
                          $products = \App\Models\Product::get();
                        @endphp
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                          <option value="{{$product->id}}">
                            {{$product->product_name}} ({{$product->product_name_ar}})
                          </option>
                        @endforeach
                      </select>
                      <div class="invalid-feedback">Please Select product.</div>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="quantity" class="form-control" id="floatingQuantity" placeholder="Quantity" required>
                    <label for="floatingQuantity">Quantity</label>
                    <div class="invalid-feedback">Please Enter quantity.</div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="price" class="form-control" id="floatingPrice" placeholder="Price" required>
                    <label for="floatingPrice">Price</label>
                    <div class="invalid-feedback">Please Enter Price.</div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="payment_method" class="form-control" id="floatingPaymentMethod" placeholder="Payment Method" required>
                    <label for="floatingPaymentMethod">Payment Method</label>
                    <div class="invalid-feedback">Please Select Payment Method.</div>
                  </div>
                </div>
                <div class="col-md-12">
                  <fieldset>
                    <legend>Select Attribute</legend>
                    @php
                      $attributes = \Illuminate\Support\Facades\DB::table('nutritional_items')->get();
                    @endphp
                    <div class="row">
                      @foreach($attributes as $attribute)
                      <div class="col-md-6">
                        <h5>
                          <input class="form-controll" onchange="input('{{$attribute->id}}','{{$attribute->nutrition}}')" id="Nutriotion{{$attribute->id}}" type="checkbox" name="{{$attribute->nutrition}}" value="{{$attribute->nutrition}}">
                          <label> {{$attribute->nutrition}}</label>
                          <span id="NutriotionValue{{$attribute->id}}"></span>
                        </h5>
                      </div>
                    @endforeach
                    </div>
                 
                  </fieldset>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>
              <!-- End Add Product Form -->

            </div>
          </div>
      </div>
    </section>
    <!-- CDN links -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Amsify Plugin -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script type="text/javascript" src="js/jquery.amsify.suggestags.js"></script>
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
  <script>
    function input(id,nutrition) {
      html = '';
      if(document.getElementById("Nutriotion"+id+"").checked) {
        html += 
        '<div class="form-floating">\
          <input type="text" name="'+nutrition+'Value" class="form-control" id="floatingFname'+id+'" placeholder="eg:100g" required>\
          <ul id="singleFieldTags'+id+'"></ul>\
          <div class="invalid-feedback">Please enter quantitiy.</div>\
        </div>';
        document.getElementById('NutriotionValue'+id+'').innerHTML = html;
      }else {
        document.getElementById('NutriotionValue'+id+'').innerHTML = '';
      }

      $('input[name="'+nutrition+'Value"]').amsifySuggestags({
        suggestions: ['100', '200', '300', '400', '500', '600', '700', '800'],
        whiteList: true
      });
      
      
    }
  </script>

<x-admin-footer/>