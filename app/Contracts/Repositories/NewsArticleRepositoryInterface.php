<?php

namespace App\Contracts\Repositories;

interface NewsArticleRepositoryInterface
{
    public function getArticles(array $data, $session);

    public function categories();

    public function authors();
}