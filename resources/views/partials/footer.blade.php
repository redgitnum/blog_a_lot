<footer>
    <div class="w-full bg-gray-700 text-gray-200 flex flex-col items-center">
        <div class="uppercase text-xs px-16 sm:px-10 py-3 w-full sm:w-10/12 lg:w-7/12 bg-gray-700 border-b border-white border-opacity-50">
            Sitemap
        </div>
        <div class="flex justify-around sm:justify-start pt-4 px-10 pb-16 w-full sm:w-10/12 lg:w-7/12 bg-gray-700">
            <div class="pr-0 sm:pr-24">
                <div class="text-xl font-bold mb-2 text-indigo-400">Blog</div>
                <ul>
                    <li class="border-l border-white border-opacity-50 pl-1 pb-2 text-sm">
                        <a href="/">Home</a>
                    </li>
                    <li class="border-l border-white border-opacity-50 pl-1 pb-2 text-sm">
                        <a href="{{ route('categories') }}">Categories</a>
                    </li>
                    <li class="border-l border-white border-opacity-50 pl-1 text-sm">
                        <a href="{{ route('about') }}">About</a>
                    </li>
                </ul>
            </div>
            <div class="pr-0 sm:pr-24">
                <div class="text-xl font-bold mb-2 text-green-400">Account</div>
                <ul>
                    @guest    
                    <li class="border-l border-white border-opacity-50 pl-1 pb-2 text-sm">
                        <a href="{{ route('register') }}">Register</a>
                    </li>
                    <li class="border-l border-white border-opacity-50 pl-1 pb-2 text-sm">
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                    @endguest
                    @auth
                    <li class="border-l border-white border-opacity-50 pl-1 text-sm">
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    @endauth
                </ul>
            </div>
            <div>
                <div class="pb-4">
                    <a href="https://github.com/redgitnum" target="_blank" class="text-xl font-bold mb-2 text-blue-400">
                        Github
                    </a>
                </div>
                <div>
                    <a href="http://gbcode.pl" target="_blank" class="text-xl font-bold mb-2 text-yellow-400">
                        Portfolio
                    </a>
                </div>
            </div>
        </div>
        <div class="flex justify-center pt-2 pb-4 border-t border-white border-opacity-30 w-full sm:w-10/12 lg:w-7/12 bg-gray-700">
            Copyright &#169; 2021&#160;<a href="http://gbcode.pl" target="_blank" class="font-bold">gbcode</a>. All rights reserved.
        </div>
    </div>
</footer>
</body>
</html>