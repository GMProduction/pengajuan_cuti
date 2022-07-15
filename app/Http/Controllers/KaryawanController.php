<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\request()->isMethod('POST')) {
            return $this->create();
        }
        $data = User::with('karyawan')->paginate(10);

        return view('admin.karyawan', ['sidebar' => 'karyawan', 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        if (\request('id')) {
            $fieldUser = \request()->validate(
                [
                    'role'     => 'required',
                    'username' => 'required|string',
                    'password' => 'required|confirmed',
                ]
            );

            $fieldMember = \request()->validate(
                [
                    'nama'  => 'required',
                    'nip'   => 'required',
                    'no_hp' => 'required',
                ]
            );

        } else {
            $fieldUser = \request()->validate(
                [
                    'role'     => 'required',
                    'username' => 'required|string|unique:users,username',
                    'password' => 'required|confirmed',
                ]
            );

            $fieldMember = \request()->validate(
                [
                    'nama'  => 'required',
                    'nip'   => 'required',
                    'no_hp' => 'required',
                    'foto'  => 'required',
                ]
            );

            Arr::set($fieldMember, 'sisa_cuti', 13);

        }
        dd($fieldMember);

        DB::beginTransaction();
        try {
            if (\request('id')) {

            } else {
                $user = new User();
                $user->create($fieldUser);
                $user->karyawan()->create($fieldMember);
            }
            DB::commit();

            return response()->json(['msg' => 'success']);
        } catch (\Exception $er) {
            DB::rollBack();

            return response()->json(['msg' => $er->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
