<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\Karyawan;
use App\Models\type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends CustomController
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
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function create()
    {
        //

        if (\request('id')) {
            $fieldUser = \request()->validate(
                [
                    'role'     => 'required',
                ]
            );
            $fieldPassword = \request()->validate(
                [
                    'username' => 'required|string',
                    'password' => 'required|confirmed',
                ]
            );
            $cekUsername   = User::where([['username', '=', \request('username')], ['id', '!=', \request('id')]])->first();
            if ($cekUsername) {
                return \request()->validate(
                    [
                        'username' => 'required|string|unique:users,username',
                    ]
                );
            }
            if (strpos($fieldPassword['password'], '*') === false) {
                $password = Hash::make($fieldPassword['password']);
                Arr::set($fieldUser, 'password', $password);
            }

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

            $password = Hash::make($fieldUser['password']);
            Arr::set($fieldUser, 'password', $password);

            $fieldMember = \request()->validate(
                [
                    'nama'  => 'required',
                    'nip'   => 'required',
                    'no_hp' => 'required',
                    'foto'  => 'required',
                    'alamat' => 'required'
                ]
            );


            Arr::set($fieldMember, 'sisa_cuti', 12);

        }
        $image = \request('foto');
        if ($image){
            $image     = $this->generateImageName('foto');
            $stringImg = '/images/karyawan/'.$image;
            $this->uploadImage('foto', $image, 'imageKaryawan');
            Arr::set($fieldMember, 'foto', $stringImg);
        }

        DB::beginTransaction();
        try {
            if (\request('id')) {
                $user = User::with('karyawan')->find(\request('id'));
                if ($user->karyawan && $user->karyawan->foto){
                    if (file_exists('../public'.$user->karyawan->foto)) {
                        unlink('../public'.$user->karyawan->foto);
                    }
                }
                $user->update($fieldUser);
                $user->karyawan()->update($fieldMember);
            } else {
                $user = new User();
                $userData = $user->create($fieldUser);
                $userData->karyawan()->create($fieldMember);
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
     * @param $id
     *
     * @return string
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        $user->delete();
        return 'berhasil';
    }

    /**
     * @return string
     */
    public function reseteCuti(){
        DB::statement('UPDATE `karyawans` SET `sisa_cuti` = 12');

        return 'success';
    }
}
