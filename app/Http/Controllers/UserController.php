<?php

namespace App\Http\Controllers;

use App\Jobs\UserCsvProcess;
use App\Models\Branch;
use App\Models\Email;
use App\Models\Role;
use App\Models\SMSMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branches = Branch::where('active', true)->get();
        $roles = Role::where('active', true)->get();
        return view('admin.users.create')->with(['branches' => $branches, 'roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255',
            'role' => 'required',
            'type' => 'required'
        ]);

        //create password
        $password = 'password';

        //save user
        $users = User::create([
            "name" => $validated['name'],
            "username" => $validated['username'],
            "email" => $validated['email'],
            "phone" => $request->phone,
            "branch" => $request->branch,
            "role" => $validated['role'],
            "type" => $validated['type'],
            "description" => $request->description,
            "password" => Hash::make($password)
        ]);

        //send notification to user
        if ($request->email != null) {
            Email::create([
                'customer' => $request->name,
                'sent_to' => $request->email,
                'subject' => 'User Account Creation',
                'message' => 'Welcome to REALdoe, username: ' . $request->username . ' password: ' . $password,
                'sent' => false,
                'delivered' => false
            ]);
        }

        if ($request->phone != null) {
            SMSMessage::create([
                'sent_to' => $request->name,
                'phone' => $request->phone,
                'subject' => 'User Account Creation',
                'message' => 'Welcome to REALdoe, username: ' . $request->username . ' password: ' . $password,
            ]);
        }

        //return success
        return redirect()->to('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        return view('admin.users.import');
    }

    public function upload(Request $request)
    {
        if (request()->has('file')) {
            $data = file(request()->file);
            $chunks = array_chunk($data, 50);
            $header = [];
            $batch  = Bus::batch([])->dispatch();
            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);

                if ($key === 0) {
                    $header = $data[0];
                    unset($data[0]);
                }

                $batch->add(new UserCsvProcess($data, $header));
            }

            return redirect()->to('/users');
        }

        return 'please upload a file';
    }

    public function store_upload()
    {
        $path = resource_path('temp');
        $files = glob("$path/*.csv");

        $header = [];
        foreach ($files as $key => $file) {
            $data = array_map('str_getcsv', file($file));
            if ($key === 0) {
                $header = $data[0];
                unset($data[0]);
            }

            UserCsvProcess::dispatch($data, $header);

            unlink($file);
        }
        return 'stored';
    }

    public function batch()
    {
        $batchId = request('id');
        return Bus::findBatch($batchId);
    }

    public function batchInProgress()
    {
        $batches = DB::table('job_batches')->where('pending_jobs', '>', 0)->get();
        if (count($batches) > 0) {
            return Bus::findBatch($batches[0]->id);
        }

        return [];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $branches = Branch::where('active', true)->get();
        $roles = Role::where('active', true)->get();
        return view('admin.users.edit')->with(['user' => $user, 'branches' => $branches, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|max:255',
            'role' => 'required',
            'type' => 'required'
        ]);

        $active = false;
        $blocked = false;
        $short = false;
        if ($request->active == '1') {
            $active = true;
        } else {
            $active = false;
        }
        if ($request->block == '1') {
            $blocked = true;
        } else {
            $blocked = false;
        }
        if ($request->short == '1') {
            $short = true;
        } else {
            $short = false;
        }

        $user = User::where('id', $id)->update([
            "name" => $validated['name'],
            "username" => $validated['username'],
            "email" => $validated['email'],
            "phone" => $request->phone,
            "branch" => $request->branch,
            "role" => $validated['role'],
            "type" => $validated['type'],
            "description" => $request->description,
            'active' => $active,
            'blocked' => $blocked,
            'short' => $short
        ]);

        return redirect()->to('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
