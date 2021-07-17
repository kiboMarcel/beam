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

</style>

@section('admin')

    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-content widget-content-area">
                    <h3>Payer Scolarité </h3>
                    <h3>Eleve: {{$student['student']['name']}}  </h3>
                  

                    <hr>
                    <div class="head">
                        <form method="post" action="{{ route('schooling.store', $student->student_id) }}" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-9 col-md-9 col-sm-9 ">
                                    <label for="formGroupExampleInput">Montant a payer <span class="text-danger">*</span></label>
                                    <input  type="text" name="schooling_fee" class="form-control search-form-control " placeholder="Search...">
                            
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
    
                                    <input type="submit" value="payer" class="btn btn-outline-info search mb-2">
    
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
