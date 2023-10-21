<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Personal Accounts</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            clifford: '#da373d',
          }
        }
      }
    }
  </script>
 <style>
  body {
      margin: 0;
      padding: 0;
  }

</style>

</head>
@include('layout.head')
<body class="">
  <div class="relative min-h-screen md:flex" data-dev-hint="container">
   
    @include('layout.sidebar')
   
    
    
    <main id="content" class="flex-1 px-6 lg:px-8">
      <div class=" mx-auto flex gap-x-2 lg:flex-nowrap flex-wrap">
          <!-- Replace with your content -->
          <section class="lg:w-[49%] w-[100%] p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-2 min-h-fit">
            <h1 class="text-xl font-bold text-white capitalize dark:text-white"><i class="bi bi-pencil-square mr-2"></i>Ticket Selling Entry</h1>
            <form class="row g-3" id="addvisa"  method="post" action="{{ route('user/visa') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div>
                        <label class="text-white dark:text-gray-200" for="buy_form">Buy Form</label>
                        
                        <input type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="buy_form" name="buy_form" placeholder="Purchase Form" required>
                    </div>
        
                    <div class="">
                        <label for="pnumber" class="text-white dark:text-gray-200">Company Name</label>
                        <select class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="company" name="company" required>
                          <option value="">Select Company</option> <!-- Default option -->
                          @foreach($company as $companys)
                              <option value="{{ $companys->id }}">{{ $companys->name }}</option>
                          @endforeach
                        </select>
                    </div>
            
        
                    <div>
                        <label for="address" class="text-white dark:text-gray-200">Country</label>
                        <input type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="country" placeholder="Country" name="country" required>
                    </div>
                    <div>
                        <label class="text-white dark:text-gray-200" for="passwordConfirmation">Worker Salary</label>
                        <input id="salay" type="text" placeholder="Worker Salary" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    </div>

                    <div>
            <label for="district" class="text-white dark:text-gray-200">Profession Name</label>
            <input type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="prof_name" placeholder="Profession Name" name="prof_name">
        </div>

        <div>
            <label for="district" class="text-white dark:text-gray-200">Purchase Amount</label>
            <input type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="total_tk" placeholder="Purchase Amount" name="total_tk" required>
        </div>

        <div>
            <label for="district" class="text-white dark:text-gray-200">Quantity</label>
            <input type="number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="quantity" placeholder="Purchase Amount" name="quantity" required>
        </div>

        <div >
            <label for="invoice" class="text-white dark:text-gray-200">Invoice Number</label>
            <input type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="invoice" placeholder="Invoice Number" name="invoice">
        </div>
                </div>
        
                <div class="flex justify-end mt-6">
                    <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">Save</button>
                </div>
            </form>
        </section>
        <section class="lg:w-[49%] h-[98vh] w-[100%] p-3 mx-auto bg-red-900 rounded-md shadow-md dark:bg-gray-800 mt-2">
          <h1 class="text-xl font-bold text-white capitalize dark:text-white"><i class="bi bi-person-lines-fill mr-2"></i>Ticket Selling List</h1>
          <section class="antialiased bg-gray-100 text-gray-600 mt-3">
            <div class="flex flex-col justify-center h-full">
                <!-- Table -->
                <div class="w-full max-w-3xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                    
                    <div class="p-2">
                        <div class="overflow-x-auto overflow-y-auto h-[85vh] lg:h-[85vh]">
                            <table class="table table-bordered border-primary w-full" id="passengertable">
                                <thead>
                                  <tr>
                                    <th scope="col">Serial Number</th>
                                    <th scope="col">Buy Form</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Purchase Tk</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Per Visa</th>
                                    <th scope="col">Invoice</th>
                                    <th scope="col">Actions</th>
                                  </tr>
                                </thead>
                        
                                <tbody>
                                 
                                  @foreach ($visa as $index=>$visa)
                                  <tr>
                                      <td>{{ $index + 1 }}</td>
                                      <td>{{ $visa->buy_form ?? 'N/A' }}</td>
                                      <td>{{ $visa->company ?? 'N/A' }}</td>
                                      <td>{{ $visa->country ?? 'N/A' }}</td>
                                      <td>{{ $visa->purchase_tk ?? 'N/A' }}</td>
                                      <td>{{ $visa->quantity ?? 'N/A' }}</td>
                                      <td>{{ $visa->per_visa ?? 'N/A' }}</td>
                                      <td>{{ $visa->invoice ?? 'N/A' }}</td>
                      
                                      <td>
                                        <a href="{{ route('view', $visa->id) }}"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('edit', $visa->id) }}"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('delete', $visa->id) }}"><i class="fas fa-trash"></i></a>
                                      </td>
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
        $('#addvisa').submit(function(event) {
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