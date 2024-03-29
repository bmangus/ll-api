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
        $body = $request->getContent();
        $ip = $request->header('X-FORWARDED-FOR');
        $record = new FormSubmission();
        $record->body = $body;
        $record->formName = $formName ?? 'unknown';
        $record->sourceIP = $ip ?? 'unknown';
        $record->save();
    }

    public function deleteForms($formName)
    {
        $records = $this->getAllFormsByName($formName);
        $records->each(function($f){
            $f->delete();
        });
        return response('done');
    }

    private function getAllFormsByName($fn)
    {
        return FormSubmission::where('formName', $fn)->get();
    }

}
