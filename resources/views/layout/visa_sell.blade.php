<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Personal Accounts</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

  @include('layout.head')
 <style>
  body {
      margin: 0;
      padding: 0;
  }

</style>


</head>

<body class="">
  <div class="relative min-h-screen md:flex" data-dev-hint="container">
   
    @include('layout.sidebar')
   
    
    
    <main id="content" class="flex-1 px-6 lg:px-8">
      <div class=" mx-auto flex gap-x-2 lg:flex-nowrap flex-wrap">
          <!-- Replace with your content -->
          <section class="lg:w-[49%] h-[98vh] w-[100%] p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-2">
            <h1 class="text-xl font-bold text-white capitalize dark:text-white"><i class="bi bi-pencil-square mr-2"></i>Visa Selling Entry</h1>
            <form class="row g-3" id="addcompany" action="{{ route('user/visa_sell') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div>
                        <label for="pnumber" class="text-white dark:text-gray-200">Company Name</label>
                          <select class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="companyloadinvoice" name="company" required>
                            <option value="">Select Company</option> <!-- Default option -->
                            @foreach($company as $companys)
                                <option value="{{ $companys->id }}">{{ $companys->name }}</option>
                            @endforeach
                          </select>
                    </div>
                    <div>
                        <label for="pnumber" class="text-white dark:text-gray-200">Invoice Number</label>
                        <select class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="invoiceoption" name="invoiceoption" required>
                            <option value="">Select an option</option>
                        </select>
                      </div>
                      <div>
                        <label for="pnumber" class="text-white dark:text-gray-200">Avaiable Visa</label>
                        <input type="number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"  id="available_visa" name="available_visa" readonly>
                      </div>
                      <div>
                        <label for="pnumber" class="text-white dark:text-gray-200">Price</label>
                        <input type="number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="price_per_visa" name="price_per_visa" readonly>
                      </div>
                      <div>
                        <label for="agent" class="text-white dark:text-gray-200">Agent</label>
                        <select class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"  id="agentoption" name="agent">
                            <option value="">Select an Agent</option> <!-- Default option -->
                            @foreach($agent as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div>
                        <label for="agent" class="text-white dark:text-gray-200">Passanger</label>
                        <select class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="sellpassenger" name="sellpassenger">
                            <option value="">Select a passanger</option> <!-- Default option -->
                        </select>
                      </div>
                      <div class=>
                        <label for="agent" class="text-white dark:text-gray-200">Quantity</label>
                        <input type="number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"  id="sellquatity" name="sellquatity">
                      </div>
                      <div>
                        <label for="agent" class="text-white dark:text-gray-200">Price Per Visa</label>
                        <input type="number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"  id="price_per" name="price">
                      </div>
                      <div>
                        <label for="agent" class="text-white dark:text-gray-200">Total</label>
                        <input type="number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="total" name="total" readonly>
                      </div>



        
                    {{-- <div>
                        <label class="text-white dark:text-gray-200" for="pnumber">Agent Phone</label>
                        <input type="text" id="pnumber" name="pnumber" minlength="0" maxlength="9" required placeholder="Phone Number" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    </div>
        
                    <div>
                        <label class="text-white dark:text-gray-200" for="address">Address</label>
                        <input type="text" id="address" placeholder="Address" name="address" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring">
                    </div>
                    <div class="">
                      <label for="image_file" class="text-white dark:text-gray-200">Profile Image</label>
                      <input type="file" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="image_file" name="image_file">
                 </div>
      
                  <div class="">
                      <label for="passport_pic" class="text-white dark:text-gray-200">Upload ID Card</label>
                      <input type="file" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="id_card" name="id_card">
                  </div>
                   
                  
                </div> --}}
        
                <div class="flex justify-end mt-6">
                    <button class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600" type='submit'>Sell Visa</button>
                </div>
            </form>

          
        </section>
        <div id="imageModal" class="modal">
          <span class="close" id="closeModal">&times;</span>
          <img class="modal-content" id="modalImage">
        </div>
          <section class="lg:w-[49%] h-[98vh] w-[100%] p-3 mx-auto bg-red-900 rounded-md shadow-md dark:bg-gray-800 mt-2">
            <h1 class="text-xl font-bold text-white capitalize dark:text-white"><i class="bi bi-person-lines-fill mr-2"></i>Visa Selling List</h1>
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
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Total Purchase</th>
                                        <th scope="col">Total Sell</th>
                                        <th scope="col">Profit</th>
                                        <th scope="col">Actions</th>
                                      </tr>
                                </thead>
                        
                                <tbody>
           
                                    @foreach ($company as $index=>$company)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $company->name ?? 'N/A' }}</td>
                                        <td>{{ $company->description ?? 'N/A' }}</td>
                                        <td>{{ $company->total_purchase ?? '-' }}</td>
                                        <td>{{ $company->total_sell ?? '-' }}</td>
                                        <td>{{ $company->profit ?? '-' }}</td>
                        
                                        <td>
                                          <a href="{{ route('view', $company->id) }}"><i class="fas fa-eye"></i></a>
                                          <a href="{{ route('edit', $company->id) }}"><i class="fas fa-edit"></i></a>
                                          <a href="{{ route('delete', $company->id) }}"><i class="fas fa-trash"></i></a>
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

        $('#sellquatity, #price_per').on('change', calculateTotal);

