<section class="container py-5">
    <h2 class="text-center mb-5">Sản Phẩm Nổi Bật</h2>

    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            $products = [["id" => 1, "name" => "Bò Sát 1", "desc" => "Bò sát độc đáo, đẹp mắt, dễ chăm sóc.", "image" => "https://res.cloudinary.com/dwgfko4zr/image/upload/v1733316973/Shoppet/sirp6o3qzftgag4vhipe.jpg", "price" => "1,000,000 VND", "link" => "product.php?id=1"],
                ["id" => 2, "name" => "Bò Sát 2", "desc" => "Chúng tôi cung cấp các loại bò sát đẹp mắt.", "image" => "https://res.cloudinary.com/dwgfko4zr/image/upload/v1733316973/Shoppet/sirp6o3qzftgag4vhipe.jpg", "price" => "1,200,000 VND", "link" => "product-detail.php?id=2"],
                ["id" => 3, "name" => "Bò Sát 3", "desc" => "Các giống bò sát chất lượng cao.", "image" => "https://res.cloudinary.com/dwgfko4zr/image/upload/v1733316973/Shoppet/sirp6o3qzftgag4vhipe.jpg", "price" => "1,500,000 VND", "link" => "product-detail.php?id=3"],
                ["id" => 4, "name" => "Bò Sát 4", "desc" => "Thú cưng hoàn hảo, thu hút mọi ánh nhìn.", "image" => "https://res.cloudinary.com/dwgfko4zr/image/upload/v1733316973/Shoppet/sirp6o3qzftgag4vhipe.jpg", "price" => "1,800,000 VND", "link" => "product-detail.php?id=4"],
                ["id" => 5, "name" => "Bò Sát 5", "desc" => "Bò sát dễ thương và thân thiện.", "image" => "https://res.cloudinary.com/dwgfko4zr/image/upload/v1733316973/Shoppet/sirp6o3qzftgag4vhipe.jpg", "price" => "2,000,000 VND", "link" => "product-detail.php?id=5"],
                ["id" => 6, "name" => "Bò Sát 6", "desc" => "Bò sát cảnh đẹp mắt và dễ chăm sóc.", "image" => "https://res.cloudinary.com/dwgfko4zr/image/upload/v1733316973/Shoppet/sirp6o3qzftgag4vhipe.jpg", "price" => "1,700,000 VND", "link" => "product-detail.php?id=6"],
                ["id" => 7, "name" => "Bò Sát 7", "desc" => "Bò sát cảnh độc lạ cho người yêu thú cưng.", "image" => "https://res.cloudinary.com/dwgfko4zr/image/upload/v1733316973/Shoppet/sirp6o3qzftgag4vhipe.jpg", "price" => "2,500,000 VND", "link" => "product-detail.php?id=7"],
                ["id" => 8, "name" => "Bò Sát 8", "desc" => "Dòng bò sát quý hiếm từ tự nhiên.", "image" => "https://res.cloudinary.com/dwgfko4zr/image/upload/v1733316973/Shoppet/sirp6o3qzftgag4vhipe.jpg", "price" => "3,000,000 VND", "link" => "product-detail.php?id=8"],
                ["id" => 9, "name" => "Bò Sát 9", "desc" => "Chọn ngay thú cưng đặc biệt này!", "image" => "https://res.cloudinary.com/dwgfko4zr/image/upload/v1733316973/Shoppet/sirp6o3qzftgag4vhipe.jpg", "price" => "1,900,000 VND", "link" => "product-detail.php?id=9"],
                ["id" => 10, "name" => "Bò Sát 10", "desc" => "Bò sát cảnh thông minh và dễ nuôi.", "image" => "https://res.cloudinary.com/dwgfko4zr/image/upload/v1733316973/Shoppet/sirp6o3qzftgag4vhipe.jpg", "price" => "1,300,000 VND", "link" => "product-detail.php?id=10"],
                ["id" => 11, "name" => "Bò Sát 11", "desc" => "Thú cưng an toàn, phù hợp mọi lứa tuổi.", "image" => "https://res.cloudinary.com/dwgfko4zr/image/upload/v1733316973/Shoppet/sirp6o3qzftgag4vhipe.jpg", "price" => "2,200,000 VND", "link" => "product-detail.php?id=11"],
                ["id" => 12, "name" => "Bò Sát 12", "desc" => "Một món quà tuyệt vời cho người thân yêu.", "image" => "https://res.cloudinary.com/dwgfko4zr/image/upload/v1733316973/Shoppet/sirp6o3qzftgag4vhipe.jpg", "price" => "3,200,000 VND", "link" => "product-detail.php?id=12"],
          
                  ];

            $chunks = array_chunk($products, 4);
            $active = 'active';
            foreach ($chunks as $chunk) {
                echo '<div class="carousel-item ' . $active . '">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">';
                foreach ($chunk as $product) {
                    echo '<div class="col">
                            <div class="card product-card h-100">
                                <a href="' . $product['link'] . '">
                                    <img src="' . $product['image'] . '" class="card-img-top" alt="' . $product['name'] . '">
                                </a>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-truncate">' . $product['name'] . '</h5>
                                    <p class="card-text flex-grow-1 text-truncate-2">' . $product['desc'] . '</p>
                                    <p class="card-price">' . $product['price'] . '</p>
                                    <a href="cart.php?add=' . $product['id'] . '" class="btn btn-success mt-2">Thêm vào Giỏ hàng</a>
                                </div>
                            </div>
                        </div>';
                }
                echo '</div></div>';
                $active = '';
            }
            ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>