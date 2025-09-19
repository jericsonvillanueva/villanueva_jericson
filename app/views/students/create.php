<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'modern': ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-900 via-gray-900 to-black font-modern">
    <!-- Navigation -->
    <nav class="bg-black/20 backdrop-blur-sm border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-8">
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                        STUDENT PORTAL
                    </h1>
                    <div class="hidden md:flex space-x-6">
                        <a href="<?php echo site_url('students'); ?>" class="text-gray-400 hover:text-blue-400 transition-colors font-medium">HOME</a>
                        <a href="#" class="text-white hover:text-blue-400 transition-colors font-medium">ADD STUDENT</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="mb-12">
            <div class="flex items-center mb-6">
                <a href="<?php echo site_url('students'); ?>" 
                   class="inline-flex items-center text-gray-400 hover:text-white transition-colors mr-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Students
                </a>
            </div>
            
            <h1 class="text-5xl lg:text-6xl font-bold text-white mb-4 tracking-tight">
                ADD NEW
                <span class="block bg-gradient-to-r from-green-400 via-blue-400 to-purple-400 bg-clip-text text-transparent">
                    STUDENT
                </span>
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl leading-relaxed">
                Register a new student in the system by filling out the information below.
                All fields are required for successful registration.
            </p>
        </div>

        <!-- Form Container -->
        <div class="bg-white/5 backdrop-blur-sm rounded-2xl border border-gray-800 overflow-hidden shadow-2xl">
            <div class="px-8 py-6 border-b border-gray-800">
                <h2 class="text-2xl font-semibold text-white">Student Information</h2>
                <p class="text-gray-400 mt-1">Enter the details for the new student</p>
            </div>
            
            <div class="p-8">
                <form method="post" action="<?php echo site_url('students/create'); ?>" class="space-y-8">
                    <!-- Last Name Field -->
                    <div class="group">
                        <label for="lastname" class="block text-sm font-semibold text-gray-300 mb-3 uppercase tracking-wider">
                            Last Name *
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="lastname"
                                name="lastname" 
                                required
                                class="w-full px-4 py-4 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-600"
                                placeholder="Enter student's last name"
                            >
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-blue-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                        </div>
                    </div>

                    <!-- First Name Field -->
                    <div class="group">
                        <label for="firstname" class="block text-sm font-semibold text-gray-300 mb-3 uppercase tracking-wider">
                            First Name *
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="firstname"
                                name="firstname" 
                                required
                                class="w-full px-4 py-4 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-600"
                                placeholder="Enter student's first name"
                            >
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-blue-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="group">
                        <label for="email" class="block text-sm font-semibold text-gray-300 mb-3 uppercase tracking-wider">
                            Email Address *
                        </label>
                        <div class="relative">
                            <input 
                                type="email" 
                                id="email"
                                name="email" 
                                required
                                class="w-full px-4 py-4 bg-gray-800/50 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 hover:border-gray-600"
                                placeholder="Enter student's email address"
                            >
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-blue-500/20 to-purple-500/20 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-8">
                        <button 
                            type="submit"
                            class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-green-500 to-blue-600 hover:from-green-600 hover:to-blue-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Save Student
                        </button>
                        
                        <a 
                            href="<?php echo site_url('students'); ?>"
                            class="flex-1 sm:flex-none inline-flex items-center justify-center px-8 py-4 bg-gray-700/50 hover:bg-gray-600/50 text-gray-300 hover:text-white font-semibold rounded-xl border border-gray-600 hover:border-gray-500 transition-all duration-200"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Background Elements -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-green-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-xl opacity-10 animate-pulse"></div>
    </div>
</body>
</html>