    <main> 
        <div class="container">   
            <div class="top-page">       
                <div class="row">
                    <div class="col-lg-2 mt-2">
                        <?php
                        require_once __DIR__ . '/../partials/navbar.php';         
                        ?>
                    </div>
                
                    <div class="col-lg-10 mt-2">
                        <?php
                        require_once __DIR__ . '/../partials/slide.php'; 
                        ?> 
                    </div>
                </div>
            </div>

            <div class="main-page">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="scroll">
                            <img src="/../images/banner/banner4.png" id="scroll-img1">
                            <img src="/../images/banner/banner5.png" id="scroll-img2">
                        </div>
                    </div>           
                    <div class="col-lg-10">
                        <?php
                        require_once __DIR__ . '/../public/product/load.php';   
                        ?>                   
                    </div>
                </div>
            </div>
        </div>
    </main>