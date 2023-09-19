<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <h2>Logo</h2>
    </div>

    <ul class="sidebar-nav">
        <li class="# ? 'active' : '' }}">
            <a href="#"><i class="fa fa-home"></i>Home</a>
        </li>
        <li class="{{ Route::is('category.index') ? 'active' : '' }}">
            <a href="{{route('category.index')}}"><i class="fa fa-home"></i>Category</a>
        </li>
        <li class="{{ Route::is('product.index') ? 'active' : '' }}">
            <a href="{{route('product.index')}}"><i class="fa fa-product-hunt" aria-hidden="true"></i>Product</a>
        </li>
        <li class="{{ Route::is('optionGroup.index') ? 'active' : '' }}">
            <a href="{{route('optionGroup.index')}}"><i class="fa fa-cart-plus" aria-hidden="true"></i>Option Group</a>
        </li>
        <!-- <li class="{{ Route::is('option.index') ? 'active' : '' }}">
            <a href="{{route('option.index')}}"><i class="fa fa-cart-plus"></i>Option</a>
        </li> -->
        <li class="{{ Route::is('link.index') ? 'active' : '' }}">
            <a href="{{route('link.index')}}"><i class="fa fa-link" aria-hidden="true"></i>Link Product</a>
        </li>
        <li class="{{ Route::is('cart.index') ? 'active' : '' }}">
            <a href="{{route('cart.index')}}"><i class="fa fa-cart-plus" aria-hidden="true"></i>Cart </a>
        </li>
        <li class="{{ Route::is('notification.index') ? 'active' : '' }}">
            <a href="{{route('notification.index')}}"><i class="fa fa-bell" aria-hidden="true"></i>Notification </a>
        </li>
        <li class="{{ Route::is('users.index') ? 'active' : '' }}">
            <a href="{{route('users.index')}}"><i class="fa fa-users"></i>User </a>
        </li>
        <li class="{{ Route::is('review.index') ? 'active' : '' }}">
            <a href="{{route('review.index')}}"><i class="fa fa-list-alt" aria-hidden="true"></i>Review </a>
        </li>
        <li class="{{ Route::is('rating.index') ? 'active' : '' }}">
            <a href="{{route('rating.index')}}"><i class="fa fa-star" aria-hidden="true"></i></i>Rating </a>
        </li>
        <li class="{{ Route::is('wish.index') ? 'active' : '' }}">
            <a href="{{route('wish.index')}}"><i class="fa fa-heart" aria-hidden="true"></i>Wish list </a>
        </li>
        <li class="{{ Route::is('about.index') ? 'active' : '' }}">
            <a href="{{route('about.index')}}"><i class="fa fa-info-circle"></i>About</a>
        </li>
        <li class="{{ Route::is('slider.index') ? 'active' : '' }}">
            <a href="{{route('slider.index')}}"><i class="fa fa-sliders"></i>Slider</a>
        </li>
        <li class="# ? 'active' : '' }}">
            <a href="#"><i class="fa fa-inr" aria-hidden="true"></i>Order </a>
        </li>
    </ul>
</aside>