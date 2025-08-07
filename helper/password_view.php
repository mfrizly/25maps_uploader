<?php
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    http_response_code(403);
    exit('Akses langsung tidak diizinkan.');
}
?>

<script>
    function passwordViewer(toggle, idselector){
        const toggleButton = document.querySelector(toggle);
        const passwordInput = document.querySelector(idselector);

        toggleButton.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            } else {
            passwordInput.type = 'password';
            }
        });
    }
</script>