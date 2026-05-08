<x-layout>

<x-slot:title>
    Add Supplier
</x-slot:title>

<div class="hero">

    <div class="form-container">

        <!-- HEADER -->
        <div class="form-header">
            <h2>Add Supplier</h2>
            <p>
                Add supplier details including contact information
                and company logo.
            </p>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('suppliers.store') }}" enctype="multipart/form-data" class="dashboard-form" >

            @csrf

            <!-- COMPANY NAME -->
            <div class="form-group">
                <label>Company Name</label>

                <input
                    type="text"
                    name="name"
                    placeholder="Enter company name"
                    required
                >
            </div>

            <!-- SECTION TITLE -->
            <div class="form-section">
                Contact Details
            </div>

            <!-- TWO COLUMN GRID -->
            <div class="form-grid">

                <div class="form-group">
                    <label>Email Address</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="supplier@email.com"
                    >
                </div>

                <div class="form-group">
                    <label>Phone Number</label>

                    <input
                        type="text"
                        name="phone"
                        placeholder="+63 912 345 6789"
                    >
                </div>

            </div>

            <!-- ADDRESS -->
            <div class="form-group">
                <label>Address</label>

                <textarea
                    name="address"
                    rows="4"
                    placeholder="Enter supplier address"
                ></textarea>
            </div>

            <!-- inputs logo -->
            <div class="form-group">
                <label>Company Logo</label>

                <input type="file" name="logo" class="file-input" >
            </div>

            <!-- BUTTONS -->
            <div class="form-actions">

                <a href="{{ route('suppliers.index') }}" class="btn-secondary">
                    Cancel
                </a>

                <button type="submit" class="btn-primary">
                    Save Supplier
                </button>

            </div>

        </form>

    </div>

</div>

</x-layout>