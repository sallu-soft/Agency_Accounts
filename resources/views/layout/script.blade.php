
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>



<script src="{{asset('assets/js/main.js')}}"></script>
<script>
    // Get modal elements
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.getElementById('closeModal');
  
    // Get all image elements with the 'image-popup' class
    const imagePopups = document.querySelectorAll('.image-popup');
  
    // Add click event listeners to open the modal
    imagePopups.forEach((image) => {
      image.addEventListener('click', (e) => {
        modal.style.display = 'block';
        modalImage.src = e.target.src;
      });
    });
  
    // Close the modal when the close button is clicked
    closeModal.addEventListener('click', () => {
      modal.style.display = 'none';
    });
  
    // Close the modal when clicking outside the image
    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.style.display = 'none';
      }
    });
  </script>