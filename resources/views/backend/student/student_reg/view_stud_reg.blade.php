@extends('admin.admin_master')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

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

    .find {
        margin-top: 25px;
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
                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                        <label for="text">Année</label>
                        <select name="year_id" class="custom-select" required>
                            <option value="" disabled="">Selectionner Année</option>
                            @foreach ($years as $year)
                                <option value="{{ $year->id }}" {{ $year->active == 1 ? 'selected' : '' }}>
                                    {{ $year->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                        <label for="text">Classe</label>
                        <select id="class_id" name="class_id" class="custom-select" required>
                            <option value="" selected="" disabled="">Selectionner classe</option>
                            @foreach ($classes as $class)
                            <option value="{{ $class['student_class']['id'] }}">{{ $class['student_class']['name'] }}</option>
                        @endforeach


                        </select>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 ">
                        <label for="text">Serie</label>
                        <select name="branch_id" id="branch_id" class="custom-select">
                            <option value="" selected="" disabled="">Selectionner Serie</option>
                            @if (@$branch_id != null)
                                @foreach ($branchs as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ @$branch_id == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}</option>
                                @endforeach
                            @endif
                            {{-- @foreach ($branchs as $branch)
                                <option value="{{ $branch->id }}" {{ @$branch_id == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}</option>
                            @endforeach --}}

                        </select>
                    </div>


                </div>
                <br>
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-6 ">
                        <label for="text">Groupe</label>
                        <select name="group_id" id="group_id" class="custom-select">
                            <option value="" selected="" disabled="">Selectionner groupe</option>
                            @if (@$group_id != null)
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}"
                                        {{ @$group_id == $group->id ? 'selected' : '' }}>
                                        {{ $group->name }}</option>
                                @endforeach
                            @endif
                            {{-- @foreach ($groups as $group)
                                <option value="{{ $group->id }}" {{ @$group_id == $group->id ? 'selected' : '' }}>
                                    {{ $group->name }}</option>
                            @endforeach --}}

                        </select>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-9 find ">

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
                            @if ($count != 0)
                                <h2 class="badge outline-badge-info">{{ $count }} Eleves</h2>

                               

                                    <a target="blank" href=" {{ route('student.list.print', [$year_id, $class_id, $branch_id, $group_id]) }} "
                                        class="btn btn-outline-success mb-2" data-toggle="tooltip" data-placement="top" title="Imprimer"
                                        data-original-title="Imprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-printer">
                                        <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                        </path>
                                        <rect x="6" y="14" width="12" height="8"></rect>
                                    </svg>
                                    </a>
                              
                            @endif



                            {{-- <a href=" {{ route('student.registration.add') }} "
                                class="btn btn-outline-secondary mb-2">Ajouter</a> --}}

                        </div>

                        {{-- GET STATUS FOR SWEET ALERT  START --}}
                        @php
                            $getstatus = \Session::has('success');
                            $getUpdateStatus = \Session::has('successUpdate');
                            
                        @endphp
                        {{-- GET STATUS FOR SWEET ALERT START --}}

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
                                                    class="bs-tooltip" target="blank" data-toggle="tooltip" data-placement="top" title=""
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



    {{-- GET CLASS BRANCH START --}}
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#class_id', function() {
                var class_id = $('#class_id').val();

                $.ajax({
                    url: "{{ route('student.getclass.branch') }}",
                    type: "GET",
                    data: {
                        class_id: class_id,
                    },
                    success: function(data) {
                        var html = '<option value="">Selectionner Serie</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.branch_id + '"  >' + v
                                .student_branch
                                .name + '</option>';
                        });
                        $('#branch_id').html(html);
                    }
                });
            });
        });
    </script>
    {{-- GET CLASS BRANCH END --}}

    {{-- GET CLASS GROUP START --}}
    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#branch_id', function() {
                var class_id = $('#class_id').val();
                var branch_id = $('#branch_id').val();

                $.ajax({
                    url: "{{ route('student.getclass.group') }}",
                    type: "GET",
                    data: {
                        class_id: class_id,
                        branch_id: branch_id,
                    },
                    success: function(data) {
                        var html = '<option value="">Selectionner groupe</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.group_id + '">' + v
                                .student_group
                                .name + '</option>';
                        });
                        $('#group_id').html(html);
                    }
                });
            });
        });
    </script>
    {{-- GET CLASS GROUP END --}}

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
            if (isUpdate) {
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em'
                });

                toast({
                    type: 'success',
                    title: 'Modifier avec Success',
                    padding: '2em',
                })
            }


        });
    </script>
@endsection
