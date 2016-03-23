<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Person;

class PersonController extends Controller
{
    public function index() {
        $person = Person::where('id','>=','1')->orderBy('id', 'desc')->paginate(5);
        return view('person.index', compact('person'));
    }

    public function edit($id) {
        $person = Person::find($id);

        $data = [
            'person' => $person,
        ];

        return view('person.edit', compact('data'));
    }

    public function edit_submit() {

        $data = \Request::all();

        $person = Person::find($data['person_id']);
        $person->name = $data['name'];
        $person->email = $data['email'];
        $person->admin_yn = isset($data['auth_admin'])?'Y':'N';
        $person->salesman_yn = isset($data['auth_salesman'])?'Y':'N';
        $person->client_yn = isset($data['auth_client'])?'Y':'N';

        if (isset($data['image'])) {
            $res = \Common::s3_upload($data['image'],'person/');
            if ($res['success']) {
                $person->image = $res['filename'];
            }
        }

        $person->save();

        return \Redirect()->action('PersonController@index');
    }

    public function profile() {

        $person = Person::find(\Auth::user()->id);

        $data = [
            'person' => $person,
        ];

        return view('person.profile', compact('data'));
    }

    public function profile_submit() {

        $data = \Request::all();

        if (isset($data['image'])) {
            $res = \Common::s3_upload($data['image'],'person/');

            if ($res['success']) {
                $person = Person::find(\Auth::user()->id);
                $person->image = $res['filename'];
                $person->save();
            }
        }

        return \Redirect()->action('PersonController@profile');
    }
}

