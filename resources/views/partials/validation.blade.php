<script>

    /* client-side validation */
    const inputs = document.querySelectorAll("input, select, textarea");

        inputs.forEach(input => {
        input.addEventListener(
            "invalid",
            event => {
            input.classList.add("error");
            },
            false
        );
        });
    </script>