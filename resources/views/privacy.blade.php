<x-app-layout>
    <div class="bg-danger" style="height: 180px; background: linear-gradient(to right, #ff7c7c, #ffbaba);">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <h2 class="text-white fw-bold">🔒 Privacy Policy</h2>
        </div>
    </div>

    <div class="container py-5">
        <h3 class="fw-bold mb-4">Your Privacy Matters to Us</h3>

        <p>
            At <strong>CaroulSell</strong>, we are committed to protecting your privacy and ensuring a safe online shopping experience. This Privacy Policy explains how we collect, use, and protect your personal information.
        </p>

        <h5 class="fw-bold mt-4">1. What Information We Collect</h5>
        <ul>
            <li><strong>Account Information:</strong> Name, email, phone number, and password.</li>
            <li><strong>Order Information:</strong> Shipping address, billing address, and purchase history.</li>
            <li><strong>Payment Information:</strong> Securely processed through Stripe; no card info stored on our servers.</li>
        </ul>

        <h5 class="fw-bold mt-4">2. How We Use Your Data</h5>
        <ul>
            <li>To fulfill and manage orders.</li>
            <li>To improve customer service and your shopping experience.</li>
            <li>To send order notifications and delivery updates.</li>
        </ul>

        <h5 class="fw-bold mt-4">3. Data Protection</h5>
        <p>
            We implement strict security protocols. All payments are handled securely via Stripe, with no card data stored.
        </p>

        <h5 class="fw-bold mt-4">4. No Sharing Policy</h5>
        <p>
            We do not sell or rent your personal data. It is only shared with trusted providers when necessary (e.g., delivery, payment gateway).
        </p>

        <h5 class="fw-bold mt-4">5. Consent and Updates</h5>
        <p>
            By using CaroulSell, you agree to our policy. We may update this page periodically to reflect changes.
        </p>

        <hr class="my-4">
        <p class="text-muted small">
            Last updated: {{ \Carbon\Carbon::now()->format('F d, Y') }}
        </p>

        {{-- Return Button --}}
        <div class="text-end mt-4">
            <a href="{{ url()->previous() }}" class="btn btn-outline-dark">
                ← Return
            </a>
        </div>
    </div>
</x-app-layout>

