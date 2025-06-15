<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'btn btn-lg rounded px-4 red-btn-custom'
]) }}>
    {{ $slot }}
</button>
<style>
.red-btn-custom {
    background-color: #E21A22 !important;
    color: #fff !important;
    border: 1px solid #E21A22 !important;
    line-height: 1.5;
    padding: 0.5rem 1.5rem;
    transition: background 0.2s;
}
.red-btn-custom:hover,
.red-btn-custom:focus {
    background-color: #b9151a !important;
    color: #fff !important;
}
</style>