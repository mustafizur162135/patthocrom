<?php

namespace App\Http\Controllers\Backend\class;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ClassNamController;
use App\Http\Requests\ClassNameRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class ClassnameController extends Controller
{
    private $classNamApiController;

    public function __construct(ClassNamController $classNamApiController)
    {
        $this->classNamApiController = $classNamApiController;
    }

    public function index()
    {
        // ...

        try {
            $className = $this->classNamApiController->index();
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve roles and className.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve roles and className.');
        }

        if (!($className instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $className is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve roles and className.');
        }


        $responseData = $className->getData();
    if (property_exists($responseData, 'classes')) {
        $classes = collect($responseData->classes);

        $classes = collect($className->getData()->classes);
        $status = $className->getData()->status;
        $message = $className->getData()->message;
        if ($status == 404) {
            return back()->with('error', $message);
        }

        // This is my api how to get value
        $classes = $classes->map(function ($class) {
            return [
                'id' => $class->id,
                'class_name' => $class->class_name,
                'class_code' => $class->class_code
            ];
        });

        return view('backend.class.index',compact('classes'));

    } else {
        // Data doesn't exist or the property is not present.
        echo "Data not found";
        
    }
       
       
    }

    public function create(){
        
        try {
            $className = $this->classNamApiController->create();
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve className.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve className.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to retrieve className.');
        }

        if (!($className instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $className is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve className.');
        }

         
        $status = $className->getData()->status;
        $message = $className->getData()->message;
        if ($status == 404) {
            return back()->with('error', $message);
        } elseif ($status == 500) {
            return back()->with('error', $message);
        }

        return view('backend.class.form');
    }


    public function store(Request $request)
    {

        // return $request;
        $class = new ClassNameRequest([
            'class_name' => $request->input('class_name'),
            'class_code' => $request->input('class_code'),
            'class_note' => $request->input('class_note')
        ]);

        try {
            $apiResponse = $this->classNamApiController->store($class);
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to create className.');
        } 
        catch (\Exception $e) {
            return back()->with('error', 'Failed to create className.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to create className.');
        }


        if ($apiResponse->getStatusCode() === 200) {
            return back()->with('success', 'Class created successfully.');
        } elseif ($apiResponse->getStatusCode() === 500) {
            return back()->with('error', 'Failed to create className.');
        } else {
            return back()->with('error', 'Failed to create className.');
        }
    }

    public function edit($id)
    {

        try {
            $apiResponse = $this->classNamApiController->edit($id);
           
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve className.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve className.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to retrieve className.');
        }
        if (!($apiResponse instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $apiResponse is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve className.');
        }

         $class = $apiResponse->getData()->class;
        
        $status = $apiResponse->getData()->status;
        $message = $apiResponse->getData()->message;
        if ($status == 404) {
            return back()->with('error', $message);
        } elseif ($status == 500) {
            return back()->with('error', $message);
        }
        return view('backend.class.form', compact('class'));
    }

    public function update(Request $request,$id)
    {
        

        $class = new ClassNameRequest([
            'class_name' => $request->input('class_name'),
            'class_code' => $request->input('class_code'),
            'class_note' => $request->input('class_note')
        ]);


        try {
            $apiResponse = $this->classNamApiController->update($class,$id);
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to updateclassName.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to updateclassName.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to updateclassName.');
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
        $apiResponse = $this->classNamApiController->delete($id);
        
        $responseData = $apiResponse->getData();
        $status = $apiResponse->getStatusCode();

        if ($status === 200) {
            return back()->with('success', $responseData->message);
        } else {
            return back()->with('error', $responseData->message);
        }
    } catch (HttpResponseException $e) {
        return back()->with('error', 'Failed to delete className.');
    } catch (\Exception $e) {
        return back()->with('error', 'Failed to delete className.');
    } catch (\Throwable $th) {
        return back()->with('error', 'Failed to delete className.');
    }
}

}
