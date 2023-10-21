<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.3/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  <script src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
    
   <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              clifford: '#da373d',
            }
            backgroundImage: {
        'hero-pattern': "url('/public/images/hero1.jpg')",
        'profile-bg': "url('/profile-bg.jpg')",
        'footer-texture': "url('/img/footer-texture.png')",
      }
          }
        }
      }
    </script>
    <style type="text/css">
    #sidebar {
    --tw-translate-x: -100%;
}
#menu-close-icon {
    display: none;
}

#menu-open:checked ~ #sidebar {
    --tw-translate-x: 0;
}
#menu-open:checked ~ * #mobile-menu-button {
    background-color: rgba(31, 41, 55, var(--tw-bg-opacity));
}
#menu-open:checked ~ * #menu-open-icon {
    display: none;
}
#menu-open:checked ~ * #menu-close-icon {
    display: block;
}

@media (min-width: 768px) {
    #sidebar {
        --tw-translate-x: 0;
    }
}

    </style>
    <style>
      /* Style for the modal */
      .modal {
        display: none;
        position: fixed;
        
        padding-top: 50px;
        left: 0;
        top: 0;
        z-index: 999;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
      }
    
      /* Style for the modal content */
      .modal-content {
        display: block;
        margin: 0 auto;
        max-width: 80%;
        max-height: 80%;
        object-fit:scale-down;
      }
    
      /* Style for the close button */
      .close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 30px;
        color: #fff;
        cursor: pointer;
      }
    </style>