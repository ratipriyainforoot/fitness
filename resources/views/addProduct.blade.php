<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Product</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Add Product</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <div class="card p-4">
            <div class="card-body">

              <!-- Add Product Form -->
              <form class="row g-3 needs-validation" novalidate method="POST" action="{{route('add-product-store')}}" enctype="multipart/form-data">
                @csrf
                <div class="text-center mb-3 mt-5">
                    <div class="col-md-12">
                      <img src="assets/img/banner.jpg" alt="Profile" id="bannerImagePreview">
                      <div class="pt-2">
                        <button type="button" onclick="triggerUpload()" class="btn btn-primary btn-sm px-3" title="Upload product banner"><i class="bi bi-upload"></i></button>
                      </div>
                    <input type="file" name="banner" id="profileImageUpload" class="d-none" accept="image/*" onchange="showPreview(event);" required>
                    <div class="invalid-feedback">Please upload product banner.</div>
                    </div>
                  </div>
                <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" name="product_name" class="form-control" id="floatingFname" placeholder="Product Name" required>
                      <label for="floatingFname">Product Name</label>
                      <div class="invalid-feedback">Please Enter Product Name.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                      <input type="text" name="product_name_ar" class="form-control" id="floatingFname" placeholder="Product Name(Arabic)" required>
                      <label for="floatingFname">Product Name(Arabic)</label>
                      <div class="invalid-feedback">Please enter arabic Product Name.</div>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="meals" class="form-control" id="floatingFname" placeholder="Meals" required>
                    <label for="floatingFname">Meals</label>
                    <div class="invalid-feedback">Please Enter Meals.</div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="snacks" class="form-control" id="floatingFname" placeholder="snacks" required>
                    <label for="floatingFname">Snacks</label>
                    <div class="invalid-feedback">Please Enter Snacks.</div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" name="price" class="form-control" id="floatingFname" placeholder="price" required>
                    <label for="floatingFname">Price</label>
                    <div class="invalid-feedback">Please Enter Price.</div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <select name="category_id" class="form-control" id="floatingFname" placeholder="price" required>
                      @php
                        $categories = \App\Models\Category::get();
                      @endphp
                      <option value="">Select category</option>
                      @foreach($categories as $category)
                        <option value="{{$category->id}}">
                          {{$category->title}} ({{$category->title_ar}})
                        </option>
                      @endforeach
                    </select>
                    <div class="invalid-feedback">Please Select category.</div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <textarea name="description" class="form-control" id="floatingFname" required></textarea>
                    <label for="floatingFname">Description</label>
                    <div class="invalid-feedback">Please Enter description.</div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <textarea name="description_ar" class="form-control" id="floatingFname" required></textarea>
                    <label for="floatingFname">Description(Arabic)</label>
                    <div class="invalid-feedback">Please Enter description(Arabic).</div>
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