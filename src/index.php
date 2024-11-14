<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
    integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-slate-400 w-full pt-4 flex justify-center pb-4 min-h-screen"
  x-data="{list: [], inputValue: '', title: ''}">
  <div class="max-w-7xl rounded-lg border-2 border-gray-200 bg-white p-4 shadow-lg">

    <div class="w-full flex justify-center">
      <div>
        <h1 class="text-xl font-bold"">
        Welcome to TODO PDF Checklist Generator!
      </h1>
    </div>
  </div>
  <div class=" w-full flex justify-center mt-4">
          <div class="my-auto">Enter list title: </div>
          <input x-model="title" type="text" name="title"
            class="ml-2 border border-gray-400 rounded px-2 py-1 shadow-lg hover:bg-gray-50">
      </div>
      <div class="w-full justify-center mt-4">
        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0">
          <input x-model="inputValue" type="text" name="inut_add"
            class="border border-gray-400 rounded px-2 py-1 shadow-lg hover:bg-gray-50">
          <button @click="list.push(inputValue); inputValue = '';" type="button"
            class="text-md px-8 py-1 rounded bg-gradient-to-tr from-green-200 to-blue-400 hover:from-green-300 hover:to-blue-500 hover:border-gray-100 shadow-lg border-2 border-white">Add</button>
          <button @click="list.pop(); inputValue = '';" type="button"
            class="text-md px-8 py-1 rounded bg-gradient-to-tr from-red-600 to-violet-500 hover:from-red-700 text-white hover:to-violet-600 hover:border-gray-100 shadow-lg border-2 border-white">Remove</button>
        </div>
      </div>
      <div id="printable_div" x-cloak>
        <div class="w-full flex justify-start mt-8">
          <div class="w-full flex justify-center">
            <p>
              <h1 x-text="title" class="text-lg">
              </h1>
            </p>
          </div>
        </div>
        <div class="w-full flex justify-start">
          <ul class="p-8">
            <template x-for="(value, index) in list">
              <li class="flex space-x-2 mt-2">
                <div class="w-6 h-6 rounded border border-gray-500"></div><span x-text="value"></span>
              </li>
            </template>
          </ul>
        </div>

      </div>
      <div class="w-full flex justify-center">
        <button type="button" id="print_btn"
          class="text-md px-8 py-1 rounded bg-gradient-to-tr from-violet-200 to-orange-400 hover:from-violet-300 hover:to-orange-500 hover:border-gray-100 shadow-lg border-2 border-white mt-8">Print</button>
      </div>
    </div>
    <script>

      let printable = document.getElementById('printable_div');

      function print() {
        html2pdf(printable);
      }

      const print_btn = document.getElementById('print_btn');
      print_btn.addEventListener('click', () => {
        print();
      });
    </script>
    
</body>

</html>