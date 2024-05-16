<?php
    include "header-menu.php";
?>
<body>
    <div id="contact-container" class="container">
    <a href='index.php'>< Go Back</a>
        <div class="container">
            <h1>Contact Us</h1>
            <form method="GET">
                <div class="row">
                    <div class="col">
                        <label for="fname">First Name:</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="col">
                        <label for="lname">Last Name:</label>
                        <input class="form-control" type="text">
                    </div>
                </div>
                <label for="username">Email:</label>
                <input type="text" class="form-control" name="email" required autocomplete="off"><br>
                <label for="password">Comment:</label>
                <textarea class="form-control"  name="text-body" rows="4" cols="50"></textarea><br>
                <button class="btn btn-warning" type="submit">Submit</button>
                </form>
        </div>
    </div>
</body>