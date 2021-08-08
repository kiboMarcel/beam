<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FeeCategoryAmount;
use App\Models\FeeCategory;
use App\Models\AssignClasse;
use App\Models\StudentClass;

class FeeAmountController extends Controller
{
    //
    public function ViewFeeAmount(){
        //$data['allData'] =  FeeCategoryAmount::all();
        $data['allData'] =  FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        //dd($data['allData']);
        return view('backend.setup.fee_amount.view_fee_amount', $data);

    }


    public function FeeAmountAdd(){
        
        $data['fee_categories']= FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.add_fee_amount', $data);

    }


    public function FeeAmountStore(Request $request){
        
        $countClass = count($request->class_id);
        if($countClass != NULL){
            for($i=0; $i< $countClass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount-> fee_category_id = $request->category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];

                //dd($request->amount);

                $fee_amount->save();
            }
        }

        return redirect()-> route('fee.amount.view')->with('success', '');

    }


    public function  FeeAmountEdit( $fee_category_id){

        $data['editData'] =  FeeCategoryAmount::where( 'fee_category_id' ,$fee_category_id)->
        get();
        //dd($data['editData']->toArray());
        $data['fee_categories']= FeeCategory::all();
        $data['classes'] = AssignClasse::groupBy('class_id')->get();
        return view('backend.setup.fee_amount.edit_fee_amount', $data);

    }

    public function FeeAmountUpdate(Request $request, $fee_category_id, $jsonId){
        $idArray=json_decode($jsonId);
        //dd($request->class_id);
        if($request->class_id == NULL){
            dd('Error');
        }else{
             
            $countClass = count($request->class_id);
            $fee_Record = FeeCategoryAmount::where( 'fee_category_id' ,$fee_category_id)->get();
            $countRecord = count($fee_Record);

            if($countClass == $countRecord  ){
                for($i=0; $i< $countClass; $i++) {
                    $fee_amount = FeeCategoryAmount::find($idArray[$i]);
                    $fee_amount-> fee_category_id = $request->category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];
    
                    $fee_amount->save();
                }
            }else{
                for($i=0; $i< $countRecord; $i++) {
                    $fee_amount = FeeCategoryAmount::find($idArray[$i]);
                    $fee_amount-> fee_category_id = $request->category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];
    
                    $fee_amount->save();
                }
                $last =$countClass - $countRecord  ;
                
                for($i=0; $i< $last; $i++) {
                    $new_fee_amount = new FeeCategoryAmount();
                    $j = ($i + $last);
                    $new_fee_amount-> fee_category_id = $request->category_id;
                    $new_fee_amount->class_id = $request->class_id[$j];
                    $new_fee_amount->amount = $request->amount[$j];
    
                    $new_fee_amount->save();
                }
            }
        }
        return redirect()-> route('fee.amount.view')->with('successUpdate', '');

   
    }


    public function  FeeAmountDetail(Request $request, $fee_category_id){

        $data['detailData'] =  FeeCategoryAmount::where( 'fee_category_id' ,$fee_category_id)->
        orderBy('class_id', 'asc')->get();

        
        

        return view('backend.setup.fee_amount.detail_fee_amount', $data);

    }


    public function  FeeAmountDelete(Request $request, $fee_category_id){

        $class =  FeeCategory::find($id);
        
        $class -> delete();
        

        return redirect()-> route('fee.category.view');

    }
}
