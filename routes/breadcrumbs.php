<?php // routes/breadcrumbs.php

  // Note: Laravel will automatically resolve `Breadcrumbs::` without
  // this import. This is nice for IDE syntax and refactoring.
  use Diglactic\Breadcrumbs\Breadcrumbs;

  // This import is also not required, and you could replace `BreadcrumbTrail $trail`
  //  with `$trail`. This is nice for IDE type checking and completion.
  use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

  // Dashboard
  Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
      $trail->push('Dashboard', route('dashboard.index'));
  });

  // Caetgories
  Breadcrumbs::for('categories', function (BreadcrumbTrail $trail) {
      $trail->parent('dashboard');
      $trail->push('Categories', route('categories.index'));
  });
  
  
  Breadcrumbs::for('categories_our', function (BreadcrumbTrail $trail) {
      $trail->parent('dashboard');
      $trail->push('Our Profile', route('categories.show','2'));
  });
  
   Breadcrumbs::for('categories_sus', function (BreadcrumbTrail $trail) {
      $trail->parent('dashboard');
      $trail->push('Sustainability', route('categories.show','3'));
  });
  
  Breadcrumbs::for('categories_ourimpact', function (BreadcrumbTrail $trail) {
      $trail->parent('dashboard');
      $trail->push('Our Impact', route('categories.show','4'));
  });
  
  Breadcrumbs::for('categories_plant', function (BreadcrumbTrail $trail) {
      $trail->parent('dashboard');
      $trail->push('Plant Tour', route('categories.show','5'));
  });
  
  Breadcrumbs::for('categories_product', function (BreadcrumbTrail $trail) {
      $trail->parent('dashboard');
      $trail->push('Product', route('categories.show','6'));
  });
  
  Breadcrumbs::for('categories_market', function (BreadcrumbTrail $trail) {
      $trail->parent('dashboard');
      $trail->push('market', route('categories.show','7'));
  });
  
  Breadcrumbs::for('categories_facilities', function (BreadcrumbTrail $trail) {
      $trail->parent('dashboard');
      $trail->push('Produk Facilities', route('categories.show','8'));
  });
  
  Breadcrumbs::for('categories_news', function (BreadcrumbTrail $trail) {
      $trail->parent('dashboard');
      $trail->push('News', route('categories.show','9'));
  });
  
  
  
  
  
  
  // Posts
  Breadcrumbs::for('posts', function (BreadcrumbTrail $trail) {
      $trail->parent('dashboard');
      $trail->push('Post', route('posts.index'));
  });

  // Caetgories
  Breadcrumbs::for('add_category', function (BreadcrumbTrail $trail) {
    $trail->parent('categories');
    $trail->push('add', route('categories.create'));
  });

  // Caetgories edit
  Breadcrumbs::for('edit_category', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories');
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_category_our', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_our');
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_category_sus', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_sus');
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_category_ourimpact', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_ourimpact');
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_category_plant', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_plant');
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_category_product', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_product');
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_category_market', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_market');
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_category_facilities', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_facilities');
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_category_news', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_news');
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  
  
  // Post edit
  Breadcrumbs::for('edit_post_banner', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('sliders');
    $trail->push('Post', route('posts.details',['1']));
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_post_news', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_news');
    $trail->push('Post', route('posts.details',['9']));
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_post_ourimpact', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_ourimpact');
    $trail->push('Post', route('posts.details',['4']));
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_post_plant', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_plant');
    $trail->push('Post', route('posts.details',['5']));
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_post_product', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_product');
    $trail->push('Post', route('posts.details',['6']));
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_post_market', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_market');
    $trail->push('Post', route('posts.details',['7']));
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  
  Breadcrumbs::for('edit_post_facilities', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('categories_facilities');
    $trail->push('Post', route('posts.details',['8']));
    $trail->push('Edit', route('categories.edit',['category' => $category]));
  });
  



   // Dashboard > Slider
   Breadcrumbs::for('sliders', function (BreadcrumbTrail $trail) {
       $trail->parent('dashboard');
       $trail->push('Slider', route('sliders.index'));
   });
   
//   Breadcrumbs::for('news', function (BreadcrumbTrail $trail,$postId) {
//       $trail->parent('dashboard');
//       $trail->push('News',  route('posts.details',[$postId]));
//   });
   
   // Sliders edit
  Breadcrumbs::for('edit_slider', function (BreadcrumbTrail $trail,$slider) {
    $trail->parent('sliders');
    $trail->push('Edit', route('sliders.edit',['slider' => $slider]));
  });
  Breadcrumbs::for('posts_slider', function (BreadcrumbTrail $trail,$postId) {
    $trail->parent('sliders');
    $trail->push('Post', route('posts.details',[$postId]));
  });
  
  Breadcrumbs::for('posts_profile', function (BreadcrumbTrail $trail,$postId) {
    $trail->parent('dashboard');
    $trail->push('Our Profile', route('posts.details',[$postId]));
  });
  
  Breadcrumbs::for('posts_sustainabilty', function (BreadcrumbTrail $trail,$postId) {
    $trail->parent('dashboard');
    $trail->push('Sustainabilty', route('posts.details',[$postId]));
  });
  
  Breadcrumbs::for('posts_ourimpact', function (BreadcrumbTrail $trail,$postId) {
    $trail->parent('dashboard');
    $trail->push('Our Impact', route('posts.details',[$postId]));
  });
  
  Breadcrumbs::for('posts_news', function (BreadcrumbTrail $trail,$postId) {
    $trail->parent('categories_news');
    $trail->push('post', route('posts.details',[$postId]));
  });
  
  Breadcrumbs::for('posts_plant', function (BreadcrumbTrail $trail,$postId) {
    $trail->parent('dashboard');
    $trail->push('Plant Tour', route('posts.details',[$postId]));
  });
  
  Breadcrumbs::for('posts_product', function (BreadcrumbTrail $trail,$postId) {
    $trail->parent('dashboard');
    $trail->push('Product', route('posts.details',[$postId]));
  });
  
  Breadcrumbs::for('posts_market', function (BreadcrumbTrail $trail,$postId) {
    $trail->parent('dashboard');
    $trail->push('Market', route('posts.details',[$postId]));
  });
  
  Breadcrumbs::for('posts_facilities', function (BreadcrumbTrail $trail,$postId) {
    $trail->parent('dashboard');
    $trail->push('Facilities', route('posts.details',[$postId]));
  });
  
  

  // // Home > Blog > [Category]
  // Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
  //     $trail->parent('blog');
  //     $trail->push($category->title, route('category', $category));
  // });