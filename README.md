## API Endpoints

### Fetch all students from the database

```php
public function index() {
    $students = student::all();
    // Check if there are any student records
    if ($students->count() > 0) {
        // Return success response with student data
        return response()->json([
            'status' => 200,
            'Students' => $students
        ], 200);
    } else {
        // Return "No Records Found" if no students exist
        return response()->json([
            'status' => 404,
            'Students' => 'No Records Found'
        ], 404);
    }
}

####Store a new student record in the database
```public function store(Request $request){
    // Validate incoming request data
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:200',
        'age' => 'required|integer|max:200',
        'course' => 'required|string|max:150',
        'email' => 'required|email|max:200',
        'phone' => 'required|digits:11'
    ]);

    // If validation fails, return error response
    if($validator->fails()){
        return response()->json([
            'status' => 422,
            'error' => $validator->messages()
        ], 422);
    } else {
        // If validation passes, create a new student record
        $students = student::create([
            'name' => $request->name,
            'age' => $request->age,
            'course' => $request->course,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Check if the student record was created successfully
        if($students){
            // Return success response
            return response()->json([
                'status' => 200,
                'message' => 'Student Added Successfully!'
            ], 200);
        } else {
            // Return error response if something goes wrong
            return response()->json([
                'status' => 500,
                'message' => 'Something Went Wrong!'
            ], 500); // Corrected status code for server error
        }
    }
}

