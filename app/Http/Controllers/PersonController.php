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

        \Log::info(\Input::get());

        $person = Person::find(\Input::get('person_id'));
        $person->name = \Input::get('name');
        $person->email = \Input::get('email');
        $person->admin_yn = \Input::get('auth_admin')?'Y':'N';
        $person->salesman_yn = \Input::get('auth_salesman')?'Y':'N';
        $person->client_yn = \Input::get('auth_client')?'Y':'N';
        $person->save();

        return \Redirect()->action('PersonController@index');
    }
}

