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
    <link rel="stylesheet" href="../styles/style.css"/>
    <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
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
@include('layout.head')
</head>
<body class="">
  <div class="relative min-h-screen md:flex" data-dev-hint="container">
   
    @include('layout.sidebar')
   
    
    
    <main id="content" class="flex-1 px-6 lg:px-8">
      <div class=" mx-auto flex gap-x-1 lg:flex-nowrap flex-wrap">
          <!-- Replace with your content -->
          <section class="lg:w-[49%] h-[98vh] w-[100%] p-6 mx-auto bg-indigo-600 rounded-md shadow-md dark:bg-gray-800 mt-2">
            <h1 class="text-xl font-bold text-white capitalize dark:text-white"><i class="bi bi-pencil-square mr-2"></i>Passenger Entry</h1>
            <form class="row g-3" id="addpassenger" action="{{ route('user/passenger') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                    <div>
                        <label class="text-white dark:text-gray-200" for="Agent">Agent</label>
                        <select class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="agent" name="agent">
                            <option value="">Select an Agent</option> <!-- Default option -->
                            @foreach($agent as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-white dark:text-gray-200" for="passwordConfirmation">Passport</label>
                        <input type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="passport" placeholder="Passport" name="passport"  minlength="0" maxlength="9" required>
                    </div>
                    <div>
                        <label class="text-white dark:text-gray-200" for="pname">Passenger Name</label>
                        {{-- <input id="username" type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"> --}}
                        <input type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:bord" id="passenger_name" name="passenger_name" placeholder="Passenger Name" required>
                    </div>
        
                    <div>
                        <label class="text-white dark:text-gray-200" for="emailAddress">Phone Number</label>
                        <input type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="pnumber" name="pnumber" required placeholder="Phone Number">
                    </div>
        
                    <div>
                        <label class="text-white dark:text-gray-200" for="password">Address</label>
                        
                        <input type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="address" placeholder="Address" name="address">
                    </div>
        
                    <div>
                        <label class="text-white dark:text-gray-200" for="passwordConfirmation">District</label>
                      
                        <input type="text" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="district" placeholder="District" name="district">
                    </div>

                   
                   
                   <div class="">
                        <label for="image_file" class="text-white dark:text-gray-200">Image File</label>
                        <input type="file" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="image_file" name="image_file">
                   </div>
        
                    <div class="">
                        <label for="passport_pic" class="text-white dark:text-gray-200">Passport Copy</label>
                        <input type="file" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring" id="passport_pic" name="passport_pic">
                    </div>
                </div>
        
                <div class="flex justify-end mt-6">
                    <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-pink-500 rounded-md hover:bg-pink-700 focus:outline-none focus:bg-gray-600">Save</button>
                </div>
            </form>

           
        </section>
        <div id="imageModal" class="modal">
            <span class="close" id="closeModal">&times;</span>
            <img class="modal-content" id="modalImage">
          </div>
        <section class="lg:w-[49%] h-[98vh] w-[100%] p-3 mx-auto bg-red-900 rounded-md shadow-md dark:bg-gray-800 mt-2">
            <h1 class="text-xl font-bold text-white capitalize dark:text-white"><i class="bi bi-person-lines-fill mr-2"></i>Passenger List</h1>
            <section class="antialiased bg-gray-100 text-gray-600 mt-3">
                <div class="flex flex-col justify-center h-full">
                    <!-- Table -->
                    <div class="w-full max-w-3xl mx-auto bg-white shadow-lg rounded-sm border border-gray-200">
                        
                        <div class="p-2">
                            <div class="overflow-x-auto overflow-y-auto h-[85vh] lg:h-[85vh]">
                            <table class="table table-bordered border-primary" id="passengertable">
                                <thead>
                                  <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Agent</th>
                                    <th scope="col">Passport Number</th>
                                    <th scope="col">Passport </th>
                                    <th scope="col">Actions</th>
                                  </tr>
                            </thead>
                                  <tbody class="text-sm ">
                                    @foreach ($passengers as $index=>$passenger)
                                      <tr>
                                          <td>{{ $index+1 }}</td>
                                          <td class="p-2 whitespace-nowrap">
                                              <div class="flex items-center">
                                                  <div class="w-100 h-100 flex-shrink-0 mr-2 sm:mr-3">
                                                    @if ($passenger->image_file)
                                                        <img src="{{ asset('images/' . $passenger->image_file) }}" class="rounded-lg image-popup" alt="Agent ID Card" width="100" height="100">
                                                    @else
                                                        <img src="{{ asset('images/default.jpg') }}" alt="No Photo" width="40" height="40">
                                                    @endif
                                                  </div>
                                                  
                                              </div>
                                          </td>
                                          <td class="p-2 whitespace-nowrap">
                                            <div class="font-medium text-gray-800">{{$passenger->passenger_name}}</div>
                                          </td>
                                          <td class="p-2 whitespace-nowrap">
                                              <div class="text-left">{{$passenger->pnumber ?? '-'}}</div>
                                          </td>
                                          <td class="p-2 whitespace-nowrap">
                                              <div class="text-left font-medium text-green-500">{{$passenger->address}}</div>
                                          </td>
                                          <td class="p-2 whitespace-nowrap">
                                              <div class="text-lg text-center">{{$passenger->agent}}</div>
                                          </td>
                                          <td class="p-2 whitespace-nowrap">
                                              <div class="text-lg text-center">{{$passenger->passport}}</div>
                                          </td>
                                          <td class="p-2 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-100 h-100 flex-shrink-0 mr-2 sm:mr-3">
                                                  @if ($passenger->passport_pic)
                                                      <img src="{{ asset('images/' . $passenger->passport_pic) }}" class="image-popup" alt="Passport Card" width="100" height="100">
                                                  @else
                                                      <img src="{{ asset('images/default.jpg') }}" alt="No Photo" width="40" height="40">
                                                  @endif
                                                </div>
                                              </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('view', $item->id) }}"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('edit', $item->id) }}"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete', $item->id) }}"><i class="fas fa-trash"></i></a>
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@include('layout.script')
<script>
    
    // new DataTable('#passengertable');

    $(document).ready(function() {
        // $('#passengertable').DataTable({
        //     "searching": true, // Enable or disable search box
        // "ordering": true, // Enable or disable sorting
        // "responsive": true, // Enable or disable
        // });

        
        $('#passport').blur(function() {
            var passport = $('#passport').val();
            console.log(passport);
            $.ajax({
                url: '/check-passport/' + passport,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.exists) {
                        Swal.fire({
                            title: 'Duplicate !!!',
                            text: 'This Passport Number is already in use',
                            icon: 'warning',
                        });
                        $('#passport').val('');
                    } else {
                        // Handle non-duplicate case
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error !!!',
                        text: 'Something went wrong in passport check',
                        icon: 'error',
                    });
                }
            });
        });

        // $("#submitForm").click(function(e) {
        //     e.preventDefault(); // Prevent the default form submission

        //     // Serialize the form data
        //     var formData = $("#addpassenger").serialize();

        //     // Send the data using Ajax
        //     $.ajax({
        //         url: "{{ route('user/passenger') }}", // Your form action URL
        //         type: "POST",
        //         data: formData,
        //         success: function(response) {
        //             if (response.success) {
        //                 Swal.fire('Success', response.message, 'success');
        //             } else {
        //                 Swal.fire('Error', response.message, 'error');
        //             }
        //         },
        //         error: function() {
        //             Swal.fire('Error', 'An error occurred while processing your request.', 'error');
        //         }
        //     });
        // });

        $('#addpassenger').submit(function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: "{{ route('user/passenger') }}",
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