<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Attendance Activity</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Attendance Activity</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard" style="min-height: 500px;">
      <div class="row">
        <div class="card p-4">
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <select id="fetchActivityEmployeeName" name="employee" class="form-control" required>
                            <option value="">Select Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->fname}} {{$employee->lname}}</option>
                            @endforeach
                        </select>
                        <div id="EmployeeNameError" class="text-danger"></div>
                    </div>
                    <div class="col">
                        <div class="row mb-3">
                            <div class="col-sm-10">
                              <input type="date" class="form-control" name="date" id="fetchActivityDate">
                            </div>
                        </div>
                        <div id="dateError" class="text-danger"></div>
                    </div>
                    <div class="col">
                        <button type="button" id="fetchActivityBtn" class="btn btn-primary">Check Activity</button>
                    </div>
                </div>
                <div id="activityData"></div>
            </div>
          </div>
      </div>
    </section>
  </main>
  <!-- End #main -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script>
    $('#fetchActivityBtn').on('click', function() {
        if($('#fetchActivityEmployeeName').val().length > 0 && $('#fetchActivityDate').val() != 'dd//mm/yyyy') {
            $.ajax({
                url: 'attendance_activity_fetch',
                type: 'POST',
                data: {
                    '_token': '{{csrf_token()}}',
                    employee: $('#fetchActivityEmployeeName').val(),
                    date: $('#fetchActivityDate').val()
                },
                success: function(response) {
                    //console.log(response);
                    $('#activityData').html(response);
                },
                error: function(errors) {
                    console.log(errors);
                }
            });
        }
        if($('#fetchActivityEmployeeName').val().length == 0) {
            $('#EmployeeNameError').text('Please Select Employee');
        }
        if($('#fetchReportMonth').val() == 'dd/mm/yyyy') {
            $('#dateError').text('Please Select Date');
        }
        if($('#fetchReportMonth').val() != 'dd/mm/yyyy') {
            $('#dateError').text('');
        }
        $('#fetchActivityEmployeeName').on('change', function() {
            if($('#fetchActivityEmployeeName').val().length == 0) {
                $('#EmployeeNameError').text('Please Select Employee');
            }else {
                $('#EmployeeNameError').text('');
            }
        });
    });
   
  </script>
  
  

<x-admin-footer/>