@extends('admin.admin_master')


<style>
    
</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Ajouter designation</h3>
                <hr>
                <form method="post" action=" {{ route('designation.store')}}  ">
                    @csrf
                    <div class="row">
                       
                        <div class="col-12 col-md-12">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Nom <span class="text-danger">*</span></label>
                                <input  type="text" name="name" class="form-control" id="formGroupExampleInput" >
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                  
                      
                     
                    <button class="btn btn-primary" type="submit">Enregistrer</button>

                    </div>
            
                </form>
            </div>
        </div>
    </div>
@endsection
