<!-- Navigation -->
<nav class="top-menu-container">
    <div class="logo-header">
        <a href="">
            <img src="https://cdn.pixabay.com/photo/2017/02/18/19/20/logo-2078018_960_720.png"
                alt="Logo personal portfolio" title="Logo personal portfolio" />
        </a>
    </div>

    <ul>
        <li>
            <a href="home" class="{{ request()->is('home') ? 'active' : '' }}">Home</a>
        </li>
        <li>
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">To-do List</a>
        </li>
        <li>
            <a href="/chatBot" class="{{ request()->is('chatBot') ? 'active' : '' }}">chatBot</a>
        </li>
        <li>
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Contact</a>
        </li>
    </ul>
</nav>
