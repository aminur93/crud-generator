<?php

namespace Aminurdev\CrudGenerator\Http\Controllers;

use Aminurdev\CrudGenerator\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CrudGeneratorController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->get();

        return view('CrudGenerator::index', compact('employees'));
    }

    public function create()
    {
        return view('CrudGenerator::create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        if($request->isMethod('post'))
        {
            DB::beginTransaction();

            try{

                $employee = new Employee();

                $employee->name = $request->name;
                $employee->email = $request->email;
                $employee->phone = $request->phone;
                $employee->address = $request->address;

                $employee->save();

                DB::commit();

                return response()->json([
                    'flash_message_success' => 'Employee Added Successfully'
                ],Response::HTTP_CREATED);

            }catch(QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function edit($id)
    {
        $employee = Employee::find($id);

        return view('CrudGenerator::edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        if($request->_method == 'PUT')
        {
            DB::beginTransaction();

            try{

                $employee = Employee::find($id);

                $employee->name = $request->name;
                $employee->email = $request->email;
                $employee->phone = $request->phone;
                $employee->address = $request->address;

                $employee->save();

                DB::commit();

                return response()->json([
                    'flash_message_success' => 'Employee updated Successfully'
                ],Response::HTTP_OK);

            }catch(QueryException $e){
                DB::rollBack();

                $error = $e->getMessage();

                return response()->json([
                    'error' => $error
                ],Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return \response()->json([
            'flash_message_success' => 'Employee destroy successful',
        ],Response::HTTP_OK);
    }
}
