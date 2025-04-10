@extends('layouts.app')


@section('content')
<style type="text/css">
    .card{
        background: #fff;   padding: 7px;
                border-radius: 6px;
                text-align: center;margin-top: 5px;margin-left: 5px;float:left;
    }
    .card-title{
        font-size: 14px;
    }
    .card-text{
        font-size: 16px;
        font-weight: bold;
    }
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
            

             <div class="row">
       
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                      <h4 class="card-title h-10">Total Users</h4>
                      <p class="card-text"><b>( 22 )</b></p>
                      <a href="#" class="card-link">Show All </a>
                    </div>
                  </div>
              </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title h-10">Total Enrolled Users</h4>
                  <p class="card-text"><b>( 22 )</b></p>
                  <a href="#" class="card-link">Show All </a>
                </div>
              </div>
          </div>


              <div class="card">
                <div class="card-body">
                  <h4 class="card-title h-10">Total Courses</h4>
                  <p class="card-text"><b>( 16 )</b></p>
                  <a href="#" class="card-link">Show All </a>
                </div>
              </div>



              <div class="card">
                <div class="card-body">
                  <h4 class="card-title h-10">Total Candidate</h4>
                  <p class="card-text"><b>( 20 )</b></p>
                  <a href="#" class="card-link">Show All </a>
                </div>
              </div>


              <div class="card">
                <div class="card-body">
                  <h4 class="card-title h-10">Total Candidate (Successed)</h4>
                  <p class="card-text"><b>( 7 )</b></p>
                  <a href="#" class="card-link">Show All </a>
                </div>
              </div>


              <div class="card">
                <div class="card-body">
                  <h4 class="card-title h-10">Total Candidate (Failed)</h4>
                  <p class="card-text"><b>( 4 )</b></p>
                  <a href="#" class="card-link">Show All </a>
                </div>
              </div>



              <div class="card">
                <div class="card-body">
                  <h4 class="card-title h-10">Total Candidate (Incomplete Course)</h4>
                  <p class="card-text"><b>( 9 )</b></p>
                  <a href="#" class="card-link">Show All </a>
                </div>
              </div>



              <div class="card">
                <div class="card-body">
                  <h4 class="card-title h-10">Certificate Print</h4>
                  <p class="card-text"><b>( 2 )</b></p>
                  <a href="#" class="card-link">Show All </a>
                </div>
              </div>
       

   </div>

 
      </div>


</div>





<script type="text/javascript">
    

</script>





@endsection