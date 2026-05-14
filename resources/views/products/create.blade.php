<x-layout>

<x-slot:title>
    Add Product
</x-slot:title>

<div class="hero">

    <div class="form-container">

        <!-- HEADER -->
        <div class="form-header">
            <h2>Add Product</h2>
            <p>
                Input the details for your new product,
                including inventory variants and supplier information.
            </p>
        </div>

        <!-- ERRORS -->
        @if($errors->any())
            <div class="error-box">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM -->
        <form
            action="{{ route('products.store') }}"
            method="POST"
            class="dashboard-form"
        >

            @csrf

            <!-- PRODUCT INFORMATION -->
            <div class="form-section">
                Product Information
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label>Category</label>

                    <select name="category_id" required>
                        <option value="">
                            -- Select Category --
                        </option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>New Category (Optional)</label>

                    <input
                        type="text"
                        name="new_category"
                        placeholder="Create new category"
                    >
                </div>

            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label>Product Name</label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Enter product name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>SKU</label>

                    <input
                        type="text"
                        name="sku"
                        placeholder="e.g. TS-001"
                        required
                    >
                </div>

            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label>Base Price</label>

                    <input
                        type="number"
                        step="0.01"
                        name="price"
                        placeholder="0.00"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Supplier</label>

                    <select name="supplier_id" required>
                        <option value="">
                            -- Select Supplier --
                        </option>

                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="form-group">
                <label>Description</label>

                <textarea
                    name="description"
                    rows="4"
                    placeholder="Enter product description"
                ></textarea>
            </div>

            <!-- VARIANTS -->
            <div class="form-section">
                Product Variants
            </div>

            <div class="variant-container">

                <table class="variant-table">

                    <thead>
                        <tr>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Stock</th>
                            <th>Price Override</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody id="variantTable">
                        <tr>
                            <td>
                                <input
                                    type="text"
                                    name="variants[0][size]"
                                    placeholder="Medium"
                                    required
                                >
                            </td>

                            <td>
                                <input
                                    type="text"
                                    name="variants[0][color]"
                                    placeholder="Black"
                                    required
                                >
                            </td>

                            <td>
                                <input
                                    type="number"
                                    name="variants[0][stock]"
                                    min="0"
                                    placeholder="0"
                                    required
                                >
                            </td>

                            <td>
                                <input
                                    type="number"
                                    step="0.01"
                                    name="variants[0][price_override]"
                                    placeholder="Optional"
                                >
                            </td>

                            <td>
                                <button
                                    type="button"
                                    class="remove-btn"
                                    onclick="removeRow(this)"
                                >
                                    Remove
                                </button>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <!-- ADD BUTTON -->
            <button
                type="button"
                class="btn-secondary"
                onclick="addRow()"
            >
                + Add Variant
            </button>

            <!-- ACTIONS -->
            <div class="form-actions">

                <a
                    href="{{ route('products.index') }}"
                    class="btn-secondary"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn-primary"
                >
                    Add Product
                </button>

            </div>

        </form>

    </div>

</div>

<!-- JS -->
<script>

let index = 1;

function addRow() {

    let table = document.getElementById('variantTable');

    let row = `
        <tr>

            <td>
                <input
                    type="text"
                    name="variants[${index}][size]"
                    placeholder="Size"
                    required
                >
            </td>

            <td>
                <input
                    type="text"
                    name="variants[${index}][color]"
                    placeholder="Color"
                    required
                >
            </td>

            <td>
                <input
                    type="number"
                    name="variants[${index}][stock]"
                    min="0"
                    placeholder="0"
                    required
                >
            </td>

            <td>
                <input
                    type="number"
                    step="0.01"
                    name="variants[${index}][price_override]"
                    placeholder="Optional"
                >
            </td>

            <td>
                <button
                    type="button"
                    class="remove-btn"
                    onclick="removeRow(this)"
                >
                    Remove
                </button>
            </td>

        </tr>
    `;

    table.insertAdjacentHTML('beforeend', row);

    index++;
}

function removeRow(button) {
    button.closest('tr').remove();
}

</script>

</x-layout>