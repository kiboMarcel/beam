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


    /* .head {
        display: flex;
        flex-direction: column;
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

    .find {
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
                    <h3> Modifier Notes</h3>
                    <form method="post" action=" {{ route('marks.update') }}  ">
                        @csrf

                        <div class="head">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-9 ">
                                    <label for="text">Annnée</label>
                                    <select name="year_id" id="year_id" class="custom-select" required>
                                        <option value="" selected="" disabled="">Selectionner Année</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year->id }}">
                                                {{ $year->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-9 ">
                                    <label for="text">Classe</label>
                                    <select name="class_id" id="class_id" class="custom-select" required>
                                        <option value="" selected="" disabled="">Selectionner classe</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">
                                                {{ $class->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-9 ">
                                    <label for="text">Serie</label>
                                    <select name="branch_id" id="branch_id" class="custom-select">
                                        <option " selected="" disabled="">Selectionner Serie</option>
                                                        @foreach ($branchs as $branch)
                                        <option value="{{ $branch->id }}">
                                            {{ $branch->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-9 ">
                                    <label for="text">Matiere</label>
                                    <select name="assign_subject_id" id="assign_subject_id" class="custom-select">
                                        <option selected="" disabled="">Selectionner Matiere</option>

                                    </select>
                                </div>


                            </div> <br>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 ">
                                    <label for="text">Groupe</label>
                                    <select name="group_id" id="group_id" class="custom-select">
                                        <option " selected="" disabled=""> Selectionner Groupe</option>
                                             @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">
                                            {{ $group->name }}</option>
                                        @endforeach

                                    </select>

                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-3 ">
                                    <label for="text">Type D'examen</label>
                                    <select name="exam_type_id" id="exam_type_id" class="custom-select">
                                        <option " selected="" disabled="">Selectionner examen</option>
                                                        @foreach ($exam_types as
                                            $exam_type)
                                        <option value="{{ $exam_type->id }}">
                                            {{ $exam_type->name }}</option>
                                        @endforeach

                                    </select>
                                </div>


                                <div class="col-lg-3 col-md-3 col-sm-3 find">

                                    <a id="search" name="search" class="btn btn-outline-info search mb-2">Chercher</a>

                                </div>


                            </div> <br>

                        </div>
                        <hr>


                        {{-- mark entry table start --}}
                        <div class="table-responsive mb-4">

                            <div class="d-none" id="mark-entry">

                                <table id="style-2" class="table style-2  table-hover">
                                    <thead>
                                        <tr class="thead_tr">
                                            <th> Nom</th>
                                            <th> Num mat</th>
                                            <th> Classe</th>
                                            <th> Filiere</th>
                                            <th> Groupe</th>
                                            <th> Note</th>
                                        </tr>
                                    </thead>

                                    <tbody id="mark-enrty-tr">

                                    </tbody>
                                </table>


                                <input type="submit" class="btn btn-outline-info search mb-2" value="Mettre à jour" id="">
                            </div>

                        </div>
                        {{-- mark entry table end --}}
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        $(document).on('click', '#search', function() {
            //console.log('makima')
            var year_id = $('#year_id').val();
            var class_id = $('#class_id').val();
            var branch_id = $('#branch_id').val();
            var group_id = $('#group_id').val();
            var assign_subject_id = $('#assign_subject_id').val();
            var exam_type_id = $('#exam_type_id').val();
            $.ajax({
                url: "{{ route('students.edit.getstudents') }}",
                type: "GET",
                data: {
                    'year_id': year_id,
                    'class_id': class_id,
                    'branch_id': branch_id,
                    'assign_subject_id': assign_subject_id,
                    'exam_type_id': exam_type_id,
                    'group_id': group_id
                },
                success: function(data) {
                    $('#mark-entry').removeClass('d-none');
                    var html = '';
                    $.each(data, function(key, v) {
                        html +=
                            '<tr class="tr_style">' +

                            '<td>' + v.student.name + '</td>' +

                            '<td>' + v.student.id_no +
                            '<input type="hidden" name="student_id[]" value="' + v.student_id +
                            '"> <input type="hidden" name="id_no[]" value="' + v.student.id_no +
                            '">      </td>' +

                            '<td>' + v.student_class.name + '</td>' +
                            '<td>' + v.student_branch.name + '</td>' +
                            '<td>' + v.student_group.name + '</td>' +
                            
                            '<td><input type="text" class="form-control form-control-sm" value="'+ v.marks +'" name="marks[]"></td>' +
                            '</tr>';

                            console.log( v.marks)
                    });
                    html = $('#mark-enrty-tr').html(html);

                }
            });
        });
    </script>


    <script type="text/javascript">
        $(function() {
            $(document).on('change', '#branch_id', function() {
                var class_id = $('#class_id').val();
                var branch_id = $('#branch_id').val();
               
                $.ajax({
                    url: "{{ route('marks.getsubject') }}",
                    type: "GET",
                    data: {
                        class_id: class_id,
                        branch_id: branch_id
                    },
                    success: function(data) {
                        var html = '<option value="">Selectionner Matiere</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.id + '">' + v.school_subject
                                .name + '</option>';
                        });
                        $('#assign_subject_id').html(html);
                    }
                });
            });
        });
    </script>

@endsection
