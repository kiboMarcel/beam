@extends('admin.admin_master')


<script src="{{ asset('backend/assets/js/dashboard/dash_1.js') }}"></script>

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

    #color {
        background-color: purple;
    }

    #color1 {
        background-color: hotpink;
    }


    .w-icon {
        justify-content: center;
        align-items: center;
    }

    .w-summary-info{
        align-items: baseline;
    }

</style>
@php

$school_info = App\Models\schoolInfo::where('id', 1)->first();

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
                    <img src="{{ 
                        (!empty($school_info->image))? url('upload/school_image/'.$school_info->image.'jpg')
                        : url('upload/school_image/no_image.jpg') }}" alt="">
                    <h2> {{$school_info== null? '': $school_info->name }}</h2>
                </div>

            </div>
        </div>
        {{-- GET STATUS FOR SWEET ALERT  START --}}
        @php
            $getstatus = \Session::has('error');
            
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
            <div class="widget-three">
                <div class="widget-heading">
                    <h5 class="">Effectif Global des Eleves</h5>
                </div>
                <div class="widget-content">

                    <div class="order-summary">

                        <div class="summary-list">
                            <div class="w-icon">
                                <img src=" {{ asset('backend/assets/img/mars.svg') }} " width="24" height="24" alt="">
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Hommes</h6>
                                    <span class="badge badge-pills outline-badge-primary">
                                        {{ count($totalStudentBoy) }} 
                                    </span>
                                </div>


                            </div>

                        </div>

                        <div class="summary-list">
                            <div class="w-icon">
                                <img src=" {{ asset('backend/assets/img/female.svg') }} " width="24" height="24" alt="">
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Femmes</h6>
                                    <span class="badge badge-pills outline-badge-primary">
                                        {{ count($totalStudentGirl) }} </span>
                                </div>

                            </div>

                        </div>

                        <div class="summary-list">
                            <div class="w-icon">
                                <img src=" {{ asset('backend/assets/img/total.svg') }} " width="24" height="24" alt="">
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>Total</h6>
                                    <span class="badge badge-pills outline-badge-primary">
                                        {{ count($totalStudent) }}</span>
                                </div>

                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="widget-three">
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
            <div class="widget-three">
                <div class="widget-heading">
                    <h5 class=""></h5>
                </div>
                <div class="widget-content">

                    <div class="order-summary">

                        <div class="summary-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-phone">
                                    <path
                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                    </path>
                                </svg>
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>+228 91 38 61 20</h6>
                                </div>


                            </div>

                        </div>

                        <div class="summary-list">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" color="red" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign">
                                    <circle cx="12" cy="12" r="4"></circle>
                                    <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
                                </svg>
                            </div>
                            <div class="w-summary-details">

                                <div class="w-summary-info">
                                    <h6>nouletamemarcel@gmail.com</h6>
                                </div>



                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">

        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 layout-spacing">

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
                                        <span id="color" class="avatar-title rounded-circle">G</span>
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
                                        <span id="color1" class="avatar-title rounded-circle">F</span>
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


    <link href="{{ asset('backend/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
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
