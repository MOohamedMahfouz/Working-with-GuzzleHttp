<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="shortcut icon" href="{{asset('assets/img/puzzle.ico')}}" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/solution-provider.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/creativetimofficial/tailwind-starter-kit/compiled-tailwind.min.css" />
    <title>Login</title>
    <style>
            .full-screen-background {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #gray-900;
    background-image: url(./assets/img/e.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  }
    </style>
</head>

<body class="text-gray-800 antialiased">
    <main>
        <section class="absolute w-full h-full">
            <div class="full-screen-background">
                <!-- Content goes here -->
            </div>
            <div class="container mx-auto px-4 h-full" >
                <div class="flex content-center items-center justify-center h-full">
                    <div class="w-full lg:w-4/12 px-4">
                        <div style="opacity: 1;"
                            class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-300 bg-opacity-70 border-0">
                            <div class="rounded-t mb-0 px-6 py-6 text-center font-bold">
                                Welcome To Codeforces Helper😊
                            </div>
                            <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <!-- Include a CSRF token for security -->
                                    <div class="relative w-full mb-3">
                                        <label class="block uppercase text-gray-700 text-xs font-bold mb-2"
                                            for="handle">Enter Your Handle:</label>
                                        <input type="text" name="handle" id="handle"
                                            class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                            placeholder="Codeforces Handle" style="transition: all 0.15s ease 0s;" />
                                    </div>
                                    @if ($message = $errors->first('message'))
                                        <span class="text-red-500 font-bold">{{ $message }}</span>
                                    @endif
                                    <div class="text-center mt-6">
                                        <button
                                            class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full"
                                            type="submit" style="transition: all 0.15s ease 0s;">
                                            Submit
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
<script>
    function toggleNavbar(collapseID) {
        document.getElementById(collapseID).classList.toggle("hidden");
        document.getElementById(collapseID).classList.toggle("block");
    }
</script>

</html>
