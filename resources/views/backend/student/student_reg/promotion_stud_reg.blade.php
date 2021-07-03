@extends('admin.admin_master')


<style>

</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Promotion de l'eleve: {{ $editData['student']['fname'] }} </h3>
                <hr>
                <form method="post" action=" {{ route('student.promote', $editData->student_id) }} " enctype="multipart/form-data">
                    @csrf
                    <input type="hidden"  name="id" value=" {{ $editData->id }} ">
                    {{-- start row --}}
                    <div class="row">

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom complet </label>
                                <input type="text" name="name"  class="form-control"
                                    value=" {{ $editData['student']['name'] }} ">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="email">Genre</label>
                                <select name="gender" id="select" class="custom-select" >
                                    <option value="" selected="" disabled="">Selectionner le sexe</option>
                                    <option value="masculin"
                                        {{ $editData['student']['gender'] == 'masculin' ? 'selected' : '' }}>Masuclin
                                    </option>
                                    <option value="feminin"
                                        {{ $editData['student']['gender'] == 'feminin' ? 'selected' : '' }}>Feminin
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-4 col-md-4">
                            <label for="text">Classe</label>
                            <select name="class_id" id="select" class="custom-select" required>
                                <option value="" selected="" disabled="">Selectionner classe</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ $editData->class_id == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}</option>
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
                                <select name="branch_id" id="select" class="custom-select" required>
                                    <option value="" selected="" disabled="">Selectionner Serie</option>
                                    @foreach ($branchs as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ $editData->branch_id == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="text">Groupe</label>
                                <select name="group_id" id="select" class="custom-select" required>
                                    <option value="" selected="" disabled="">Selectionner group</option>
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}"
                                            {{ $editData->group_id == $group->id ? 'selected' : '' }}>
                                            {{ $group->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="text">Annnée</label>
                                <select name="year_id" id="select" class="custom-select" required>
                                    <option value="" selected="" disabled="">Selectionner Année</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->id }}"
                                            {{ $editData->year_id == $year->id ? 'selected' : '' }}>{{ $year->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- end row --}}


                    <button class="btn btn-primary" type="submit">Promotion</button>

            </div>

            </form>
        </div>
    </div>
    </div>
@endsection
