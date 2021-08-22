@extends('admin.admin_master')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    .add,
    .remove,
    .delete {
        float: right;
        margin-top: 33px;
    }

    .bt-position {
        display: flex;
        justify-content: flex-end;
    }

</style>

@section('admin')
    <div class="row layout-top-spacing layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <h3>Attribuer Matière</h3>
                <hr>
               
                @php
                $id = array();
                    for ($i=0 ; $i< count($editData); $i++ ){
                        $id[] = $editData[$i]->id;
                    }
                    $jsonId = json_encode($id) ;
                   //dd($jsonId);
                @endphp

                <form method="post" action=" {{ route('assign.subject.update', [$editData[0]->class_id, $jsonId, $editData[0]->branch_id] ) }}  ">
                    @csrf

                    <div class="add_item">

                        <div class="row">

                            <div class="col-6 col-md-6">
                                <div class="form-group mb-4">
                                    <label for="text">Classe <span class="text-danger">*</span></label>
                                    <select name="class_id" id="select" class="custom-select">
                                        <option value="" selected="" disabled=""> Selectionner classe </option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}"
                                                {{ $editData['0']->class_id == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="form-group mb-4">
                                    <label for="text">serie/filiere <span class="text-danger">*</span></label>
                                    <select name="branch_id" id="select" class="custom-select">
                                        <option value="" selected="" disabled=""> Selectionner serie/filiere </option>
                                        @foreach ($branchs as $branch)
                                            <option value="{{ $branch->id }}"
                                                {{ $editData['0']->branch_id == $branch->id ? 'selected' : '' }}>
                                                {{ $branch->name }} </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                        </div>
                       

                        @foreach ($editData as $edit)
                            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                <div class="row">

                                    <div class="col-3 col-md-3">
                                        <div class="form-group mb-4">
                                            <label for="email">Matières {{$edit->id}} <span class="text-danger">*</span></label>
                                            <select name="subject_id[]" id="select" class="custom-select" required>
                                                <option value="" selected="" disabled=""> Selectionner matière </option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}"
                                                        {{ $edit->subject_id == $subject->id ? 'selected' : '' }}> {{ $subject->name }} </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-2 col-md-2">
                                        <div class="form-group mb-4">
                                            <label for="formGroupExampleInput">Note Total <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="full_mark[]" class="form-control"
                                                id="formGroupExampleInput" value="{{ $edit->full_mark }} " >
                                            @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-3 col-md-3">
                                        <div class="form-group mb-4">
                                            <label for="formGroupExampleInput">Prof. <span
                                            class="text-danger">*</span></label>
                                                <select name="teacher_id[]" id="select" class="custom-select">
                                                <option value="" selected="" disabled=""> Selectionner Prof. </option>
                                                @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" 
                                                    {{ $teacher->id == $edit->teacher_id ? 'selected' : ''}}>
                                                     {{ $teacher->name }} 
                                                </option>
                                            @endforeach
                        
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-2 col-md-2">
                                        <div class="form-group mb-4">
                                            <label for="formGroupExampleInput">coefficient<span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="subjective_mark[]" class="form-control"
                                            value="{{ $edit->coef }} " >
                                            @error('amount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-2 col-md-2">
                                        <a id="delete"  href=" {{ route('assign.subject.delete.single', $edit->id ) }} ">
                                            <span  class="btn btn-danger mb-2 mr-2 delete ">
                                                <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                </svg>
                                            </span>
                                           </a>
                                       {{--  <span class="btn btn-danger mb-2 mr-2 remove">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                        </span> --}}
                                        <span class="btn btn-success   mb-2 mr-2 add">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>


                    
                    
                    <div class="bt-position">
                        <button class="btn btn-primary" type="submit">Mettre à jour</button>
                    </div>
            </div>

            </form>
        </div>
    </div>

    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                <div class="form-row">

                    <div class="col-3 col-md-3">
                        <div class="form-group mb-4">
                            <label for="email">Matières <span class="text-danger">*</span></label>
                            <select name="subject_id[]" id="select" class="custom-select" required>
                                <option value="" selected="" disabled=""> Selectionner matière </option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"> {{ $subject->name }} </option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-2 col-md-2">
                        <div class="form-group mb-4">
                            <label for="formGroupExampleInput">Note Total <span class="text-danger">*</span></label>
                            <input type="text" name="full_mark[]" class="form-control" id="formGroupExampleInput">
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3 col-md-3">
                        <div class="form-group mb-4">
                            <label for="formGroupExampleInput">Prof. <span
                            class="text-danger">*</span></label>
                                <select name="teacher_id[]" id="select" class="custom-select">
                                <option value="" selected="" disabled=""> Selectionner Prof. </option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"   >
                                        {{ $teacher->name }} </option>
                                    @endforeach
        
                                </select>
                        </div>
                    </div>
                    <div class="col-2 col-md-2">
                        <div class="form-group mb-4">
                            <label for="formGroupExampleInput">Coefficient<span class="text-danger">*</span></label>
                            <input type="text" name="subjective_mark[]" class="form-control" id="formGroupExampleInput">
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-2 col-md-2">
                        <span class="btn btn-danger mb-2 mr-2 remove">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-plus">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                        <span class="btn btn-success   mb-2 mr-2 add">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-plus">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                    </div>




                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".add", function() {
                var whole_extra_item_add = $('#whole_extra_item_add').html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".remove", function(event) {
                $(this).closest(".delete_whole_extra_item_add").remove();
                counter -= 1
            })
        })
    </script>

        <!--BEGIN SWEET ALERT DELETE CONFIRMATION SCRIPTS -->
        <script>
            $(document).on("click", "#delete", function(event) {
                    //console.log('ok');
                    event.preventDefault();
                 var link = $(this).attr("href")
                 swal({
                     title: 'Etes vous Sûr ?',
                     text: "Cette action est irreversible et supprimera tout objet lié a celui-ci!",
                     type: 'warning',
                     showCancelButton: true,
                     confirmButtonText: 'Delete',
                     padding: '2em'
                 }).then(function(result) {
                     if (result.value) {
                         window.location.href = link
                         swal(
                             'Supression en cours!',
                         )
                     }
                 })
                 })
         </script>
         <!-- END SWEET ALERT DELETE CONFIRMATION  SCRIPTS -->

@endsection
