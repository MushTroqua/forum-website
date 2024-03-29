<!DOCTYPE HTML>
    <html>
        <head>
            <title>Website for ICS2609</title>
            <link rel="stylesheet" href="style.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        </head>
        <body>
            <div id="body-container">
                <div id="title-bar" class="row">
                    <div class="col">
                        <h1>Website Title</h1>
                    </div>
                    <div class="col-5">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="search-bar" placeholder="Search..." aria-label="Search">
                            <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    <div class="col" id="user-info">
                        <div id="user-info-content">
                            <div class="btn-group">
                                <button type="button" class="btn">Username here <img src="assets/avatar.png" id="user-avatar"></button>
                                <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-lg-2" id="left-content-box">
                        <div class="d-grid gap-2 col-6 mx-auto" id="left-content-box-buttons">
                            <button class="btn" type="button"><i class="bi bi-house-door-fill"></i> Home</button>
                            <button class="btn" type="button"><i class="bi bi-list"></i> Categories</button>
                            <button class="btn" type="button"><i class="bi bi-plus"></i> New Post</button>
                            <hr>
                            <p class="d-inline-flex gap-1">
                                <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#community" aria-expanded="false" aria-controls="community">
                                    Communities <i class="bi bi-arrow-down-short"></i>
                                </button>
                            </p>
                            <div class="collapse" id="community">
                                <div>
                                    <a class="btn" href="#"><img src="assets/cics.png" id="dropdown-community-icons">CICS</a>
                                    <a class="btn" href="#"><img src="assets/nurs.png" id="dropdown-community-icons">Nursing</a>
                                    <a class="btn" href="#"><img src="assets/avm.png" id="dropdown-community-icons">AVM</a>
                                    <a class="btn" href="#"><img src="assets/educ.png" id="dropdown-community-icons">Education</a>
                                    <a class="btn" href="#"><img src="assets/fop.png" id="dropdown-community-icons">Pharmacy</a>
                                    <a class="btn" href="#"><img src="assets/cfad.png" id="dropdown-community-icons">CFAD</a>
                                </div>
                            </div>
                            <p class="d-inline-flex gap-1">
                                <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#settings" aria-expanded="false" aria-controls="settings">
                                    Settings <i class="bi bi-arrow-down-short"></i>
                                </button>
                            </p>
                            <div class="collapse" id="settings">
                                <div>
                                    <a class="btn" href="#"><i class="bi bi-person"></i> Profile</a>
                                    <a class="btn" href="#"><i class="bi bi-question-circle"></i> Support</a>
                                    <a class="btn" href="#"><i class="bi bi-moon"></i>Display</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col" id="center-content-box">
                        text
                    </div>
                    <div class="col-lg-2" id="right-content-box">
                    </div>
                </div>
            </div>
        </body>
    </html>