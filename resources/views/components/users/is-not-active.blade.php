<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tailwind Test in Filament Project</title>

  @vite('resources/css/filament/admin/theme.css') </head>
<body>
  <div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Testing Tailwind CSS in Filament</h1>

    <div class="grid grid-cols-2 gap-4">
      <div class="bg-gray-200 rounded-lg p-4">
        <h2 class="text-lg font-medium mb-2">Card 1</h2>
        <p class="text-gray-700">This is the content of card 1.</p>
      </div>
      <div class="bg-blue-500 text-white rounded-lg p-4">
        <h2 class="text-lg font-medium mb-2">Card 2</h2>
        <p>This is the content of card 2 with a blue background.</p>
      </div>
    </div>

    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-8">Click Me</button>
  </div>
</body>
</html>
