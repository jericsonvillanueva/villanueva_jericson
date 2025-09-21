<?php
// Test script to debug soft delete issues
require_once 'index.php';

echo "<h2>Testing Soft Delete Functionality</h2>";

// Test 1: Check if soft delete is working
echo "<h3>1. Testing Soft Delete</h3>";
$student_model = new Student_model();

// Get a student to test with
$students = $student_model->get_all_students();
if (!empty($students)) {
    $test_student = $students[0];
    echo "Testing with student ID: " . $test_student['id'] . "<br>";
    
    // Try soft delete
    $result = $student_model->soft_delete($test_student['id']);
    echo "Soft delete result: " . ($result ? 'SUCCESS' : 'FAILED') . "<br>";
    
    // Check if student is now soft deleted
    $deleted_students = $student_model->get_soft_deleted_students();
    echo "Soft deleted students count: " . count($deleted_students) . "<br>";
    
    // Try to restore
    if (!empty($deleted_students)) {
        $restore_result = $student_model->restore($test_student['id']);
        echo "Restore result: " . ($restore_result ? 'SUCCESS' : 'FAILED') . "<br>";
    }
} else {
    echo "No students found to test with<br>";
}

// Test 2: Check database directly
echo "<h3>2. Direct Database Test</h3>";
try {
    // Try to update deleted_at to NULL directly
    $sql = "UPDATE students SET deleted_at = NULL WHERE id = ?";
    $result = $student_model->raw($sql, [1]);
    echo "Direct NULL update: SUCCESS<br>";
} catch (Exception $e) {
    echo "Direct NULL update failed: " . $e->getMessage() . "<br>";
}

// Test 3: Check current soft deleted records
echo "<h3>3. Current Soft Deleted Records</h3>";
$deleted = $student_model->get_soft_deleted_students();
foreach ($deleted as $record) {
    echo "ID: " . $record['id'] . ", Name: " . $record['first_name'] . " " . $record['last_name'] . ", Deleted At: " . $record['deleted_at'] . "<br>";
}

// Test 4: Try to restore all soft deleted records
echo "<h3>4. Attempting to Restore All Soft Deleted Records</h3>";
foreach ($deleted as $record) {
    echo "Attempting to restore student ID: " . $record['id'] . " (Name: " . $record['first_name'] . " " . $record['last_name'] . ")<br>";
    $restore_result = $student_model->restore($record['id']);
    echo "Restore ID " . $record['id'] . ": " . ($restore_result ? 'SUCCESS' : 'FAILED') . "<br>";
    
    // Check if the record was actually restored
    $check_restored = $student_model->get_student_with_deleted($record['id']);
    if ($check_restored && is_null($check_restored['deleted_at'])) {
        echo "✓ Confirmed: Student " . $record['id'] . " is now active<br>";
    } else {
        echo "✗ Failed: Student " . $record['id'] . " is still soft deleted<br>";
    }
    echo "<br>";
}
?>
