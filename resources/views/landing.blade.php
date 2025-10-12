<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Event Malang</title>
    @vite('resources/css/app.css')
    <link rel="manifest" href="/manifest.json">
</head>
<body class="antialiased">

    <header class="bg-green-500 text-white shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-white text-green-600 flex items-center justify-center font-bold rounded">
                    GE
                </div>
                <span class="font-semibold">Green Event</span>
            </div>
            <nav class="flex gap-6">
                <a href="#" class="hover:text-gray-200">Home</a>
                <a href="#" class="hover:text-gray-200">Event</a>
                <a href="#" class="hover:text-gray-200">About</a>
                <a href="#" class="hover:text-gray-200">Contact</a>
            </nav>
            <div class="flex gap-3">
                <a href="#" class="px-3 py-1 rounded bg-white text-green-600 font-medium">Sign In</a>
                <a href="#" class="px-3 py-1 rounded bg-green-700 text-white font-medium">Register</a>
            </div>
        </div>
    </header>

    <section class="bg-gradient-to-b from-green-300 to-white text-center py-20">
        <h1 class="text-4xl font-extrabold text-gray-800">Green Event Malang</h1>
        <p class="mt-4 text-lg text-gray-700">Temukan event ramah lingkungan di Kota Malang</p>
        <div class="mt-6">
            <a href="#" class="px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">Daftar Sekarang</a>
            <a href="#" class="px-6 py-3 border border-green-600 text-green-700 rounded-lg hover:bg-green-50">Masuk</a>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-gray-100 h-48 flex items-center justify-center rounded-lg">
            <span class="text-gray-400">[ Gambar Event ]</span>
        </div>
        <div class="bg-gray-100 h-48 flex items-center justify-center rounded-lg">
            <span class="text-gray-400">[ Gambar Event ]</span>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-16">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Heading</h2>
        <p class="text-gray-600 mb-10">Subheading</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach(range(1,6) as $i)
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full border border-gray-400 flex items-center justify-center">
                    <span class="text-sm">i</span>
                </div>
                <div>
                    <h3 class="font-semibold">Title</h3>
                    <p class="text-sm text-gray-600">Body text for whatever you'd like to say. Add main takeaway points, quotes, anecdotes, or even a very very short story.</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <footer class="bg-gray-100 border-t mt-16 py-10">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10 text-sm text-gray-700">

            <div>
                <h4 class="font-semibold mb-3">Use cases</h4>
                <ul class="space-y-2">
                    <li><a href="#">UX design</a></li>
                    <li><a href="#">UI design</a></li>
                    <li><a href="#">Wireframing</a></li>
                    <li><a href="#">Diagramming</a></li>
                    <li><a href="#">Online whiteboard</a></li>
                    <li><a href="#">Team collaboration</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-3">Explore</h4>
                <ul class="space-y-2">
                    <li><a href="#">Design</a></li>
                    <li><a href="#">Prototyping</a></li>
                    <li><a href="#">Development features</a></li>
                    <li><a href="#">Design systems</a></li>
                    <li><a href="#">Collaborative features</a></li>
                    <li><a href="#">Design process</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-3">Resources</h4>
                <ul class="space-y-2">
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Best practices</a></li>
                    <li><a href="#">Colors</a></li>
                    <li><a href="#">Color wheel</a></li>
                    <li><a href="#">Developers</a></li>
                    <li><a href="#">Resource library</a></li>
                </ul>
            </div>

            <div class="flex items-center gap-4">
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" class="w-6 h-6" alt="instagram"></a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="w-6 h-6" alt="twitter"></a>
                <a href="#"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="w-6 h-6" alt="facebook"></a>
            </div>

        </div>
    </footer>

</body>
</html>
