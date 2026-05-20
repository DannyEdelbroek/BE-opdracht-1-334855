<div id="loading-bar" class="fixed top-0 left-0 w-full h-1 bg-blue-500 z-50">
    <div class="h-full bg-blue-700 animate-pulse w-1/4"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loadingBar = document.getElementById('loading-bar');
        const barFill = loadingBar.querySelector('div');
        let width = 25;

        // Gradually increase width
        const interval = setInterval(() => {
            if (width < 90) {
                width += Math.random() * 30;
                barFill.style.width = width + '%';
            }
        }, 200);

        // Redirect after delay
        setTimeout(() => {
            clearInterval(interval);
            barFill.style.width = '100%';
            const user = @json(Auth::user());
            if (user) {
                window.location.href = user.redirect_url || '{{ route('dashboard') }}';
            }
        }, 1500);
    });
</script>
