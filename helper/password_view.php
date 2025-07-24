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