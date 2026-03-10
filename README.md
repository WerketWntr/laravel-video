Laravel Video Platform
>This project is currently under development.

An educational project: video hosting platform built with Laravel, Livewire, and MaryUI. Upload, encode, and stream videos with multi-quality support.

Features

- Video Upload — chunk-based upload with progress tracking
- Video Encoding — automatic multi-quality encoding (360p, 720p, 1080p, 2160p) via FFmpeg
- Thumbnail Generation — automatic thumbnail extraction from video
- Video Player — Plyr.js player with quality switching and preview thumbnails
- Search — full-text search with live suggestions powered by Laravel Scout
- Likes & Dislikes — authenticated users can rate videos
- View Tracking — unique view counting per video
- User Channels — each user has a public channel page
- Scheduled Publishing — set a future date for video to go live
- Authentication — registration, login, profile management via Laravel Jetstream

Tech Stack

Laravel 10, PHP 8.3, Livewire, AlpineJS, MaryUI, DaisyUI, Tailwind CSS, FFmpeg, Laravel Scout, Laravel Queue, MySQL, Upload(pion/laravel-chunk-upload)

Install dependencies

1. composer install
2. npm install
3. cp .env.example .env
4. php artisan key:generate
5. Edit .env:
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

FFMPEG_BINARIES=/usr/bin/ffmpeg
FFPROBE_BINARIES=/usr/bin/ffprobe
6.php artisan migrate
7. php artisan storage:link
8. npm run dev
9. php artisan serve
10. php artisan queue:work
