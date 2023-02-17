<x-admin-header/>

  <x-admin-menu/>

  <x-admin-sidebar/>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Attendance Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Attendance Report</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard" style="min-height: 500px;">
      <div class="row">
        <div class="card p-4">
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <select id="fetchReportEmployeeName" name="employee" class="form-control" required>
                            <option value="">Select Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->fname}} {{$employee->lname}}</option>
                            @endforeach
                        </select>
                        <div id="EmployeeNameError" class="text-danger"></div>
                    </div>
                    <div class="col">
                        <select id="fetchReportMonth" name="month" class="form-control" required>
                            <option value="">Select Month</option>
                            <option value="{{\Carbon\Carbon::now('Asia/Kolkata')->format('m')}}">{{\Carbon\Carbon::now('Asia/Kolkata')->format('F')}}</option>
                            <option value="{{\Carbon\Carbon::now('Asia/Kolkata')->subMonth(1)->format('m')}}">{{\Carbon\Carbon::now('Asia/Kolkata')->subMonth(1)->format('F')}}</option>
                            <option value="{{\Carbon\Carbon::now('Asia/Kolkata')->subMonths(2)->format('m')}}">{{\Carbon\Carbon::now('Asia/Kolkata')->subMonths(2)->format('F')}}</option>
                        </select>
                        <div id="monthError" class="text-danger"></div>
                    </div>
                    <div class="col">
                        <button type="button" id="fetchReportBtn" class="btn btn-primary">Generate Report</button>
                    </div>
                </div>
                <div id="attendanceData"></div>
            </div>
          </div>
      </div>
    </section>
  </main>
  <!-- End #main -->
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script>
    $('#fetchReportBtn').on('click', function() {
        if($('#fetchReportEmployeeName').val().length > 0 && $('#fetchReportMonth').val().length > 0) {
            $.ajax({
                url: 'attendance_report_fetch',
                type: 'POST',
                data: {
                    '_token': '{{csrf_token()}}',
                    employee_id: $('#fetchReportEmployeeName').val(),
                    month: $('#fetchReportMonth').val()
                },
                success: function(response) {
                    //console.log(response);
                    $('#attendanceData').html(response);
                },
                error: function(errors) {
                    console.log(errors);
                }
            });
        }
        if($('#fetchReportEmployeeName').val().length == 0) {
            $('#EmployeeNameError').text('Please Select Employee');
        }
        if($('#fetchReportMonth').val().length == 0) {
            $('#monthError').text('Please Select Month');
        }
        $('#fetchReportEmployeeName').on('change', function() {
            if($('#fetchReportEmployeeName').val().length == 0) {
                $('#EmployeeNameError').text('Please Select Employee');
            }else {
                $('#EmployeeNameError').text('');
            }
        });
        $('#fetchReportMonth').on('change', function() {
            if($('#fetchReportMonth').val().length == 0) {
                $('#monthError').text('Please Select Month');
            }else {
                $('#monthError').text('');
            }
        });
    });
   
  </script>
  
  

<x-admin-footer/>