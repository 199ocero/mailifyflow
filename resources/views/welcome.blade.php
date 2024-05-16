<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>filapanel.com - MailifyFlow</title>
</head>

<body>
<section class="min-h-screen bg-gradient-to-b from-orange-600 via-orange-500 to-orange-400 flex items-center md:overflow-hidden">
    <div class="mx-auto md:flex md:items-center md:justify-between">
        <div class="w-full md:w-1/2 ml-2.5 md:ml-20 mb-10 md:mb-0">
            <h1 class="text-5xl font-bold text-white mb-5">
                Kickstart Laravel & Filament projects with <span class="px-4 bg-orange-900 rounded shadow"><a href="https://filapanel.com/?ref=template"
                                                                                                              target="_blank"
                                                                                                   class="underline decoration-wavy decoration-orange-200 hover:decoration-orange-100 text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-500">Filapanel</a></span>
            </h1>
            <p class="text-xl text-white mb-5">
                Say goodbye to the tedious, time-consuming process of manually creating database migrations, models, and
                filament resources. With Filapanel, you can generate your Laravel and Filament code without the need for
                programming.
            </p>

            <p class="text-xl text-white mb-5">
                Filapanel is proudly being hosted, managed and built by <a href="https://ploi.io/?ref=template" target="_blank" class="underline decoration-wavy">ploi.io</a>
            </p>

            <div class="space-x-2">
                <a href="/admin" class="bg-white px-4 py-2 rounded shadow-lg">Login to panel admin</a>
            </div>
        </div>
        <div class="w-full md:w-1/2 md:-mr-20">
            <div class="h-auto w-full rounded-md bg-gradient-to-r from-yellow-500 via-red-500 to-orange-800 p-1">
                <div class="flex h-full w-full items-center justify-center bg-gray-800 back">
                    <img src="https://filapanel.com/img/dark-screenshot.png" alt="Filapanel"
                         class="w-full h-auto">
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
