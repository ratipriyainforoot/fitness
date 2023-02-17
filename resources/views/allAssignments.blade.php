<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Assignment</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Assignment</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

         <!-- Assignment Card -->
         <div class="col-md-12">
              @if($projects->count() > 0)
                <div class="card info-card customers-card">
                  <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @foreach($projects as $project)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne{{$project->id}}">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$project->id}}" aria-expanded="false" aria-controls="flush-collapseOne{{$project->id}}">
                                        {{$project->project_name}}
                                    </button>
                                </h2>
                                <div id="flush-collapseOne{{$project->id}}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne{{$project->id}}" data-bs-parent="#accordionFlushExample{{$project->id}}">
                                    <div class="accordion-body">
                                      @php
                                          $assignments = \App\Models\Assignment::where('project_id',$project->id)->orderBy('id','DESC')->get();
                                          $employees = \App\Models\Employee::get();
                                      @endphp
                                      @if($assignments->count() > 0) 
                                        <div class="table-responsive">
                                          <table class="table table-bordered">
                                            <tr>
                                              <th>Title</th>
                                              <th>Project</th>
                                              <th>Employee</th>
                                              <th>Date</th>
                                              <th>Status</th>
                                              <th>Action</th>
                                            </tr>
                                            @foreach($assignments as $assignment) 
                                            @php
                                              if($assignment->status == 0) {
                                                $status = 'Pending';
                                                $assignment_status = '1';
                                                $status_action = 'Mark as Complete';
                                                $status_action_background = 'bg-danger';
                                                $status_icon = 'bi-check2-all';
                                              }else {
                                                $status = 'Complete';
                                                $assignment_status = '0';
                                                $status_action = 'Mark as Pending';
                                                $status_action_background = 'bg-success';
                                                $status_icon = 'bi-x-circle';
                                              }
                                            @endphp
                                              <tr class="{{$status_action_background}} text-white">
                                                <td>{{$assignment->title}}</td>
                                                <td>
                                                  @php
                                                      $projectDeatils = \App\Models\Project::where('id',$assignment->project_id)->first();
                                                  @endphp
                                                  {{$projectDeatils->project_name}}
                                                </td>
                                                <td>
                                                  @php
                                                      $employee_details = \App\Models\Employee::where('id',$assignment->employee_id)->first();
                                                  @endphp
                                                  {{$employee_details->fname}} {{$employee_details->lname}}
                                                </td>
                                                <td>{{$assignment->created_at->format('d-m-Y')}}</td>
                                                <td class="text-center">
                                                  <form action="assignment-status" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="assignment_id" value="{{$assignment->id}}">
                                                    <input type="hidden" name="assignment_status" value="{{$assignment_status}}">
                                                    <button type="submit" class="btn btn-sm btn-light" title="{{$status_action}}">
                                                      <i class="bi {{$status_icon}}"></i>
                                                    </button>
                                                  </form>
                                                </td>
                                                <td>
                                                  <button data-bs-toggle="modal" data-bs-target="#viewAssignment{{$assignment->id}}" class="btn btn-sm btn-light" title="View Assignment">
                                                    <i class="bi bi-eye"></i>
                                                  </button>
                                                  <button data-bs-toggle="modal" data-bs-target="#editAssignment{{$assignment->id}}" class="btn btn-sm btn-light" title="Edit Assignment">
                                                      <i class="bi bi-pen"></i>
                                                  </button>
                                                  <button data-bs-toggle="modal" data-bs-target="#deleteAssignment{{$assignment->id}}" class="btn btn-sm btn-light" title="Remove Assignment">
                                                      <i class="bi bi-trash"></i>
                                                  </button>
                                                </td>
                                              </tr>
                                              {{-- View Assignment Modal --}}
                                              <div class="modal fade" id="viewAssignment{{$assignment->id}}" tabindex="-1" data-bs-backdrop="false">
                                                <div class="modal-dialog">
                                                  <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            @if($assignment->files != '')
                                                            <div class="text-center">
                                                              <a href="{{$assignment->files}}" class="text-decoration-none" download="">
                                                                <img src="{{asset($assignment->files)}}" alt="Profile" class="assignmentImage">
                                                              </a>
                                                            </div>
                                                            @endif
                                                            <div class="profile-overview">
                                                                
                                                                <h5 class="card-title">Assignment Details</h5>
                                              
                                                                <div class="row">
                                                                  <div class="col-lg-3 col-md-4 label ">Title</div>
                                                                  <div class="col-lg-9 col-md-8">{{$assignment->title}}</div>
                                                                </div>
                                              
                                                                <div class="row">
                                                                  <div class="col-lg-3 col-md-4 label">Project Name</div>
                                                                  <div class="col-lg-9 col-md-8">{{$projectDeatils->project_name}}</div>
                                                                </div>
                                              
                                                                <div class="row">
                                                                  <div class="col-lg-3 col-md-4 label">Employee</div>
                                                                  <div class="col-lg-9 col-md-8">
                                                                    {{$employee_details->fname}} {{$employee_details->lname}}
                                                                  </div>
                                                                </div>
                                              
                                                                <div class="row">
                                                                  <div class="col-lg-3 col-md-4 label">Date</div>
                                                                  <div class="col-lg-9 col-md-8">
                                                                    {{$assignment->created_at->format('d-m-Y')}}
                                                                  </div>
                                                                </div>
                                              
                                                                <div class="row">
                                                                  <div class="col-lg-3 col-md-4 label">Note</div>
                                                                  <div class="col-lg-9 col-md-8">{{$assignment->note}}</div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-lg-3 col-md-4 label">Status</div>
                                                                    <div class="col-lg-9 col-md-8">{{$status}}</div>
                                                                </div>
                                              
                                                              </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              {{-- View Assignment Modal End --}}
                                            @endforeach
                                          </table>
                                        </div>
                                      @endif
                                      <div class="text-center">
                                        <div>
                                          <button data-bs-toggle="modal" data-bs-target="#addAssignment{{$project->id}}" class="btn btn-sm btn-primary">
                                            Add Assignment
                                          </button>
                                          {{-- Add Assignment Modal --}}
                                          <div class="modal fade" id="addAssignment{{$project->id}}" tabindex="-1" data-bs-backdrop="false">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-body">
                                                    <!-- Add Assignment Form -->
                                                    <form class="row needs-validation" novalidate method="POST" action="{{route('add-assignment')}}" enctype="multipart/form-data">
                                                      @csrf
                                    
                                                        <div class="col-12 mb-3">
                                                          <div class="input-group has-validation">
                                                            <input type="text" name="title" class="form-control" id="yourUsername" placeholder="Add Title" required>
                                                            <div class="invalid-feedback">Please enter title.</div>
                                                          </div>
                                                        </div>

                                                        <div class="col-12 mb-3">
                                                          <div class="input-group has-validation">
                                                            <select name="project_id" class="form-control" required>
                                                              <option value="">Select Project</option>
                                                              @foreach($projects as $project)
                                                                <option value="{{$project->id}}">{{$project->project_name}}</option>
                                                              @endforeach
                                                            </select>
                                                          </div>
                                                        </div>

                                                        <div class="col-12 mb-3">
                                                          <div class="input-group has-validation">
                                                            <select name="employee_id" class="form-control" required>
                                                              <option value="">Select Employee</option>
                                                              @foreach($employees as $employee)
                                                                <option value="{{$employee->id}}">{{$employee->fname}} {{$employee->lname}}</option>
                                                              @endforeach
                                                            </select>
                                                          </div>
                                                        </div>

                                                        <div class="col-12 mb-3">
                                                          <input type="file" class="form-control" name="image" accept="image/*"/>
                                                        </div>
                                    
                                                        <div class="col-12">
                                                          <textarea name="note" class="form-control" cols="30" rows="10" required></textarea>
                                                          <div class="invalid-feedback">Please enter your password!</div>
                                                        </div>
                                                      <div class="text-center mt-3">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>                      
                                                      </div>
                                                    </form>
                                                    <!-- End Add Assignment Form -->
                                                </div>
                                                
                                              </div>
                                            </div>
                                          </div>
                                          {{-- Add Assignment Card Modal End --}}
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                  </div>
                  <div class="p-4">
                  </div>
                </div>
              @else 
                  <div class="text-center">
                    <p class="text-danger">*No Project Added Yet</p>
                    <div>
                        <a href="{{route('add-project')}}" class="btn btn-primary">
                            Add Project
                        </a>
                    </div>
                  </div>
              @endif
          </div>
          <!-- End Assignment Card -->
          <div class="p-4">
            {{$projects->links()}}
          </div>
      </div>
    </section>

  </main>
  <!-- End #main -->

<x-admin-footer/>