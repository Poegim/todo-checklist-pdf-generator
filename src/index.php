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
  <div class="min-h-screen bg-gradient-to-br from-yellow-50 to-yellow-300">
    <div class="w-full pb-4 pt-8 md:pt-24 flex justify-center">
      <div class="max-w-7xl rounded-lg border-2 border-gray-200 bg-white px-4 pb-12 shadow-lg" id="content">

        <!-- Header Section -->
        <div class="w-full grid grid-cols-1 text-center py-12 px-6">
          <h1 class="text-xl md:text-2xl font-bold tracking-tight">Simple and free, TODO Checklist PDF Generator.</h1>
          <p>
            <h2 class="text-md tracking-tighter">Generate professional, easy-to-use PDF to-do lists and checklists for free – ready to print with just one click.</h2>
          </p>
        </div>
        
        

        <!-- Title Input Section -->
        <div class="w-full flex justify-center items-center mt-4">
          <span class="text-gray-600 md:text-lg italic">List title:</span>
          <input x-model="title" type="text" name="title"
            class="ml-2 border border-gray-400 rounded px-2 py-1 shadow-lg hover:bg-gray-50" />
        </div>

        <!-- Item Input and Buttons Section -->
        <div class="w-full flex justify-center mt-4">
          <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2">
            <div class="my-auto md:text-lg italic text-gray-600 ">Add item name:</div>
            <input x-model="inputValue" type="text" name="input_add"
              class="border border-gray-400 rounded px-2 py-1 shadow-lg hover:bg-gray-50">
            <button @click="list.push(inputValue); inputValue = '';" type="button"
              class="text-md px-8 py-1 rounded text-white bg-gradient-to-tr from-green-500 to-blue-700 hover:from-green-300 hover:to-blue-500 shadow-lg border-2 border-white">
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
            class="text-md px-8 flex gap-2 py-1 text-white rounded bg-gradient-to-tr from-violet-500 to-orange-600 hover:from-violet-300 hover:to-orange-500 shadow-lg border-2 border-white">
            <svg class="size-8" viewBox="0 0 48 48" id="a" xmlns="http://www.w3.org/2000/svg" fill="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><defs><style>.b{fill:#ffffff;}.c{fill:none;stroke:#ffffff;stroke-linecap:round;stroke-linejoin:round;stroke-width:2px;}</style></defs><path class="c" d="M14.5171,35.415H6.4026c-.4985,0-.9026-.4041-.9026-.9026v-13.504c0-.4985,.4041-.9026,.9026-.9026H41.5974c.4985,0,.9026,.4041,.9026,.9026v13.504c0,.4985-.4041,.9026-.9026,.9026h-8.1144"></path><rect class="c" x="14.5171" y="31.4366" width="18.9659" height="10.13"></rect><path class="c" d="M33.4829,20.1056H14.5171V6.4334h14.9659l4,4v9.6723Z"></path><polyline class="c" points="29.8724 6.4334 29.8724 10.0439 33.4829 10.0439"></polyline><circle class="b" cx="39.8515" cy="22.8983" r=".75"></circle><circle class="b" cx="36.8351" cy="22.8983" r=".75"></circle><circle class="b" cx="33.8187" cy="22.8983" r=".75"></circle></g></svg>
            <p class="my-auto text-lg font-base">
              Download PDF
            </p>
          </button>
        </div>

      </div>
    </div>
  </div>

  <script>
    const print_btn = document.getElementById('print_btn');
    print_btn.addEventListener('click', async () => {
        const title = document.querySelector('input[x-model="title"]').value;

        const listItems = Array.from(document.querySelectorAll('[x-text="value"]')).map(el => el.textContent);

        const formData = new FormData();
        formData.append('title', title);
        listItems.forEach(item => formData.append('list[]', item));

        const response = await fetch('./generate_pdf.php', {
            method: 'POST',
            body: formData,
        });

        if (response.ok) {
            const blob = await response.blob();
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = 'checklist.pdf';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        } else {
            console.error('Błąd podczas generowania PDF:', response.statusText);
        }
    });

  </script>

</body>

</html>