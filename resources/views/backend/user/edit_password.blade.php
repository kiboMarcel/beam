@extends('admin.admin_master')


<style>
    
</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Modifier Mot de passe</h3>
                <hr>
                <form method="post" action=" {{ route('password.update') }} ">
                    @csrf
                    <div class="row">
                       
                        <div class="col-12 col-md-12">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Ancien mot de passe *</label>
                                <input id="current_password" type="password" name="oldpassword" class="form-control" id="formGroupExampleInput" >
                                @error('oldpassword')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nouveau mot de passe *</label>
                                <input  id="password" type="password" name="password" class="form-control" id="formGroupExampleInput" >
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Confirmer mot de passe *</label>
                                <input  id="password_confirmation" type="password" name="password_confirmation" class="form-control" id="formGroupExampleInput"  >
                                @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                     
                    </div>
            
                  
                   <button class="btn btn-primary" type="submit">Modifier</button>
                </form>
            </div>
        </div>
    </div>
@endsection
