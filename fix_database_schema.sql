-- Fix database schema for soft delete functionality
-- This script will ensure the deleted_at column works properly

-- First, let's check the current structure
DESCRIBE students;

-- Drop any existing indexes on deleted_at that might be causing issues
ALTER TABLE students DROP INDEX IF EXISTS idx_deleted_at;

-- Modify the deleted_at column to ensure it allows NULL values properly
ALTER TABLE students MODIFY COLUMN deleted_at DATETIME NULL DEFAULT NULL;

-- Recreate the index for better performance
ALTER TABLE students ADD INDEX idx_deleted_at (deleted_at);

-- Test by setting a deleted_at value to NULL
UPDATE students SET deleted_at = NULL WHERE deleted_at IS NOT NULL;

-- Check if the update worked
SELECT id, first_name, last_name, deleted_at FROM students WHERE deleted_at IS NULL LIMIT 5;

-- Show all students with their deleted_at status
SELECT id, first_name, last_name, deleted_at, 
       CASE WHEN deleted_at IS NULL THEN 'Active' ELSE 'Soft Deleted' END as status
FROM students 
ORDER BY deleted_at DESC;
