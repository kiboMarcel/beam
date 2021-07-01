@extends('admin.admin_master')

<style>
    .tr_style{
        background-color: #0e1726 !important;
    }
    .table {
        background-color: rgb(153, 51, 114) !important;
    }

    .head {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
    }

    .btn {
        float: right;
        margin-top: 5px;
    }

    .text-center a{
        margin: 0 9px;
    }
</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <div class="head">
                            <h3>Details</h3>
                            <a href=" {{route('assign.subject.add') }} " class="btn btn-outline-secondary mb-2">Ajouter</a>
                        </div>


                        <table id="style-2" class="table  table-bordered  table-hover">
                            <h4><strong>Classe:</strong>  {{$detailData['0']['student_class']['name']}} 
                                {{$detailData['0']['student_branch']['name']}}
                            </h4>
                            <thead>
                                <tr class="thead_tr">
                                    <th> # </th>
                                    <th> Matiere </th>
                                   
                                    <th class="text-center">Note Total</th>
                                    <th class="text-center">Note de validation</th>
                                    <th class="text-center">Coefficient</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailData as $key => $detail)
                                    <tr class="tr_style">
                                        <td> {{ $key + 1 }} </td>


                                        <td>
                                            <div class="d-flex">
                                                <p class="align-self-center mb-0 "> {{ $detail['school_subject']['name'] }} </p>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            
                                                <p class="align-self-center mb-0 "> {{ $detail->full_mark}} </p>
                                            
                                        </td>
                                        <td class="text-center">
                                            
                                                <p class="align-self-center mb-0 "> {{ $detail->pass_mark}} </p>
                                            
                                        </td>
                                        <td class="text-center">
                                            
                                                <p class="align-self-center mb-0 "> {{ $detail->subjective_mark}} </p>
                                            
                                        </td>

                                    
                                    </tr>
                                @endforeach

                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
