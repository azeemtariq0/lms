@extends('layouts.app')


@section('content')
<style type="text/css">
     body {
      margin: 0;
      padding: 20px;
      background: #f0f2f5;
      font-family: Arial, sans-serif;
    }

    .card-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .stat-card {
      color: #fff;
    border-radius: 12px;
    padding: 13px 25px;
    width: 191px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    }

    .stat-title {
      font-size: 1.1em;
      margin-bottom: 10px;
    }

    .stat-amount-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .stat-number {
      font-size: 2em;
      font-weight: bold;
    }

    .stat-icon {
      font-size: 1.8em;
    }

    /* Different card colors */
    .bg-blue { background: #4e73df; }
    .bg-green { background: #1cc88a; }
    .bg-orange { background: #f6c23e; }
    .bg-red { background: #e74a3b; }
    .bg-purple { background: #6f42c1; }
    .bg-teal { background: #20c997; }
    .bg-pink { background: #e83e8c; }
    .bg-cyan { background: #17a2b8; }
    .bg-dark { background: #343a40; }
    .bg-indigo { background: #6610f2; }
</style>
    @if (count($errors) > 0)
    <div id="content" class="padding-20">

        <div class="alert alert-danger margin-bottom-30">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
       @endif
       <div class="colm-md-12 row" style="margin-top: 10px;">
    <div class="col-md-11"></div>
</div>



<div id="content" class="padding-20">
  <div class="card-container">
    <div class="stat-card bg-blue">
      <div class="stat-title">No of Students</div>
      <div class="stat-amount-row">
        <div class="stat-number">245</div>
        <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
      </div>
    </div>
    <div class="stat-card bg-green">
      <div class="stat-title">Teachers</div>
      <div class="stat-amount-row">
        <div class="stat-number">38</div>
        <div class="stat-icon"><i class="fas fa-chalkboard-teacher"></i></div>
      </div>
    </div>
    <div class="stat-card bg-orange">
      <div class="stat-title">Courses</div>
      <div class="stat-amount-row">
        <div class="stat-number">12</div>
        <div class="stat-icon"><i class="fas fa-book-open"></i></div>
      </div>
    </div>
    <div class="stat-card bg-red">
      <div class="stat-title">Pending Fees</div>
      <div class="stat-amount-row">
        <div class="stat-number">₹34,000</div>
        <div class="stat-icon"><i class="fas fa-rupee-sign"></i></div>
      </div>
    </div>
    <div class="stat-card bg-purple">
      <div class="stat-title">Library Books</div>
      <div class="stat-amount-row">
        <div class="stat-number">1,200</div>
        <div class="stat-icon"><i class="fas fa-book"></i></div>
      </div>
    </div>
    <div class="stat-card bg-teal">
      <div class="stat-title">Online Users</div>
      <div class="stat-amount-row">
        <div class="stat-number">87</div>
        <div class="stat-icon"><i class="fas fa-user-clock"></i></div>
      </div>
    </div>
    <div class="stat-card bg-pink">
      <div class="stat-title">Assignments</div>
      <div class="stat-amount-row">
        <div class="stat-number">320</div>
        <div class="stat-icon"><i class="fas fa-tasks"></i></div>
      </div>
    </div>
    <div class="stat-card bg-cyan">
      <div class="stat-title">Attendance</div>
      <div class="stat-amount-row">
        <div class="stat-number">93%</div>
        <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
      </div>
    </div>
    <div class="stat-card bg-dark">
      <div class="stat-title">Alumni</div>
      <div class="stat-amount-row">
        <div class="stat-number">560</div>
        <div class="stat-icon"><i class="fas fa-users"></i></div>
      </div>
    </div>
    <div class="stat-card bg-indigo">
      <div class="stat-title">Events</div>
      <div class="stat-amount-row">
        <div class="stat-number">14</div>
        <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
</script>





@endsection