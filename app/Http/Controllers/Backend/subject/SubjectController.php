<?php

namespace App\Http\Controllers\Backend\subject;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\SubjectNamController;
use App\Http\Requests\SubjectNameRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    private $SubjectNamApiController;

    public function __construct(SubjectNamController $SubjectNamApiController)
    {
        $this->SubjectNamApiController = $SubjectNamApiController;
    }

    public function index()
    {
        // ...

        try {
            $subjectName = $this->SubjectNamApiController->index();
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve roles and subjectName.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve roles and subjectName.');
        }

        if (!($subjectName instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $subjectName is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve roles and subjectName.');
        }


        $responseData = $subjectName->getData();
    if (property_exists($responseData, 'subjects')) {
        $subjects = collect($responseData->subjects);

        $subjects = collect($subjectName->getData()->subjects);
        $status = $subjectName->getData()->status;
        $message = $subjectName->getData()->message;
        if ($status == 404) {
            return back()->with('error', $message);
        }

        // This is my api how to get value
        $subjects = $subjects->map(function ($subject) {
            return [
                'id' => $subject->id,
                'sub_name' => $subject->sub_name,
                'sub_code' => $subject->sub_code
            ];
        });

        return view('backend.subject.index',compact('subjects'));

    } else {
        // Data doesn't exist or the property is not present.
        echo "Data not found";
        
    }
       
       
    }

    public function create(){
        
        try {
            $subjectName = $this->SubjectNamApiController->create();
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve subjectName.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve subjectName.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to retrieve subjectName.');
        }

        if (!($subjectName instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $subjectName is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve subjectName.');
        }

        $classes = collect($subjectName->getData()->classes);
        $status = $subjectName->getData()->status;
        $message = $subjectName->getData()->message;
        if ($status == 404) {
            return back()->with('error', $message);
        } elseif ($status == 500) {
            return back()->with('error', $message);
        }

        return view('backend.subject.form', compact('classes'));
    }


    public function store(Request $request)
    {

        // return $request;
        $subject = new SubjectNameRequest([
            'class_id' => $request->input('class_id'),
            'sub_name' => $request->input('sub_name'),
            'sub_code' => $request->input('sub_code'),
            'sub_note' => $request->input('sub_note')
        ]);

        try {
            $apiResponse = $this->SubjectNamApiController->store($subject);
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to create subjectName.');
        } 
        catch (\Exception $e) {
            return back()->with('error', 'Failed to create subjectName.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to create subjectName.');
        }


        if ($apiResponse->getStatusCode() === 200) {
            return back()->with('success', 'Class created successfully.');
        } elseif ($apiResponse->getStatusCode() === 500) {
            return back()->with('error', 'Failed to create subjectName.');
        } else {
            return back()->with('error', 'Failed to create subjectName.');
        }
    }

    public function edit($id)
    {

        try {
            $apiResponse = $this->SubjectNamApiController->edit($id);
           
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve subjectName.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve subjectName.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to retrieve subjectName.');
        }
        if (!($apiResponse instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $apiResponse is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve subjectName.');
        }

        $classes = collect($apiResponse->getData()->classes);

         $subject = $apiResponse->getData()->subject;
        
        $status = $apiResponse->getData()->status;
        $message = $apiResponse->getData()->message;
        if ($status == 404) {
            return back()->with('error', $message);
        } elseif ($status == 500) {
            return back()->with('error', $message);
        }
        return view('backend.subject.form', compact('subject','classes'));
    }

    public function update(Request $request,$id)
    {
        

        $subject = new SubjectNameRequest([
            'class_id' => $request->input('class_id'),
            'sub_name' => $request->input('sub_name'),
            'sub_code' => $request->input('sub_code'),
            'sub_note' => $request->input('sub_note')
        ]);


        try {
            $apiResponse = $this->SubjectNamApiController->update($subject,$id);
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to update subjectName.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update subjectName.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to update subjectName.');
        }


        if ($apiResponse->getStatusCode() === 200) {
            return back()->with('success', 'Class updated successfully.');
        } elseif ($apiResponse->getStatusCode() === 500) {
            return back()->with('error', 'Failed to updateclassName.');
        } else {
            return back()->with('error', 'Failed to updateclassName.');
        }
    }

    public function delete($id)
    {
        try {
            $apiResponse = $this->SubjectNamApiController->delete($id);
            
            $responseData = $apiResponse->getData();
            $status = $apiResponse->getStatusCode();
    
            if ($status === 200) {
                return back()->with('success', $responseData->message);
            } else {
                return back()->with('error', $responseData->message);
            }
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to delete subjectName.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete subjectName.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to delete subjectName.');
        }
    }
}
