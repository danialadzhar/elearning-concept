<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/course/{id}', function ($id) {
    // Sample course data - nanti boleh tukar dengan data dari database
    $courses = [
        1 => [
            'id' => 1,
            'title' => 'Design Strategy',
            'description' => 'Lesson on planning a design concept and proper planning of work',
            'tags' => ['UX/UI Design', 'Web Design'],
            'startDate' => 'May 5',
            'rating' => '4.0',
            'views' => '3k, 009 rating',
        ],
        2 => [
            'id' => 2,
            'title' => 'English lecture',
            'description' => 'Language lessons with the most popular teachers',
            'tags' => ['Languages'],
            'startDate' => 'May 8',
            'rating' => '5.0',
            'views' => '3k, 009 rating',
        ],
        3 => [
            'id' => 3,
            'title' => 'Business lecture',
            'description' => 'Lecture on how to build your business using various new projects',
            'tags' => ['Marketing', 'Finance'],
            'startDate' => 'May 8',
            'rating' => '4.0',
            'views' => '3k, 009 rating',
        ],
    ];

    $course = $courses[$id] ?? $courses[1];

    return Inertia::render('CourseLearning', [
        'course' => $course
    ]);
})->middleware(['auth', 'verified'])->name('course.learn');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
