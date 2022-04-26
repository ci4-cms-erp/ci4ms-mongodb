<?php

namespace App\Controllers\templates\default;

use App\Controllers\BaseController;
use Melbahja\Seo\Ping;
use Melbahja\Seo\Sitemap;

class Seo extends BaseController
{
    public function index()
    {
        $sitemap = new Sitemap(base_url('sitemapsXML'), ['save_path' => ROOTPATH . 'public/sitemapsXML']);
        $sitemap->setIndexName('sitemaps.xml');
        $sitemap->links(['name' => 'pages.xml', 'images' => true],
            function ($map) {
                $pages = $this->commonModel->getList('pages', ['isActive' => true]);
                foreach ($pages as $page) {
                    $map->loc($page->seflink)->freq('daily')->priority('0.8');
                    if (!empty($page->seo->coverImage))
                        $map->image($page->seo->coverImage, ['caption' => $page->title]);
                }
            });

        if ($this->commonModel->count('blog', ['isActive' => true]) > 0) {
            $sitemap->links('posts.xml', function ($map) {
                $blogs = $this->commonModel->getList('blog', ['isActive' => true]);
                foreach ($blogs as $blog) {
                    $map->loc("blog/{$blog->seflink}")->freq('weekly')->priority('0.7');
                }
            });
            $sitemap->links('categories.xml', function ($map) {
                $blogs = $this->commonModel->getList('kun_categories', ['isActive' => true]);
                foreach ($blogs as $blog) {
                    $map->loc("category/{$blog->seflink}")->freq('weekly')->priority('0.7');
                }
            });
        }

        if ($sitemap->save() === true) {
            $ping = new Ping();

// the void method send() will inform via CURL: google, bing and yandex about your new file
            $ping->send(base_url('sitemapsXML/sitemaps.xml'));
            return redirect()->to('/sitemapsXML/sitemaps.xml');
        } else
            return show_404();
    }

}
