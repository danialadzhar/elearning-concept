<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class CourseController extends Controller
{
    public function show(int $id)
    {
        // Data kursus contoh - boleh diganti dengan query pangkalan data
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
            'course' => $course,
        ]);
    }
}
