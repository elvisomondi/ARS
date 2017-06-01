<script type="text/javascript">
    function onsubmit() {
        if (some value is/is not something) {
            // something is wrong
            alert('alert user of problem');
            return false;
        }
        else if (another value is/is not something) {
            // something else is wrong
            alert('alert user of problem');
            return false;
        }

        // If the script makes it to here, everything is OK,
        // so you can submit the form

        return true;
    }
</script>