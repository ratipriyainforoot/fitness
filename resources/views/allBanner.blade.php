<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>All Banner</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">All Banner</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard" style="min-height: 500px;">
      <div class="row">
        <div class="card p-4">
            <div class="card-body">

              <!-- All Employee Table -->
              <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>Banner</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                    @foreach($banners as $banner)
                        <tr>
                            <td>
                                <img src="{{asset($banner->image)}}" alt="Profile" class="bannerImage">
                            </td>
                            <td>
                                {{$banner->title}}
                            </td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#viewBanner{{$banner->id}}" class="btn btn-sm btn-primary" title="View Banner">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button data-bs-toggle="modal" data-bs-target="#editBanner{{$banner->id}}" class="btn btn-sm btn-success" title="Edit Banner">
                                    <i class="bi bi-pen"></i>
                                </button>
                                <button data-bs-toggle="modal" data-bs-target="#deleteBanner{{$banner->id}}" class="btn btn-sm btn-danger" title="Remove Banner">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        {{-- View Banner Modal --}}
                        <div class="modal fade" id="viewBanner{{$banner->id}}" tabindex="-1" data-bs-backdrop="false">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row mb-3">
                                        <img src="{{asset($banner->image)}}" alt="Profile" class="bannerViewImage">
                                        <div class="text-center">
                                            <h5>{{$banner->title}}</h5>
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
                        <div class="modal fade" id="editBanner{{$banner->id}}" tabindex="-1" data-bs-backdrop="false">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-body">
                                  <!-- Edit Banner Form -->
                                  <form class="row needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$banner->id}}">
                                    <div class="text-center mb-3 mt-5">
                                        <div class="col-md-12">
                                          <img class="editProfileImagePreview" src="{{asset($banner->image)}}" alt="Profile" id="editProfileImagePreview{{$banner->id}}">
                                          <div class="pt-2">
                                            <button type="button" onclick="triggerUpload({{$banner->id}})" class="btn btn-primary btn-sm px-3" title="Upload new profile image"><i class="bi bi-upload"></i></button>
                                          </div>
                                          <input type="file" name="banner" id="editProfileImageUpload{{$banner->id}}" class="d-none" accept="image/*" onchange="showPreview(event,{{$banner->id}});">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                      <div class="col-md-6">
                                        <div class="form-floating">
                                          <input value="{{$banner->title}}" type="text" name="title" class="form-control" id="floatingFname{{$banner->id}}" placeholder="Rati" required>
                                          <label for="floatingFname{{$banner->id}}">Title</label>
                                          <div class="invalid-feedback">Please enter Title.</div>
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
                        <div class="modal fade" id="deleteProfile{{$banner->id}}" tabindex="-1" data-bs-backdrop="false">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-body">
                                  <!-- Delete Banner Form -->
                                  <form class="row needs-validation" novalidate method="POST" action="" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$banner->id}}">
                                    <div class="row mb-3">
                                      <img src="{{asset($banner->image)}}" alt="Profile" class="profileViewImage">
                                      <div class="text-center">
                                        <h5>{{$banner->title}} </h5>
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
                {{$banners->links()}}
              </div>
              <!-- End All Employee Table -->

            </div>
          </div>
      </div>
    </section>
  </main>
  <!-- End #main -->
  <script>
    function triggerUpload(id) {
        let profileImageUpload = document.getElementById('editProfileImageUpload'+id+'');
        profileImageUpload.click();
    }
    function showPreview(event,elementid) {
        if(event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById('editProfileImagePreview'+elementid+'');
            preview.src = src;
        }
    }
  </script>

<x-admin-footer/>