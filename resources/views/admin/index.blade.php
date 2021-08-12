@extends('admin.admin_master')


<style>
    .day {
        text-align: center;
    }

    .day-time {
        padding: 2px;
        text-align: center;
    }

    .card-school {
        display: flex;
        justify-content: space-around;
        ;
    }

    img {
        width: 100px;
    }

    #color{
        background-color: purple;
    }

    #color1{
        background-color: hotpink;
    }

</style>
@php
$totalStudentBoy = App\Models\User::where('usertype', 'Student')
    ->where('gender', 'masculin')
    ->get();
$totalStudentGirl = App\Models\User::where('usertype', 'Student')
    ->where('gender', 'feminin')
    ->get();
$totalStudent = App\Models\User::where('usertype', 'Student')->get();
@endphp
@section('admin')
    <div class="row layout-top-spacing">
        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget">
                <div class="widget-heading  card-school">
                    <img src="https://png.pngtree.com/element_our/png/20180912/coffee-time-png_91570.jpg" alt="">
                    <h2>COLLEGE MODERNE LE JOURDAIN</h2>
                </div>

            </div>
        </div> 
          {{-- GET STATUS FOR SWEET ALERT  START--}}
          @php
          $getstatus =  \Session::has('error'); 
          
          @endphp
          {{-- GET STATUS FOR SWEET ALERT START --}}


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

        <div class="col-xl-6 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-table-one">


            </div>
        </div>

        <div class="col-xl-6 col-lg-9 col-md-9 col-sm-12 col-12 layout-spacing">

            <div class="widget widget-table-one">

                <div class="widget-heading">
                    <h5 class="">Eleve</h5>
                </div>
                <div class="widget-content">
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="avatar avatar-xl">
                                        <span  id="color" class="avatar-title rounded-circle">G</span>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Garçon</h4>
                                   
                                </div>
                            </div>
                            <div class="t-rate rate-inc">
                                <span class="badge badge-pills outline-badge-primary">
                                      {{ count($totalStudentBoy) }} </span>
                            </div>
                        </div>
                    </div>
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="avatar avatar-xl">
                                        <span  id="color1" class="avatar-title rounded-circle">F</span>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Fille</h4>
                                   
                                </div>
                            </div>
                            <div class="t-rate rate-inc">
                                <span class="badge badge-pills outline-badge-primary">
                                      {{ count($totalStudentGirl) }} </span>
                            </div>
                        </div>
                    </div>
                    <div class="transactions-list">
                        <div class="t-item">
                            <div class="t-company-name">
                                <div class="t-icon">
                                    <div class="avatar avatar-xl">
                                        <span class="avatar-title rounded-circle">T</span>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4>Total</h4>
                                   
                                </div>
                            </div>
                            <div class="t-rate rate-inc">
                                <span class="badge badge-pills outline-badge-primary">
                                      {{ count($totalStudent) }} </span>
                            </div>
                        </div>
                    </div>
                  
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
            var d = Intl.DateTimeFormat('fr-FR', {
                weekday: 'long'
            }).format(today);
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

      {{-- SWEET ALERT SCRIPT --}}
      <script> 
        window.addEventListener('load', function() {
            var status = <?php echo json_encode($getstatus); ?>;

            if (status) {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                    type: 'error',
                    title: 'Une erreur s\'est produite',
                    padding: '2em',
                })
            } 

        });
    </script>
@endsection
