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
