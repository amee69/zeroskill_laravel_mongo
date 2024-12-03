<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>

</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
      
        <!-- Sidebar -->
        <aside class="w-64 bg-zeroskill-black text-white p-4 space-y-4">
            <h1 class="text-2xl font-bold">Admin Dashboard</h1>
            <nav class="space-y-2">
                <a href="{{ route('admin.manage.orders') }}" class="block px-4 py-2 border hover:bg-gray-600 rounded">
                    Ongoing Orders
                </a>
                <a href="{{ route('admin.manage.history') }}" class="block px-4 py-2 border hover:bg-gray-600 rounded">
                    Order History
                </a>
                <a href="{{ route('admin.manage.products') }}" class="block px-4 py-2 border hover:bg-gray-600 rounded">
                    Manage Products
                </a>
                <a href="{{ route('admin.shop') }}" class="block px-4 py-2 border hover:bg-gray-600 rounded">
                    Manage Categories
                </a>
                
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 rounded">
            <div class="bg-zeroskill-black p-6 rounded shadow-md">
                {{ $slot }}
            </div>
        </main>
    </div>
    @livewireScripts
</body>
</html>
