<!DOCTYPE html>


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
      <!-- SideBar Starts -->
   
     @include('layout.sidebar')
      <!-- SideBar Ends -->
      <main id="content" class="flex-1 px-6 lg:px-8 flex justify-center items-center">
       <h1 class="text-4xl font-bold">This is the Home Page</h1> 
      </main>
  </div>
  @include('layout.script')
 
</body>
</html>
