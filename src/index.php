<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./output.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
    integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="./app.css">
  <?php if (file_exists(__DIR__ . '/analytics.php')): ?>
    <?php include('analytics.php'); ?>
  <?php endif; ?>
  <style>
    [x-cloak] {
      display: none !important;
    }
  </style>
</head>

<body x-data="{list: [], inputValue: '', title: ''}">
  <div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-400">
    <div class="w-full pt-4 pb-4 flex justify-center">
      <div class="max-w-7xl rounded-lg border-2 border-gray-200 bg-white p-4 shadow-lg" id="content">

        <!-- Header Section -->
        <div class="w-full flex justify-center mb-4">
          <h1 class="text-xl font-bold">Welcome to TODO PDF Checklist Generator!</h1>
        </div>

        <!-- Title Input Section -->
        <div class="w-full flex justify-center items-center mt-4">
          <span class="text-gray-700">List title:</span>
          <input x-model="title" type="text" name="title"
            class="ml-2 border border-gray-400 rounded px-2 py-1 shadow-lg hover:bg-gray-50" />
        </div>

        <!-- Item Input and Buttons Section -->
        <div class="w-full flex justify-center mt-4">
          <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
            <div class="my-auto text-sm text-gray-700">Add item name:</div>
            <input x-model="inputValue" type="text" name="input_add"
              class="border border-gray-400 rounded px-2 py-1 shadow-lg hover:bg-gray-50">
            <button @click="list.push(inputValue); inputValue = '';" type="button"
              class="text-md px-8 py-1 rounded bg-gradient-to-tr from-green-200 to-blue-400 hover:from-green-300 hover:to-blue-500 shadow-lg border-2 border-white">
              Add
            </button>
            <button @click="list.pop(); inputValue = '';" type="button"
              class="text-md px-8 py-1 rounded bg-gradient-to-tr from-red-600 to-violet-500 text-white hover:from-red-700 hover:to-violet-600 shadow-lg border-2 border-white">
              Remove
            </button>
          </div>
        </div>

        <!-- Printable Checklist Section -->
        <div id="printable_div" x-cloak>
          <div class="w-full flex justify-center mt-8">
            <h1 x-text="title" class="text-2xl font-bold"></h1>
          </div>
          <div class="w-full flex justify-start">
            <ul class="p-4">
              <template x-for="(value, index) in list" :key="index">
                <li class="flex space-x-2 mt-2">
                  <button type="button" @click="list.splice(index, 1);" class="w-6 h-6 rounded border border-gray-500 hover:bg-red-500 text-white font-bold">
                    <div class="">
                      x
                    </div>
                  </button>
                  <span x-text="value" class="text-lg my-auto ml-2"></span>
                </li>
              </template>
            </ul>
          </div>
        </div>

        <!-- Print Button Section -->
        <div class="w-full flex justify-center mt-8">
          <button type="button" id="print_btn"
            class="text-md px-8 py-1 rounded bg-gradient-to-tr from-violet-200 to-orange-400 hover:from-violet-300 hover:to-orange-500 shadow-lg border-2 border-white">
            Print
          </button>
        </div>

      </div>
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