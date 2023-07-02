<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Codeforces Helper</title>
    <link rel="shortcut icon" href="{{asset('assets/img/puzzle.ico')}}" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/tailwind.output.css')}}" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{asset('assets/js/init-alpine.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="{{asset('assets/js/charts-lines.js')}}" defer></script>
    <script src="{{asset('assets/js/charts-pie.js')}}" defer></script>
    <style>
        /* Red */
        .text-custom-red {
            color: #ff0000;
        }
        .red-bg {
        background-color: #ff0000;
        }
        .orange-bg {
        background-color: #ff8c00;
        }
        .yellow-bg {
        background-color: #FFD700;
        }
        .orange-bg {
        background-color: #ff8c00;
        }

        /* Green */
        .text-custom-green {
            color: #008000;
        }

        /* Blue */
        .text-custom-blue {
            color: #0000ff;
        }

        /* Yellow */
        .text-custom-yellow {
            color: #FFD700;
        }

        /* blue */
        .text-custom-purple {
            color: blue;
        }

        /* Gray */
        .text-custom-gray {
            color: #808080;
        }

        /* Black */
        .text-custom-black {
            color: #000;
        }

        /* Cyan */
        .text-custom-cyan {
            color: #03a89e;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                if ($('input[type="checkbox"]:checked').length === 0) {
                    event.preventDefault();
                    alert('Please select at least one checkbox');
                }
            });
        });
    </script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <div class="flex items-center">
                    <img src="{{asset('assets/img/puzzle.ico')}}" alt="" class="w-8 h-8 ml-6">
                    <a class="ml-1 text-lg font-bold text-gray-800 dark:text-gray-200" href="{{route('home')}}">
                        Codeforces Helper
                    </a>
                </div>
                <ul class="mt-6">
                    <li class="relative px-6 py-3 bg-blue-500 text-white rounded-md">
                        <button
                            class="font-bold inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                            @click="togglePagesMenu" aria-haspopup="true">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path
                                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                                    </path>
                                </svg>
                                <span class="ml-4 ">Recommended Problems Based On Your Rate</span>
                            </span>
                            <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <template x-if="isPagesMenuOpen">
                            <ul x-transition:enter="transition-all ease-in-out duration-300"
                                x-transition:enter-start="opacity-25 max-h-0"
                                x-transition:enter-end="opacity-100 max-h-xl"
                                x-transition:leave="transition-all ease-in-out duration-300"
                                x-transition:leave-start="opacity-100 max-h-xl"
                                x-transition:leave-end="opacity-0 max-h-0"
                                class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                                aria-label="submenu">
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('recommended-problems','string_algorithms')}}">String Algorithms</a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('recommended-problems','algorithmic_techniques')}}">Algorithmic Techniques</a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('recommended-problems','combinatorial_algorithms')}}">Combinatorial Algorithms</a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('recommended-problems','data_structures')}}">Data Structures</a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('recommended-problems','graph_algorithms')}}">Graph Algorithms</a>
                                </li>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('recommended-problems','mathematical_techniques')}}">Mathematical Techniques</a>
                                </li>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('recommended-problems','problem_solving_strategies')}}">Problem Solving Strategies</a>
                                </li>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('recommended-problems','miscellaneous')}}">Miscellaneous</a>
                                </li>
                            </ul>
                        </template>
                    </li>
                    <li class="relative px-6 py-3 bg-blue-500 text-white mt-4 rounded-md">
                        <button
                        class="font-bold inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                        @click="toggleTechniquesMenu" aria-haspopup="true">
                        <span class="inline-flex items-center">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                                </path>
                            </svg>
                            <span class="ml-4">Recommended Problems Based On Your Latest Solved Problems</span>
                        </span>
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        </button>
                        <template x-if="istoggleTechniquesMenuOpen">
                            <ul x-transition:enter="transition-all ease-in-out duration-300"
                                x-transition:enter-start="opacity-25 max-h-0"
                                x-transition:enter-end="opacity-100 max-h-xl"
                                x-transition:leave="transition-all ease-in-out duration-300"
                                x-transition:leave-start="opacity-100 max-h-xl"
                                x-transition:leave-end="opacity-0 max-h-0"
                                class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                                aria-label="submenu">
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('latest-solved-based-recommended-problems','string_algorithms')}}">String Algorithms</a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('latest-solved-based-recommended-problems','algorithmic_techniques')}}">Algorithmic Techniques</a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('latest-solved-based-recommended-problems','combinatorial_algorithms')}}">Combinatorial Algorithms</a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('latest-solved-based-recommended-problems','data_structures')}}">Data Structures</a>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('latest-solved-based-recommended-problems','graph_algorithms')}}">Graph Algorithms</a>
                                </li>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('latest-solved-based-recommended-problems','mathematical_techniques')}}">Mathematical Techniques</a>
                                </li>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('latest-solved-based-recommended-problems','problem_solving_strategies')}}">Problem Solving Strategies</a>
                                </li>
                                </li>
                                <li
                                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                                    <a class="w-full" href="{{route('latest-solved-based-recommended-problems','miscellaneous')}}">Miscellaneous</a>
                                </li>
                            </ul>
                        </template>
                    </li>

                    <li class="mt-8">
                        <a href="{{route('latest_contests')}}" class="block px-4 py-2 rounded-md bg-blue-500 text-white font-semibold hover:bg-blue-500 transition duration-200">Latest Contests</a>
                    </li>
                    <li class="mt-4">
                        <a href="{{route('get_solved_problems')}}" class="block px-4 py-2 rounded-md bg-blue-500 text-white font-semibold hover:bg-blue-500 transition duration-200">Solved Problems</a>
                    </li>
                    <li class="mt-4">
                        <a href="{{ route('get_un_solved_problems') }}" class="block px-4 py-2 rounded-md bg-blue-500 text-white font-semibold hover:bg-blue-500 transition duration-200 bg-blue-500">Unsolved Problems</a>
                      </li>

                </ul>
            </div>
        </aside>
        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
        <aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
            x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
            @keydown.escape="closeSideMenu">
            <div class="py-4 text-gray-500 dark:text-gray-400">
                <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="#">
                    Codeforces Helper
                </a>
                <ul class="mt-6">
                    <li class="relative px-6 py-3">
                        <span class="absolute inset-y-0 left-0 w-1 bg-blue-500 rounded-tr-lg rounded-br-lg"
                            aria-hidden="true"></span>
                        <a class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                            href="index.html">
                            <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                </path>
                            </svg>
                            <span class="ml-4">Codeforces Helper</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="flex flex-col flex-1 w-full">
            <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
                <div
                    class="container flex items-center justify-between h-full px-6 mx-auto text-blue-600 dark:text-blue-300">
                    <!-- Mobile hamburger -->
                    <button class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-blue"
                        @click="toggleSideMenu" aria-label="Menu">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <!-- Search input -->
                    <div class="flex justify-center flex-1 lg:mr-32">
                        <form action="{{route('search')}}" method="POST">
                            @csrf
                            <div class="relative w-full max-w-xl mr-6 focus-within:text-blue-500">
                                <div class="absolute inset-y-0 flex items-center pl-2">
                                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input
                                    name="search"
                                    class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-blue-300 focus:outline-none focus:shadow-outline-blue form-input"
                                    type="text" placeholder="Search for problems" aria-label="Search" />
                            </div>
                        </form>
                        @if(session('error'))
                            <div class="text-custom-red px-2 py-2 rounded-md" role="alert">
                                <div>
                                    <p class="text-sm">{{ session('error') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <ul class="flex items-center flex-shrink-0 space-x-6">
                        <!-- Theme toggler -->
                        <li class="flex">
                            <button class="rounded-md focus:outline-none focus:shadow-outline-blue"
                                @click="toggleTheme" aria-label="Toggle color mode">
                                <template x-if="!dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z">
                                        </path>
                                    </svg>
                                </template>
                                <template x-if="dark">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </template>
                            </button>
                        </li>
                        <li class="text-custom-{{$color}}">
                            <a href="https://codeforces.com/profile/{{$name}}" class="font-bold text-lg">{{ $name }}</a>
                          </li>
                    </ul>
                </div>
            </header>
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        @if ($tag_categoires[0])
                        <form action="{{ route('chose-tags') }}" method="POST">
                            @csrf
                            <input type="hidden" name="current_url" value="{{ url()->current() }}">
                            <div class="flex items-center">
                                <div class="w-auto px-4 py-2 leading-5 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md appearance-none focus:outline-none focus:shadow-outline-blue dark:focus:shadow-outline-green focus:border-blue-500 dark:focus:border-green-500 sm:text-sm sm:leading-5 dark dark:text-gray-300 inline-flex">
                                    @foreach ($tag_categoires as $tag)
                                        <label class="inline-flex items-center space-x-2">
                                            <input type="checkbox" name="tags_list[]" checked value="{{$tag}}" class="form-checkbox h-6 w-5 text-blue-600">
                                            <span class="ml-2 mr-6 whitespace-no-wrap">{{$tag}}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <button type="submit" class="ml-4 px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-500 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                                    Submit    </button>
                            </div>
                        </form>

                        @endif
                    </h2>

                    <!-- New Table -->
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">Name</th>
                                        <th class="px-4 py-3">Rate</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Tags</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    @foreach ($data as $problem)
                                        @if (($problem['name_of_problem'] != 'None')&&(($problem['rate_of_problem'] == 'None' || $rating == 'None')||(1/(1+pow(10,((intval($problem['rate_of_problem']-intval($rating))/400)))) < 0.9)))
                                            <tr class="text-gray-500 dark:text-gray-400">
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center text-sm">
                                                        <div>
                                                            <p class="font-semibold">
                                                                <a target="_blank"
                                                                    href="https://codeforces.com/problemset/problem/{{ $problem['contest_id'] }}/{{ $problem['index'] }}">{{ $problem['index'] }} - {{ $problem['name_of_problem'] }}</a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    {{ $problem['rate_of_problem'] }}
                                                </td>
                                                <td class="px-4 py-3 text-xs text-white">
                                                    @if ($problem['state'] == 1)
                                                        <span
                                                            class="px-2 py-1 font-semibold leading-tight bg-blue-500 rounded-full dark:bg-blue-700 dark:text-blue-100">
                                                            Solved
                                                        </span>
                                                    @elseif ($problem['state'] == -1)
                                                        <span
                                                            class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                                            New
                                                        </span>
                                                    @else
                                                        <span
                                                            class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                                            Unsolved
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <div class="flex flex-row gap-0">
                                                        @foreach ($problem['tags'] as $tag)
                                                            <span
                                                                class="inline-block bg-gray-500 rounded-full px-2 py-1 text-xs font-semibold text-gray-100">
                                                                <span
                                                                    class="border border-gray-400 rounded-full px-2 py-1 text-xs">{{ $tag }}</span>
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-2">
                        @if(request()->isMethod('GET'))
                            {{ $data->links() }}
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
