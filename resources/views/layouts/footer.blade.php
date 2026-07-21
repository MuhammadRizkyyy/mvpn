<footer class="bg-white text-dark py-4 mt-auto shadow-sm">
    <div class="container text-center">
    <p class="mb-0">{{ __('site.footer.copyright', ['year' => date('Y')]) }}</p>
</footer>
<style>
    footer {
        margin-top: auto;
    }

    body, html {
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
