@extends('admin.admin_master')


<style>

</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Ajouter Salaire</h3>
                <hr>
                <form method="post" action=" {{ route('account.salary.store') }} " enctype="multipart/form-data">
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
                                <label for="formGroupExampleInput">Numero <span
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
                            <label for="text">Designation</label>
                            <select name="designation_id" id="select" class="custom-select" required>
                                <option value="" selected="" disabled="">Selectionner designation</option>
                                @foreach ($designation as $des)
                                    <option value="{{ $des->id }}">{{ $des->name }}</option>
                                @endforeach

                            </select>
                        </div>

                    </div>
                    {{-- end row --}}

                    {{-- start row --}}
                    <div class="row">

                    
                      
                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="text">Salaire</label>
                                <input type="text" name="salary" required class="form-control" id="formGroupExampleInput">

                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="text">Debut service</label>
                                <input type="date" name="join_date" required class="form-control"
                                    id="formGroupExampleInput">
                            </div>
                        </div>

                    </div>
                    {{-- end row --}}

                    <div class="row">
                        <button class="btn btn-primary" type="submit">Enregistrer</button>
                    </div>

                   

            </div>

            </form>
        </div>
    </div>
    </div>
@endsection
