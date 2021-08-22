@extends('admin.admin_master')


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>



<style>
    .tr_style {
        background-color: #0e1726 !important;
    }

    .table {
        background-color: rebeccapurple !important;
    }

    .tr_style:hover {
        background-color: #152238 !important;
    }

   /*  .head {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    } */
    

    .btn {
        float: right;
        margin-top: 5px;
    }

    .text-center a {
        margin: 0 9px;
    }

    .find{
        margin-top: 25px;
    }

    .statbox {
        margin-top: 17px !important;
    }

    .row{
        align-items: flex-end;
    }

</style>

@section('admin')

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-6">
            <div class="statbox widget box box-shadow">

                <div class="widget-content widget-content-area">
                    <h3>Payer Scolarité </h3>
                    <h6>Elève: <strong>{{$student['student']['name']}} </strong> </h6>
                  

                    <hr>
                    <div class="head">
                        <form method="post" action="{{ route('schooling.store', $student->student_id) }}" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                    <label for="formGroupExampleInput">Montant a payer </label>
                                    <input  type="text" required name="schooling_fee" class="form-control search-form-control " >
                            
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">

                                    <input type="submit" value="payer sans reçu" class="btn btn-secondary  search mb-2">
                                   {{--  <div class="btn-group" role="group" aria-label="Basic example">
                                        <input type="submit" value="payer sans reçu" class="btn btn-secondary  search mb-2">
                                        <input type="submit" value="payer" class="btn btn-warning  search mb-2">
                                    </div> --}}
                                 
                                </div>
                            </div>
                        </form>
                       
                    </div>
                    
                </div>
            </div>
        </div>

    </div>


    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            var searchText = $('#searchText').val();
            //console.log(searchText)
            
              $.ajax({
               url: "{{ route('schooling.fee.get') }}",
               type: "get",
               data: {'searchText':searchText,},
               beforeSend: function() {       
               },
               success: function (data) {
                 var source = $("#document-template").html();
                 var template = Handlebars.compile(source);
                 var html = template(data);
                 $('#DocumentResults').html(html);
                 $('[data-toggle="tooltip"]').tooltip();
                 //console.log('makima')
               }
             });
        });
    </script>

@endsection
