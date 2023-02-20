<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>All Orders</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">All Orders</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard" style="min-height: 500px;">
      <div class="row">
        <div class="card p-4">
          <div class="card-body">
            <!-- All Orders Table -->
            @if($orders->count() > 0)
                    <div class="table-responsive">
                      <table class="table table-bordered text-center">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Payment Method</th>
                        </tr>
                        @foreach($orders as $order)
                          <tr>
                              <td>
                                    {{\Carbon\Carbon::parse($order->dated)->format('d-m-Y')}}
                              </td>
                              <td>
                                    {{$order->order_id}}
                              </td>
                              <td>
                                    @php
                                        $user = \App\Models\User::where('id',$order->user_id)->first();
                                    @endphp
                                    {{$user->fname}} {{$user->lname}}
                              </td>
                              <td>
                                @php
                                    $product = \App\Models\Product::where('id',$order->product_id)->first();
                                @endphp
                                {{$product->product_name}} ({{$product->product_name_ar}})
                              </td>
                              <td>
                                {{$order->quantity}}
                              </td>
                              <td>
                                {{$order->price}}
                              </td>
                              <td>
                                {{$order->payment_method}}
                              </td>
                              
                              <td>
                                  <button data-bs-toggle="modal" data-bs-target="#viewBanner{{$order->id}}" class="btn btn-sm btn-primary" title="View Banner">
                                      <i class="bi bi-eye"></i>
                                  </button>
                                  <button data-bs-toggle="modal" data-bs-target="#editBanner{{$order->id}}" class="btn btn-sm btn-success" title="Edit Banner">
                                      <i class="bi bi-pen"></i>
                                  </button>
                                  <button data-bs-toggle="modal" data-bs-target="#deleteBanner{{$order->id}}" class="btn btn-sm btn-danger" title="Remove Banner">
                                      <i class="bi bi-trash"></i>
                                  </button>
                              </td>
                          </tr>
                          {{-- View Banner Modal --}}
                          <div class="modal fade" id="viewBanner{{$order->id}}" tabindex="-1" data-bs-backdrop="false">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-body">
                                      <div class="row mb-3">
                                          <div class="text-center">
                                              <h5>Title: {{$order->title}}</h5>
                                              <h5>Title(Arabic): {{$order->title_ar}}</h5>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                          </div>
                          {{-- View Banner Modal End --}}
                          {{-- Edit Banner Modal --}}
                          <div class="modal fade" id="editBanner{{$order->id}}" tabindex="-1" data-bs-backdrop="false">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-body">
                                    <!-- Edit Banner Form -->
                                    <form class="row needs-validation" novalidate method="POST" action="{{route('edit-category')}}" enctype="multipart/form-data">
                                      @csrf
                                      <input type="hidden" name="id" value="{{$order->id}}">
                                      <div class="row mb-3">
                                        <div class="col-md-12">
                                          <div class="form-floating">
                                            <input value="{{$order->title}}" type="text" name="title" class="form-control" id="floatingFname{{$order->id}}" placeholder="Rati" required>
                                            <label for="floatingFname{{$order->id}}">Title</label>
                                            <div class="invalid-feedback">Please enter Title.</div>
                                          </div>
                                          <div class="form-floating mt-3">
                                            <input value="{{$order->title_ar}}" type="text" name="title_ar" class="form-control" id="floatingFname{{$order->id}}" placeholder="Rati" required>
                                            <label for="floatingFname{{$order->id}}">Title(Arabic)</label>
                                            <div class="invalid-feedback">Please enter arabic Title.</div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                      </div>
                                    </form>
                                    <!-- End Edit Banner Form -->
                                </div>
                                
                              </div>
                            </div>
                          </div>
                          {{-- Edit Banner Modal End --}}
                          {{-- Delete Banner Modal --}}
                          <div class="modal fade" id="deleteBanner{{$order->id}}" tabindex="-1" data-bs-backdrop="false">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-body">
                                    <!-- Delete Banner Form -->
                                    <form class="row needs-validation" novalidate method="POST" action="{{route('delete-category')}}" enctype="multipart/form-data">
                                      @csrf
                                      <input type="hidden" name="id" value="{{$order->id}}">
                                      <div class="row mb-3">
                                        <div class="text-center">
                                          <h5>{{$order->title}} </h5>
                                          <h5>{{$order->title_ar}} </h5>
                                        </div>
                                      </div>
                                      <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                      </div>
                                    </form>
                                    <!-- End Delete Banner Form -->
                                </div>
                                
                              </div>
                            </div>
                          </div>
                          {{-- Delete Banner Modal End --}}
                        @endforeach
                      </table>
                    </div>
                    @else
                      <div class="text-center">
                        <p class="text-danger">
                          No banner added yet
                        </p>
                        <a href="{{route('add-banner')}}" class="btn btn-primary">
                          Add Banner
                        </a>
                      </div>
                    @endif
              {{$orders->links()}}
              <!-- End All Employee Table -->

            </div>
          </div>
      </div>
    </section>
  </main>
  <!-- End #main -->

<x-admin-footer/>