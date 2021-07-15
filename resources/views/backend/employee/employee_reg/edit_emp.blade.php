@extends('admin.admin_master')


<style>

</style>
@php
 $dob = date('Y-m-d', strtotime( $editData->date_of_birth) );
 $joindate = date('Y-m-d', strtotime( $editData->join_date) );
@endphp

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Modifier Employé</h3>
                <hr>
                <form method="post" action=" {{ route('employee.update', $editData->id ) }} " enctype="multipart/form-data">
                    @csrf
                    {{-- start row --}}
                    <div class="row">

                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom complet <span class="text-danger">*</span></label>
                                <input type="text" name="name" required class="form-control"
                                value=" {{ $editData->name }} " id="formGroupExampleInput"
                                    placeholder="ex Jhon Pierre Doe">
                               
                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom du pere <span class="text-danger">*</span></label>
                                <input type="text" name="fname" 
                                value=" {{ $editData->fname }} " required class="form-control" id="formGroupExampleInput">
                              
                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom de la mere <span class="text-danger">*</span></label>
                                <input type="text" name="mname" 
                                value=" {{ $editData->mname }} " required class="form-control" id="formGroupExampleInput">
                              
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
                                <input type="text" name="mobile"
                                value=" {{ $editData->mobile }} " required class="form-control" id="formGroupExampleInput">

                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">adresse <span class="text-danger">*</span></label>
                                <input type="text" name="address" 
                                value=" {{ $editData->address }} " required class="form-control" id="formGroupExampleInput">

                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Genre</label>
                                <select name="gender" id="select formGroupExampleInput" class="custom-select" required>
                                    <option value="" selected="" disabled="">Selectionner sexe</option>
                                    <option value="masculin"  {{ $editData->gender == 'masculin' ? 'selected' : '' }} >Masuclin
                                    </option>
                                    <option value="feminin"   {{ $editData->gender == 'feminin' ? 'selected' : '' }} >Feminin
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
                                    <option value="Togo"  {{ $editData->nationality == 'Togo' ? 'selected' : '' }}  >Togo
                                    </option>
                                    <option value="Benin"   {{ $editData->nationality == 'Benin' ? 'selected' : '' }} >Benin
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4 col-md-4">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Année de naissance <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="date_of_birth" required class="form-control"
                                value="{{$dob}}" id="formGroupExampleInput">

                            </div>

                       
                        </div>
                        <div class="col-4 col-md-4">
                            <label for="text">Designation</label>
                            <select name="designation_id" id="select" class="custom-select" required>
                                <option value="" selected="" disabled="">Selectionner designation</option>
                                @foreach ($designation as $des)
                                    <option value="{{ $des->id }}" 
                                        {{ $editData->designation_id == $des->id ? 'selected' : '' }}>{{ $des->name }}</option>
                                @endforeach

                            </select>
                        </div>

                    </div>
                    {{-- end row --}}

                    {{-- start row --}}
                    <div class="row">

                    
                      @if ( !$editData )
                      <div class="col-6 col-md-6">
                        <div class="form-group mb-4">
                            <label for="text">Salaire</label>
                            <input type="text"
                            value=" {{ $editData->salary }} " name="salary" required class="form-control" id="formGroupExampleInput">

                        </div>
                    </div>
                      @endif
                      
                      @if ( !$editData )
                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="text">Debut service</label>
                                <input type="date" name="join_date" required class="form-control"
                                value="{{$joindate}}" id="formGroupExampleInput">
                            </div>
                        </div>
                        @endif

                    </div>
                    {{-- end row --}}

                    <div class="row">
                        <button class="btn btn-primary" type="submit">Mettre à jour</button>
                    </div>

                   

            </div>

            </form>
        </div>
    </div>
    </div>
@endsection
