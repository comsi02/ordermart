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

        $person = Person::find(\Request::get('person_id'));
        $person->name = \Request::get('name');
        $person->email = \Request::get('email');
        $person->admin_yn = \Request::get('auth_admin')?'Y':'N';
        $person->salesman_yn = \Request::get('auth_salesman')?'Y':'N';
        $person->client_yn = \Request::get('auth_client')?'Y':'N';
        $person->save();

        return \Redirect()->action('PersonController@index');
    }
}

