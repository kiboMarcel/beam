@extends('admin.admin_master')


<style>

    .day{
        text-align: center;
    }

    .day-time{
        padding: 2px;
        text-align: center;
    }
</style>

@section('admin')
<div class="row layout-top-spacing">
    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="d-flex">
            <div class="n-chk">
              
            </div>
         
        </div>
    </div>

    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-chart-two">
            <div class="widget-heading">
                <div id="day" class="day-time"></div>
            </div>
            <div class="widget-content">
                <div id="time" class="day-time"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
        <div class="widget-two">
            <div class="widget-content">
               
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
        <div class="widget-three">
          
            
        </div>
    </div>

    <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget-one">
            <div class="widget-content">
              
            </div>
        </div>
    </div>

    <div class="col-xl-5 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-one">
           
        
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">

        <div class="widget widget-activity-four">

            <div class="widget-heading">
                <h5 class="">Eleve total</h5>
            </div>

            <div class="widget-content">

             

              
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">

        <div class="widget widget-account-invoice-one">

            <div class="widget-heading">
                <h5 class="">Eleve total</h5>
            </div>

            <div class="widget-content">
               
            </div>

        </div>
    </div>

    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-two">

            <div class="widget-heading">
                <h5 class="">Eleve total</h5>
            </div>

            <div class="widget-content">
                
            </div>
        </div>
    </div>

    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-three">

            <div class="widget-heading">
                <h5 class="">Eleve total</h5>
            </div>

            <div class="widget-content">
                
            </div>
        </div>
    </div>
    </div>


    <!-- BEGIN TIMER  SCRIPT -->

    <script>
        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }

        function startTime() {
            var today = new Date();
            //var m = today.toLocaleString('default', { month: 'long' });
            var d = Intl.DateTimeFormat('fr-FR', { weekday: 'long' }).format(today);
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            //console.log(d);
            // add a zero in front of numbers<10
            m = checkTime(m);
            s = checkTime(s);

            document.getElementById('time').innerHTML = " <h1> " + h + ":" + m + ":" + s + " </h1> ";
            t = setTimeout(function() {
                startTime()
            }, 500);
            document.getElementById('day').innerHTML = " <h1> " + d + " </h1> ";
            
        }
        startTime();
    </script>
    <!-- END  TIMER SCRIPT -->
@endsection