<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeAllViews extends Command
{
    protected $signature = 'make:all-views';
    protected $description = 'Create all blade views for EQUALITY website';

    public function handle()
    {
        $views = [
            'home',
            'about', 
            'contact',
            'products.index',
            'products.show',
            'articles.index',
            'articles.show',
            'partials.header',
            'partials.footer',
            'partials.product-card',
            'admin.layouts.app',
            'admin.dashboard.index',
            'admin.products.index',
            'admin.products.create',
            'admin.products.edit',
            'admin.products.show',
            'admin.categories.index',
            'admin.categories.create',
            'admin.categories.edit',
            'admin.banners.index',
            'admin.banners.create',
            'admin.banners.edit',
            'admin.testimonials.index',
            'admin.testimonials.create',
            'admin.testimonials.edit',
            'admin.articles.index',
            'admin.articles.create',
            'admin.articles.edit',
            'admin.stock.index',
            'admin.stock.history',
            'admin.gallery.index',
            'admin.about.index',
            'admin.contact.index',
        ];

        foreach ($views as $view) {
            $path = resource_path('views/' . str_replace('.', '/', $view) . '.blade.php');
            $directory = dirname($path);
            
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }
            
            if (!File::exists($path)) {
                File::put($path, "{{-- View: {$view} --}}\n\n@section('content')\n    <h1>{{ \$title ?? '{$view}' }}</h1>\n@endsection");
                $this->info("Created: {$view}");
            } else {
                $this->warn("Exists: {$view}");
            }
        }
        
        $this->info('All views created successfully!');
    }
}