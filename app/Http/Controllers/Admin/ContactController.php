<?php

namespace App\Http\Controllers\Admin; 
use App\Http\Controllers\Controller; 


use DataTables;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;

use App\Exports\ContactExport;
use Alert;

class ContactController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) 
        {
            $data = Contact::select('*');
            return Datatables::of($data)
                        ->addIndexColumn()
                        ->make(true);
        }
        return view('admin.contact.index');
    }

    public function export(Request $request) 
    {
        return Excel::download(new ContactExport($request->slug), 'leads.xlsx');
    }
}
 
