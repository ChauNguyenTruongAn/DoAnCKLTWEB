<div class="product-grid container">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        <?php
        include('../components/breadcrumbs.php');
        $products = [
            ["id" => 1, "name" => "Bò Sát 1", "desc" => "Bò sát đẹp mắt.", "image" => "https://via.placeholder.com/150", "price" => "1,000,000 VND"],
            ["id" => 2, "name" => "Bò Sát 2", "desc" => "Dễ chăm sóc.", "image" => "https://via.placeholder.com/150", "price" => "1,200,000 VND"],
            ["id" => 3, "name" => "Bò Sát 3", "desc" => "Chất lượng cao.", "image" => "https://via.placeholder.com/150", "price" => "1,500,000 VND"],
        ];

        foreach ($products as $product) {
            include 'components/product-card.php';
        }
        ?>
    </div>
</div>