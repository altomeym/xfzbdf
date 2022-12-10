<?php

use App\Http\Controllers\Selling;
use App\Http\Controllers\Storefront;
use Illuminate\Support\Facades\Route;

// Route for storefront
Route::middleware('storefront')
    ->namespace('Storefront')->group(function () {

        Route::get('page/{page}', [Storefront\HomeController::class, 'openPage'])
        ->name('page.open');

        // Newsletter
        Route::post('newsletter', [Storefront\NewsletterController::class, 'subscribe'])
            ->name('newsletter.subscribe');

        // Chat
        include 'storefront/Chat.php';

        // Auth route for customers
        include 'storefront/Auth.php';
        include 'storefront/Cart.php';
        include 'storefront/Order.php';
        include 'storefront/GiftCard.php';

        Route::middleware(['auth:customer'])
            ->group(function () {
                include 'storefront/Account.php';
                include 'storefront/Feedback.php';

                // Conversations
                Route::post('contact/{slug}', [Storefront\ConversationController::class, 'contact'])
                    ->name('seller.contact');

                Route::get('message/{message}/archive', [Storefront\ConversationController::class, 'archive'])
                    ->name('message.archive');

                Route::get('my/message/{message}', [Storefront\ConversationController::class, 'show'])
                    ->name('message.show');

                Route::post('message/{message}', [Storefront\ConversationController::class, 'reply'])
                    ->name('message.reply');
            });

        Route::get('/', [Storefront\HomeController::class, 'index'])
            ->name('homepage');

        
        // start added by hassan00942 + guideleads00942
        Route::get('guide-leads', [Storefront\HomeController::class, 'guide_leads'])
            ->name('guide-leads');

        Route::post('guide-lead/step1/captcha-verify', [Storefront\HomeController::class, 'guide_lead_capthca_verify'])
            ->name('guide-lead.captcha-verify');
        
        Route::get('guide-lead/step2/book-my-consultation', [Storefront\HomeController::class, 'guide_lead_book_my_consultation'])
            ->name('guide-lead.book-my-consultation');
        
        Route::get('guide-lead/step3/thank-you', [Storefront\HomeController::class, 'guide_lead_thank_you'])
            ->name('guide-lead.thank-you');
            
        Route::get('guide-lead/{slug}', [Storefront\HomeController::class, 'guide_lead'])
            ->name('guide-lead.slug');
        
        Route::get('download-pdf-file', [Storefront\HomeController::class, 'download_pdf'])
        ->name('download-pdf-file');
    
        // end added by hassan00942 + guideleads00942

        Route::get('page/{page}', [Storefront\HomeController::class, 'openPage'])
            ->name('page.open');

        Route::get('product/{slug}', [Storefront\HomeController::class, 'product'])
            ->name('show.product');

        Route::get('product/{slug}/quickView', [Storefront\HomeController::class, 'quickViewItem'])
            ->name('quickView.product')->middleware('ajax');

        Route::get('product/{slug}/offers', [Storefront\HomeController::class, 'offers'])
            ->name('show.offers');

        Route::get('categories', [Storefront\HomeController::class, 'categories'])
            ->name('categories');

        Route::get('category/{slug}', [Storefront\HomeController::class, 'browseCategory'])
            ->name('category.browse');

        Route::get('categories/{slug}', [Storefront\HomeController::class, 'browseCategorySubGrp'])
            ->name('categories.browse');

        Route::get('categorygrp/{slug}', [Storefront\HomeController::class, 'browseCategoryGroup'])
            ->name('categoryGrp.browse');

        Route::get('shop/{slug}', [Storefront\HomeController::class, 'shop'])
            ->name('show.store');

        Route::get('shop/{slug}/products', [Storefront\HomeController::class, 'shopProducts'])
            ->name('shop.products');

        Route::get('shops', [Storefront\HomeController::class, 'all_shops'])
            ->name('shops');

        // Route::get('shop/reviews/{slug}', [Storefront\HomeController::class, 'shopReviews'])->name('reviews.store');

        Route::get('brand/{slug}', [Storefront\HomeController::class, 'brand'])
            ->name('show.brand');

        Route::get('brand/{slug}/products', [Storefront\HomeController::class, 'brandProducts'])
            ->name('brand.products');

        Route::get('brands', [Storefront\HomeController::class, 'all_brands'])
            ->name('brands');

        Route::get('search', [Storefront\SearchController::class, 'search'])
            ->name('inCategoriesSearch');

        Route::get('blog', [Storefront\BlogController::class, 'index'])
            ->name('blog');

        Route::any('blog/search', [Storefront\BlogController::class, 'search'])
            ->name('blog.search');

        Route::get('blog/{slug}', [Storefront\BlogController::class, 'show'])
            ->name('blog.show');

        Route::get('blog/author/{author}', [Storefront\BlogController::class, 'author'])
            ->name('blog.author');

        Route::get('blog/tag/{tag}', [Storefront\BlogController::class, 'tag'])
            ->name('blog.tag');

        // added by hassan00942 + reviewUiLookLikeFiver00942
        Route::get('load/more/reveiws', [Storefront\HomeController::class, 'loadMoreReviews'])
            ->name('load.more.reviews');
        
        // added by hassan00942 + teamPage00942
        Route::get('management', [Storefront\PageController::class, 'team_page'])
            ->name('team-memebrs');
    });

    
// Route for merchant landing theme
Route::middleware('selling')
    ->namespace('Selling')->group(function () {
        Route::get('selling', [Selling\SellingController::class, 'index'])
            ->name('selling');
    });

// // Route for customers
// Route::group(['as' => 'customer.', 'prefix' => 'customer'], function() {
// 	// include('storefront/Auth.php');
// });