function calculateTotal() {
  var quantity = parseFloat($('#sellquatity').val()) || 0;
  var pricePerVisa = parseFloat($('#price_per').val()) || 0;
  var total = quantity * pricePerVisa;
  $('#total').val(total);
}

        $('#companyloadinvoice').change(function() {
   var comid = $(this).val();
   $.ajax({
      type: "GET",
      url: '/load-invoice/' + comid,
      success: function(response) {
         var selectElement = $('#invoiceoption');

         // Clear existing options, except the default option
         selectElement.find('option:not(:first)').remove();

         if (response.length > 0) {
            $.each(response, function(index, item) {
               selectElement.append($('<option>', {
                  value: item.id,
                  text: item.invoice
               }));
            });
         } else {
            console.log("No data found in the response.");
         }
      },
      error: function(error) {
         console.error(error);
      }
   });
});


$('#agentoption').change(function() {
   var comid = $(this).val();
  
   $.ajax({
      type: "GET", 
      url: '/load-passanger/' + comid, 
      success: function(response) {
        // console.log(response);
         if (response.length > 0) {

            var selectElement = $('#sellpassenger');
            selectElement.find('option:not(:first)').remove();
            $.each(response, function(index, item) {
              var option = $('<option>', {
                  value: item.id,
                  text: item.passenger_name
              });
              selectElement.append(option);
            });

         } else {
            console.log("No data found in the response.");
         }
      },
      error: function(error) {
         console.error(error);
      }
   });
});
$('#agentoptionpurchase').change(function() {
   var comid = $(this).val();
   var type  = $('#select_type').val();
   $.ajax({
      type: "GET", 
      url: '/load-' + type + '/' + comid,
      success: function(response) {
        // console.log(response);
         if (response.length > 0) {

            var selectElement = $('#sellpassengerpurchase');
            selectElement.find('option:not(:first)').remove();
            $.each(response, function(index, item) {
              var option = $('<option>', {
                  value: item.id,
                  text: item.passenger_name
              });
              selectElement.append(option);
            });

         } else {
            console.log("No data found in the response.");
         }
      },
      error: function(error) {
         console.error(error);
      }
   });
});

$('#invoiceoption').change(function() {
   var comid = $(this).val();
  
   $.ajax({
      type: "GET", 
      url: '/load-visa-details/' + comid, 
      success: function(response) {
        console.log(response);
        $.each(response, function(index, item) {
          $('#available_visa').val(item.quantity);
          $('#price_per_visa').val(item.per_visa);
        });
        
      },
      error: function(error) {
         console.error(error);
      }
   });
});





    $('#addcandidate').submit(function(event) {
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
                    }).then(function() {
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                    });
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