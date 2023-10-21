<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Personal Accounts</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css"
    />
 

 <style>
  body {
      margin: 0;
      padding: 0;
  }

</style>
@include('layout.head')
</head>
<body class="">
  <div class="relative min-h-screen md:flex" data-dev-hint="container">
   
    @include('layout.sidebar')
   
    
    
    <main id="content" class="flex-1 px-6 lg:px-8">
      <div class=" mx-auto flex gap-x-2 lg:flex-nowrap flex-wrap">
          <!-- Replace with your content -->
          <section class="lg:w-[49%] min-h-fit w-[100%] p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-2 min-h-[95vh]">
            <h1 class="text-xl font-bold text-white capitalize dark:text-white"><i class="bi bi-pencil-square mr-2"></i>Company Entry</h1>
            <form class="row g-3" id="addcompany" action="{{ route('user/company') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div>
                        <label class="text-white dark:text-gray-200" for="username">Company Name</label>
                       
                        <input type="text"  class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="company_name" name="company_name" placeholder="Company Name" required>
                    </div>
        
                    <div>
                        <label class="text-white dark:text-gray-200" for="description">Description</label>
                        <input id="description" type="text" name="description" placeholder="Description" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    </div>
        
                   
                </div>
        
                <div class="flex justify-end mt-6">
                    <button class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">Save</button>
                </div>
            </form>

            {{-- <form class="row g-3" id="addcompany" action="{{ route('user/company') }}" method="post" enctype="multipart/form-data">
                @csrf
          
                  <div class="col-md-6">
                      <label for="buy_form" class="form-label">Company Name</label>
                      <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" required>
                  </div>
          
                  <div class="col-md-6">
                      <label for="pnumber" class="form-label">Description</label>
                      <input type="text" class="form-control" id="description" name="description" required placeholder="Company Description">
                  </div>
          
                  <div class="col-12 text-center">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Add Company
                    </button>
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" id="closecompany">
                        Close
                    </button>
                  </div>
                  
              </form> --}}
        </section>
        <section class="lg:w-[49%] h-[98vh] w-[100%] p-3 mx-auto bg-red-900 rounded-md shadow-md dark:bg-gray-800 mt-2">
            <h1 class="text-xl font-bold text-white capitalize dark:text-white"><i class="bi bi-person-lines-fill mr-2"></i>Company List</h1>
            <section class="antialiased bg-gray-100 text-gray-600 mt-3">
              <div class="flex flex-col justify-center h-full">
                  <!-- Table -->
                  <div class="w-full max-w-3xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                      
                      <div class="p-2">
                          <div class="overflow-x-auto overflow-y-auto h-[85vh] lg:h-[85vh]">
                            <table class="table table-bordered border-primary" id="candidatetable">
                                <thead>
                                  <tr>
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Description</th>
                                  
                                  </tr>
                                </thead>
                        
                                <tbody>
                                 
                                  @foreach ($company as $index=>$item)
                                  <tr>
                                      <td>{{ $index++ }}</td>
                                      <td>{{ $item->name ?? 'N/A' }}</td>
                                      <td>{{ $item->description ?? 'N/A' }}</td>
                                     
                                  </tr>
                                  @endforeach
                                  
                                </tbody>
                            
                        </table>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
        </section>
          <!-- /End replace -->
      </div>
  </main>
</div>





@include('layout.script')
<script>
    $(document).ready(function() {
        $('#addcompany').submit(function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Display a success Swal notification
                        Swal.fire({
                            icon: 'success',
                            title: response.title,
                            text: response.message,
                        });
                        window.location.reload();
                    } else {
                        // Display an error Swal notification
                        Swal.fire({
                            icon: 'error',
                            title: response.title,
                            text: response.message,
                        });
                    }
                },
                error: function(error) {
                    // Handle errors here
                    console.error(error);

                    // Display an error Swal notification in case of AJAX errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred during the request.',
                    });
                }
            });
        });
    });
</script>


</body>
</html>