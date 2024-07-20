document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('.link'); // Select all links
    const spinner = document.getElementById('loading-spinner');

    links.forEach(link => {
        link.addEventListener('click', (event) => {
            // Show the loading spinner
            spinner.style.display = 'block';
        });
    });

    // Hide the spinner once the page is fully loaded
    window.addEventListener('load', () => {
        spinner.style.display = 'none';
    });

     // Listen for form submit event
     document.getElementById('guardianSignupForm').addEventListener('submit', function () {
        // Show loading spinner
        document.getElementById('loading-spinner').style.display = 'block';
    });
});
