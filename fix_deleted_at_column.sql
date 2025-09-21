-- Fix the deleted_at column to allow NULL values properly
-- This script will modify the deleted_at column to ensure it can be set to NULL

-- First, let's check the current structure
DESCRIBE students;

-- Modify the deleted_at column to ensure it allows NULL values
ALTER TABLE students MODIFY COLUMN deleted_at DATETIME NULL DEFAULT NULL;

-- Verify the change
DESCRIBE students;

-- Test by setting a deleted_at value to NULL
UPDATE students SET deleted_at = NULL WHERE id = 21;

-- Check if the update worked
SELECT id, first_name, last_name, deleted_at FROM students WHERE id = 21;
