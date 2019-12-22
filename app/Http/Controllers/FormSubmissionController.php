<?php

namespace App\Http\Controllers;

use App\FormSubmission;
use Illuminate\Http\Request;

class FormSubmissionController extends Controller
{
    public function index($formName)
    {
       return FormSubmission::where('formName', $formName)->get();
    }

    public function post(Request $request, $formName = null)
    {
        $body = $request->get('body');
        $ip = $request->header('x-forwareded-for');
        $record = new FormSubmission();
        $record->body = $body;
        $record->formName = $formName ?? 'unknown';
        $record->sourceIP = $ip;
        $record->save();
    }

    public function deleteForms($formName)
    {
        $records = $this->getAllFormsByName($formName);
        $records->each(function($f){
            $f->destroy();
        });
        return response('done');
    }

    private function getAllFormsByName($fn)
    {
        return FormSubmission::where('formName', $fn)->get();
    }

}
