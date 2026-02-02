<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Products - Tote_Tales</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">

</head>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-center text-purple-700">Admin Product Management</h1>

        <!-- Add Product Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">Add New Product</h2>
            <form id="addProductForm" class="space-y-4">
                <div>
                    <input type="text" name="name" placeholder="Product Name" required
                        class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400">
                </div>
                <div>
                    <input type="number" step="0.01" name="price" placeholder="Price" required
                        class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400">
                </div>
                <div>
                    <input type="number" name="quantity" placeholder="Quantity" required
                        class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400">
                </div>
                <div>
                    <select name="category_id" class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-400">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <input type="file" name="image" class="w-full p-3 border rounded-lg">
                </div>
                <button type="submit"
                    class="w-full bg-purple-600 text-white font-bold p-3 rounded-lg hover:bg-purple-700 transition">
                    Add Product
                </button>
            </form>
        </div>

        <!-- Products List -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6" id="products">
            <!-- Products will be loaded here via JS -->
        </div>
    </div>

    <script>
        // CSRF token for Axios
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Fetch all products
        function fetchProducts() {
            axios.get('/api/admin/products')
                .then(res => {
                    const container = document.getElementById('products');
                    container.innerHTML = '';
                    res.data.forEach(p => {
                        const lowStock = p.quantity <= 5 ? '<span class="text-red-600 font-bold">Low Stock!</span>' : '';
                        container.innerHTML += `
                            <div class="bg-white p-4 rounded-lg shadow-md relative">
                                ${p.image ? `<img src="/storage/${p.image}" class="w-full h-40 object-cover mb-2 rounded">` : ''}
                                <h3 class="text-xl font-bold mb-1">${p.name} ${lowStock}</h3>
                                <p class="text-gray-700 mb-1">Price: $${p.price}</p>
                                <p class="text-gray-700 mb-3">Stock: ${p.quantity}</p>
                                <div class="flex gap-2">
                                    <button onclick="deleteProduct(${p.id})" class="bg-red-500 text-white p-2 rounded hover:bg-red-600 transition">
                                        Delete
                                    </button>
                                    <button onclick="purchaseProduct(${p.id})" class="bg-green-500 text-white p-2 rounded hover:bg-green-600 transition">
                                        Purchase 1
                                    </button>
                                </div>
                            </div>
                        `;
                    });
                })
                .catch(err => console.error(err));
        }

        // Add product
        document.getElementById('addProductForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            axios.post('/api/admin/products', formData)
                .then(res => {
                    Swal.fire('Success', 'Product added!', 'success');
                    this.reset();
                    fetchProducts();
                })
                .catch(err => Swal.fire('Error', err.response.data.message || 'Error', 'error'));
        });

        // Delete product
        function deleteProduct(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This will delete the product permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/api/admin/products/${id}`)
                        .then(() => {
                            Swal.fire('Deleted!', 'Product has been deleted.', 'success');
                            fetchProducts();
                        });
                }
            });
        }

        // Purchase product
        function purchaseProduct(id) {
            axios.post(`/api/admin/products/${id}/purchase`, { quantity: 1 })
                .then(() => {
                    Swal.fire('Success', 'Purchased 1 item.', 'success');
                    fetchProducts();
                })
                .catch(err => Swal.fire('Error', err.response.data.message || 'Error', 'error'));
        }

        // Initial fetch
        fetchProducts();
    </script>

</body>
</html>
