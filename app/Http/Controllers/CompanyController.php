<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Company;

class CompanyController extends Controller
{
    public function index() {
        $company = Company::where('id','>=','1')->orderBy('id', 'desc')->paginate(5);
        return view('company.index', compact('company'));
    }

    public function create() {
        return view('company.create');
    }

    public function create_submit() {

        $company = new Company();
        $company->name = \Request::input('name');
        $company->status = 'Y';
        $company->save();

        return \Redirect()->action('CompanyController@index');
    }

    public function edit($id) {
        $company = Company::find($id);

        $data = [
            'company' => $company,
        ];

        return view('company.edit', compact('data'));
    }

    public function edit_submit() {

        $company = Company::find(\Request::input('company_id'));
        $company->name = \Request::input('name');
        $company->status = \Request::input('status_group');
        $company->save();

        return \Redirect()->action('CompanyController@index');
    }
}

