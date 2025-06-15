<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'btn btn-lg rounded px-4 red-outline-btn-custom'
]) }}>
    {{ $slot }}
</button>
<style>
.red-outline-btn-custom {
    background-color: rgba(226, 26, 34, 0.08) !important;
    color: #E21A22 !important;
    border: 1px solid #E21A22 !important;
    line-height: 1.5;
    padding: 0.5rem 1.5rem;
    transition: background 0.2s, color 0.2s;
}
.red-outline-btn-custom:hover,
.red-outline-btn-custom:focus {
    background-color: rgba(226, 26, 34, 0.2) !important;
    color: #E21A22 !important;
}
</style>
