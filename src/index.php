<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class=" bg-gradient-to-br from-slate-50 to-slate-300 h-screen w-screen pt-10" x-data="{list: [], inputValue: ''}">
  <div class="w-full flex justify-center">
    <div>
      <h1 class="text-xl font-bold" x-data="{lol: 'asdf'}">
        Welcome to TODO PDF Checklist Generator!
      </h1>
    </div>
  </div>
  <div class="w-full flex justify-center mt-8">
    <div>
      <input x-model="inputValue" type="text" name="inut_add" class="border border-gray-400 rounded px-2 py-1 shadow hover:bg-gray-50">
      <button @click="list.push(inputValue); inputValue = '';" type="button" class="text-md px-8 py-1 rounded bg-gradient-to-tr from-green-200 to-blue-400 hover:from-green-300 hover:to-blue-500 hover:border-gray-100 shadow border-2 border-white">Add</button>
      <button @click="list.pop(); inputValue = '';" type="button" class="text-md px-8 py-1 rounded bg-gradient-to-tr from-red-600 to-violet-500 hover:from-red-700 text-white hover:to-violet-600 hover:border-gray-100 shadow border-2 border-white">Remove</button>
    </div>
  </div>
  <div class="w-full flex justify-center mt-8">
    <ul>
    <template x-for="(value, index) in list">
        <li class="flex space-x-2 mt-2">
            <div class="w-6 h-6 rounded border border-gray-500"></div><span x-text="value"></span>
        </li>
    </template>
    </ul>
  </div>


</body>
</html>