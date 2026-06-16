@props([
    'message' => 'Default message',
    'status' => 'info',
    'duration' => 3000,
])

<script type="module">
    const message = @json($message);
    const status = @json($status);
    const duration = @json($duration);

    showToast(message, status, duration, 'top-right');
</script>
