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
                <h4 class="day">Lundi</h4>
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

@endsection