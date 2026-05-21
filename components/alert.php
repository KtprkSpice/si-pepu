<?php if (isset($_SESSION['success'])): ?>

    <script>
        Swal.fire({
            icon: 'success',
            title: 'success',
            text: "<?= $_SESSION['success'] ?>",
            timer: 2000,
            showConfirmButton: false
        })
    </script>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <script>
        Swal.fire({
            icon: 'error',
            titel: 'Error',
            text: "<?= $_SESSION['error'] ?>",
            timer: 2000
        })
    </script>
    <?php unset($_SESSION['error']) ?>
<?php endif; ?>