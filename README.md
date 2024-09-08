// Fetch all students from the database
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

// Store a new student record in the database
public function store(Request $request){
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

// Fetch a specific student by ID
public function show($id) {
    $student = student::find($id);
    // Check if the student exists
    if ($student) {
        // Return success response with student data
        return response()->json([
            'status' => 200,
            'student' => $student
        ], 200);
    } else {
        // Return error if student not found
        return response()->json([
            'status' => 404,
            'message' => 'No Such Student Record Found!'
        ], 404);
    }
}

// Update a specific student record by ID
public function update(Request $request, int $id) {
    // Validate the incoming request data
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
    }  else {
        // Find the student by ID
        $student = student::find($id);

        // If student exists, update the record
        if ($student) {
            $student->update([
                'name' => $request->name,
                'age' => $request->age,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            // Return success response
            return response()->json([
                'status' => 200,
                'message' => 'Student Updated Successfully!'
            ], 200);
        } else {
            // Return error if student not found
            return response()->json([
                'status' => 404,
                'message' => 'No Such Student Record Found!!'
            ], 404);
        }
    }
}

// Delete a specific student record by ID
public function destroy($id) {
    // Find the student by ID
    $student = student::find($id);

    // If student exists, delete the record
    if ($student) {
        $student->delete();
        // Return success response
        return response()->json([
            'status' => 200,
            'message' => 'Student Record Deleted Successfully!'
        ], 200);
    } else {
        // Return error if student not found
        return response()->json([
            'status' => 404,
            'message' => 'No Such Student Record Found'
        ], 404);
    }
}
