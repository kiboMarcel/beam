@extends('admin.admin_master')

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

    .text-center a {
        margin: 0 9px;
    }

    .statbox {
        margin-top: 17px !important;
    }

</style>

@section('admin')
    {{-- search box start --}}
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Chercher</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area text-center tags-content">
            <form method="GET" action="{{ route('student.year.class.wise') }} ">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-9 ">
                        <label for="text">Annnée</label>
                        <select name="year_id" class="custom-select" required>
                            <option value="" selected="" disabled="">Selectionner Année</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}" {{ @$year_id == $year->id ? 'selected' : '' }}>
                                    {{ $year->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-9 ">
                        <label for="text">Classe</label>
                        <select name="class_id" class="custom-select" required>
                            <option value="" selected="" disabled="">Selectionner classe</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" {{ @$class_id == $class->id ? 'selected' : '' }}>
                                    {{ $class->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-9 ">
                        <label for="text">Serie</label>
                        <select name="branch_id" class="custom-select">
                            <option value="" selected="" disabled="">Selectionner Serie</option>
                            @foreach ($branchs as $branch)
                                <option value="{{ $branch->id }}" {{ @$branch_id == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-9 ">

                        <input type="submit" name="search" value="Chercher" class="btn btn-outline-info mb-2">

                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- search box end --}}


    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">

                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <div class="head">
                            <h3>Liste des Eleves</h3>
                            <a href=" {{ route('student.registration.add') }} "
                                class="btn btn-outline-secondary mb-2">Ajouter</a>
                        </div>

                        @if (!@search)
                            <table id="style-2" class="table table-bordered  table-hover">
                                <thead>
                                    <tr class="thead_tr">
                                        <th> # </th>
                                        <th> Nom</th>
                                        <th> Num mat</th>
                                        <th> Classe</th>
                                        <th> Filiere</th>
                                        <th> Année</th>
                                        @if (Auth::User()->role = 'Admin')
                                            <th> code</th>
                                        @endif
                                        <th class="text-center" colspan="3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allData as $key => $value)
                                        <tr class="tr_style">
                                            <td> {{ $key + 1 }} </td>


                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 "> {{ $value['student']['name'] }}
                                                    </p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 "> {{ $value['student']['id_no'] }}
                                                    </p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 ">
                                                        {{ $value['student_class']['name'] }} </p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 ">
                                                        {{ $value['student_branch']['name'] }} </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 ">
                                                        {{ $value['student_year']['name'] }} </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 "> {{ $value['student']['code'] }}
                                                    </p>
                                                </div>
                                            </td>





                                            <td class="text-center">
                                                <a href="{{ route('student.registration.edit', $value->student_id) }} "
                                                    class="bs-tooltip" data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-3">
                                                        <path d="M12 20h9"></path>
                                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">
                                                        </path>
                                                    </svg>
                                                </a>

                                                <a href=" {{ route('student.registration.promotion', $value->student_id) }} "
                                                    class="bs-tooltip" data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Promotion">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" color="#25d5e4"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-chevrons-up">
                                                        <polyline points="17 11 12 6 7 11"></polyline>
                                                        <polyline points="17 18 12 13 7 18"></polyline>
                                                    </svg>
                                                </a>
                                                <a href=" {{ route('student.detail.pdf', $value->student_id) }} "
                                                    class="bs-tooltip" data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Detail">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" color="#185ADB"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-file-text">
                                                        <path
                                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                        </path>
                                                        <polyline points="14 2 14 8 20 8"></polyline>
                                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                                        <polyline points="10 9 9 9 8 9"></polyline>
                                                    </svg>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>


                            {{-- search section data start --}}
                        @else
                            <table id="style-2" class="table  table-bordered  table-hover">
                                <thead>
                                    <tr class="thead_tr">
                                        <th> # </th>
                                        <th> Nom</th>
                                        <th> Num mat</th>
                                        <th> Classe</th>
                                        <th style=" width:10% "> Filiere</th>
                                        <th> Année</th>
                                        @if (Auth::User()->role = 'Admin')
                                            <th> code</th>
                                        @endif
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allData as $key => $value)
                                        <tr class="tr_style">
                                            <td> {{ $key + 1 }} </td>


                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 "> {{ $value['student']['name'] }}
                                                    </p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 "> {{ $value['student']['id_no'] }}
                                                    </p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 ">
                                                        {{ $value['student_class']['name'] }} </p>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 ">
                                                        {{ $value['student_branch']['name'] }} </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 ">
                                                        {{ $value['student_year']['name'] }} </p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <p class="align-self-center mb-0 "> {{ $value['student']['code'] }}
                                                    </p>
                                                </div>
                                            </td>





                                            <td class="text-center">
                                                <a href=" {{ route('student.registration.edit', $value->student_id) }} "
                                                    class="bs-tooltip" data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-edit-3">
                                                        <path d="M12 20h9"></path>
                                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">
                                                        </path>
                                                    </svg>
                                                </a>

                                                <a href=" {{ route('student.registration.promotion', $value->student_id) }} "
                                                    class="bs-tooltip" data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Promotion">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" color="#25d5e4"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-chevrons-up">
                                                        <polyline points="17 11 12 6 7 11"></polyline>
                                                        <polyline points="17 18 12 13 7 18"></polyline>
                                                    </svg>
                                                </a>
                                                <a href=" {{ route('student.detail.pdf', $value->student_id) }} "
                                                    class="bs-tooltip" data-toggle="tooltip" data-placement="top" title=""
                                                    data-original-title="Detail">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" color="#185ADB"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-file-text">
                                                        <path
                                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">
                                                        </path>
                                                        <polyline points="14 2 14 8 20 8"></polyline>
                                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                                        <polyline points="10 9 9 9 8 9"></polyline>
                                                    </svg>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                        @endif
                        {{-- search section data end --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
