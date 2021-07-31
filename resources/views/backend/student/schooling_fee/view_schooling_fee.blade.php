@extends('admin.admin_master')


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

<script type="text/javascript" src="{% static "javascript/main.js" %}"></script>

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
                    <h3>Chercher Eleve</h3>

                     {{-- GET STATUS FOR SWEET ALERT  START --}}
                     @php
                     $getstatus = \Session::has('success');
                     $getUpdateStatus = \Session::has('successUpdate');
                     
                 @endphp
                 {{-- GET STATUS FOR SWEET ALERT START --}}

                    <div class="head">
                              
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 ">
                                <input id="searchText" type="text" name="searchText" class="form-control search-form-control " placeholder="Search...">
                        
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">

                                <a id="search" name="search" class="btn btn-outline-info search mb-2">Chercher</a>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive mb-4">

                        <div id="DocumentResults">

                            <script id="document-template" type="text/x-handlebars-template">

                                <table class="table table-bordered  table-hover">
                                    <thead>
                                        <tr>
                                            @{{{ thsource }}}
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @{{#each this}}
                                        <tr>
                                            @{{{tdsource}}}
                                        </tr>
                                        @{{/each}}
                                    </tbody>
                                </table>

                            </script>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- GET STUDENT ON SEARCH START --}}
    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            var searchText = $('#searchText').val();
            
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
    {{-- GET STUDENT ON SEARCH END --}}


 {{-- SWEET ALERT SCRIPT --}}
 <script>
    window.addEventListener('load', function() {
        var isCreate = <?php echo json_encode($getstatus); ?>;
        var isUpdate = <?php echo json_encode($getUpdateStatus); ?>;

        if (isCreate) {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                padding: '2em'
            });

            toast({
                type: 'success',
                title: 'Creer avec Success',
                padding: '2em',
            })
        }


    });
</script>
@endsection
