@echo off
php artisan make:controller Admin/CourseController
php artisan make:controller Admin/LessonController
php artisan make:model Admin/Course
php artisan make:model Admin/Lesson
pause;