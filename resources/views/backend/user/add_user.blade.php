@extends('admin.admin_master')


<style>
    
</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Ajouter un Utilisateur</h3>
                <hr>
                <form method="post" action=" {{ route('user.store') }} ">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom d'utilisateur <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="formGroupExampleInput" required placeholder="nom">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput2">Role <span class="text-danger">*</span></label>
                                <select name="role" id="role" class="custom-select" required>
                                    <option value="" selected="" disabled="">Selectionner un role</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Operateur">Operateur</option>
                                    <option value="User">Utilisateur</option>
                                  </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput2">Email <span class="text-danger">*</span></label>
                                <input type="text" name="email" class="form-control" id="formGroupExampleInput2" placeholder="email">
                            </div>
                        </div>
                     
                    </div>

                  
                   <button class="btn btn-primary" type="submit">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
