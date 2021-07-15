@extends('admin.admin_master')


<style>
    
</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Augmenter Salaire Employer</h3>
                <hr>
                <form method="post" action=" {{ route('update.salary.increment.store',  $editData->id)}}  ">
                    @csrf
                    <div class="row">
                       
                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Montant <span class="text-danger">*</span></label>
                                <input  type="text" name="increment_salary" class="form-control" id="formGroupExampleInput" >
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput">Date D'attribution <span class="text-danger">*</span></label>
                                <input  type="date" name="effected_salary" class="form-control" id="formGroupExampleInput" >
                                
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
