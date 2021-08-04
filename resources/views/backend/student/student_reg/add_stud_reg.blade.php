@extends('admin.admin_master')


<script src=" {{ asset('js/jquery-3.6.0.js') }}"></script>

<style>
.bt-position {
        display: flex;
        justify-content: flex-end;
    }
</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Ajouter Elève</h3>
                <hr>
                <form method="post" action=" {{ route('student.registration.store') }} " enctype="multipart/form-data">
                    @csrf
                    {{-- start row --}}
                    <div class="row">

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom complet <span class="text-danger">*</span></label>
                                <input type="text" name="name" required class="form-control" id="formGroupExampleInput"
                                    placeholder="ex Jhon Pierre Doe">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom du pere <span class="text-danger">*</span></label>
                                <input type="text" name="fname" required class="form-control" id="formGroupExampleInput">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom de la mere <span class="text-danger">*</span></label>
                                <input type="text" name="mname" required class="form-control" id="formGroupExampleInput">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- end row --}}

                    {{-- start row --}}
                    <div class="row">

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Numero du tuteur <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="mobile" required class="form-control" id="formGroupExampleInput">

                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">adresse <span class="text-danger">*</span></label>
                                <input type="text" name="address" required class="form-control" id="formGroupExampleInput">

                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Genre</label>
                                <select name="gender" id="select formGroupExampleInput" class="custom-select" required>
                                    <option value="" selected="" disabled="">Selectionner sexe</option>
                                    <option value="masculin">Masuclin
                                    </option>
                                    <option value="feminin">Feminin
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- end row --}}

                    {{-- start row --}}
                    <div class="row">

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="email">Nationalité</label>
                                <select name="nationality" id="select" class="custom-select" required>
                                    <option value="" selected="" disabled="">Selectionner pays</option>
                                    <option value="Togo">Togo
                                    </option>
                                    <option value="Benin">Benin
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Année de naissance <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="date_of_birth" required class="form-control"
                                    id="formGroupExampleInput">

                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <label for="text">Classe</label>
                            <select name="class_id" id="class_id" class="custom-select" required>
                                <option value="" selected="" disabled="">Selectionner classe</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class['student_class']['id'] }}">{{ $class['student_class']['name'] }}</option>
                                @endforeach

                            </select>
                        </div>

                    </div>
                    {{-- end row --}}

                    {{-- start row --}}
                    <div class="row">

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="text">Serie</label>
                                <select name="branch_id" id="branch_id" class="custom-select" required>
                                    <option value="" selected="" disabled="">Selectionner Serie</option>
                                    @foreach ($branchs as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="text">Groupe</label>
                                <select name="group_id" id="group_id" class="custom-select" required>
                                    <option value="" selected="" disabled="">Selectionner groupe</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="text">Année</label>
                                <select name="year_id" id="select" class="custom-select" required>
                                    <option value="" " disabled="">Selectionner Année</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->id }}" {{ $year->active==1 ? 'selected': '' }}>
                                            {{ $year->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                    </div>
                    {{-- end row --}}


                    <div class="bt-position">
                        <button class="btn btn-primary" type="submit">Enregistrer</button>
                    </div>

            </div>

            </form>
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
                    async: true,
                    data: {
                        class_id: class_id,
                    },
                   
                    success: function(data) {
                        
                        $("#loaderDiv").hide();
                        var html = '<option value="" selected="" disabled="">Selectionner Serie</option>';
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
@endsection
