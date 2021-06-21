@extends('admin.admin_master')


<style>
   
</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Modifier Utilisateur</h3>
                <hr>
                <form method="post" action=" {{ route('user.update', $editData->id) }} ">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom d'utilisateur *</label>
                                <input type="text" name="name" value=" {{$editData->name}} " class="form-control" id="formGroupExampleInput" required placeholder="nom">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput2">Role*</label>
                                <select name="usertype" id="select" class="custom-select" required>
                                    <option value="" selected="" disabled="">Selectionner un role</option>
                                    <option value="admin" {{ ($editData->usertype == "admin" ? "selected": "") }} >Admin</option>
                                    <option value="secretaire" {{ ($editData->usertype == "secretaire" ? "selected": "") }} >Secretaire</option>
                                    <option value="user" {{ ($editData->usertype == "user" ? "selected": "") }}>Utilisateur</option>
                                  </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput2">Email*</label>
                                <input type="text" name="email" value=" {{$editData->email}} "  class="form-control" id="formGroupExampleInput2" placeholder="email">
                            </div>
                        </div>
                      
                    </div>

                    <button class="btn btn-primary" type="submit">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection
