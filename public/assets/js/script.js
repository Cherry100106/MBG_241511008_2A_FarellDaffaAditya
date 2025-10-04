document.addEventListener('DOMContentLoaded', function() {
    const deleteModal = document.getElementById('deleteModal');
    
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            
            const idInput = deleteModal.querySelector('#id-bahan-hapus');
            const namaSpan = deleteModal.querySelector('#nama-bahan-hapus');
            
            idInput.value = id;
            namaSpan.textContent = nama;
        });
    }
});