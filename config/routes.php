<?php 

return [
    'post' => '{slug}/{hashableId}',
    'search' => 'search',
    'searchPostsByUserId' => 'users/{id}/ads',
    'searchPostsByUsername' => 'profile/{username}',
    'searchPostsByTag' => 'tag/{tag}',
    //'searchPostsByCity' => 'location/{city}/{id}',
    'searchPostsByCity' => 'call-girls/{city}/{id}',
    'searchPostsBySubCat' => 'category/{catSlug}/{subCatSlug}',
    'searchPostsByCat' => 'category/{catSlug}',
    'searchPostsByCompanyId' => 'companies/{id}/ads',
    'login' => 'login',
    'logout' => 'logout',
    'register' => 'register',
    'companies' => 'companies',
    'pageBySlug' => 'page/{slug}',
    'sitemap' => 'sitemap',
    'countries' => 'countries',
    'contact' => 'contact',
    'pricing' => 'pricing',
];
