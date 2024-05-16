<?php
    include "header-menu.php";
    require_once "database.php";

    try {
        $pdo = new PDO($attr, $user, $pw, $opts);
        //echo "Database Connected";
    } catch(PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    if(isset($_GET['id'])) {
        $post_id = $_GET['id'];
        
        $query = "SELECT * FROM UserPost WHERE PostID = :post_id";
        $stmt_post = $pdo->prepare($query);
        $stmt_post->execute(['post_id' => $post_id]);

        $post = $stmt_post->fetch(PDO::FETCH_ASSOC);

    } else {
        header("Location: index.php");
        exit();
    }

?>


<body>
    <div id="post-container" class="container">
        <b><a onclick="history.back()" id="login-links"  style="font-size:110%;cursor:pointer;">< Go Back</a></b><br><br>
        <div class="post-details">
            <p><?php echo htmlspecialchars_decode($post["Username"]);echo " | ". htmlspecialchars_decode($post["Date_Submitted"]); ?></p>
            <h2><?php echo htmlspecialchars_decode($post["Title"]); ?></h2><br>
            <p style="font-size: large;"><?php echo htmlspecialchars_decode($post["Body"]); ?></p>
        </div>
        <div class="comment-section">
            <div class="reply-form">
                <form action="submit_reply.php" method="post">
                    <?php 
                        $randomNumber = rand(100000, 999999);
                        $generate_userID = $randomNumber;
                    ?>
                    <h1>Comment</h1>
                    <input type="hidden" name="comment_id" value="<?php echo $generate_userID ?>">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <input type="hidden" id="reply_username" name="reply_username" value="<?php if(!isset($_SESSION['username'])) { echo "You are not logged in"; } else { echo $_SESSION['username']; } ?>">
                    <input type="hidden" name="date_submitted" value="<?php $date = date("Y-m-d"); echo $date;?>">
                    <?php 
                        if(!isset($_SESSION['username'])) { ?>
                            <textarea id="reply_body" name="reply_body" rows="5" cols="150" disabled></textarea>
                        <?php } else { ?> 
                            <textarea id="reply_body" name="reply_body" rows="5" cols="150" oninput="checkTextArea()"></textarea>
                        <?php }
                    ?>
                    
                    <br><br><button class="btn btn-warning" type="submit" id="submit_button" disabled>Post a Reply</button>
                    <script>
                        function checkTextArea() {
                            var textAreaValue = document.getElementById("reply_body").value;
                            var submitButton = document.getElementById("submit_button");

                            if(textAreaValue.trim() === "") {
                                submitButton.disabled = true;
                            } else {
                                submitButton.disabled = false;
                            }
                        }
                    </script>
                </form>
            </div><br>
            <hr>
            <?php 
                $query_comments = "SELECT * FROM comments WHERE PostID = :post_id ORDER BY CommentDate DESC";
                $stmt_comments = $pdo->prepare($query_comments);
                $stmt_comments->execute(['post_id' => $post_id]);

                while($comments = $stmt_comments->fetch(PDO::FETCH_ASSOC)) {
                    if(!empty($comments['Username']) || !empty($comments['CommentBody'] || !empty($comments['CommentDate']))) {

                        echo "<div class='comment-sec'>";
                        echo "<div class='dropdown' style='background-color:inherit;text-align:right;'>";
                        if(isset($_SESSION['username']) && $_SESSION['username'] === $comments['Username']) {
                            echo "<a class='btn' data-bs-toggle='dropdown' aria-expanded='false'><i class='bi bi-three-dots'></i></a>";
                            echo "<ul class='dropdown-menu' style='text-align:center;'>";
                        
                            echo "<li class='dropdown-item'><form method='post' action='delete_comments.php' onsubmit=\"return confirm('Are you sure you want to delete this post?');\"><input type='hidden' name='comment_id' value='" . $comments["CommentID"] . "'><button type='submit' class='btn'><i class='bi bi-trash3-fill'></i>Delete</button></form></li>"; // DELETE BUTTON FOR USER (FRONTEND)
                            //echo "<li class='dropdown-item><a href='#'><i class='bi bi-trash3-fill'></i>Delete</a>";//DELETE BUTTON FOR USER (FRONTEND)
                            }
                            echo "</ul></div>";

                        ?>

                        <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true" style="background-color:rgba(0, 0, 0, 0.44);">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Submit a Report</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    Find this post offensive, or otherwise disturbing the peace? Let us know why by telling us!<Br><br>
                                    <label for="report-body">Description of report:</label>
                                    <textarea class="form-control"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a type="button" class="btn btn-warning" href="index.php">Submit Report</a>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>

                        <input type='hidden' name='comment_id' value=<?php echo $comments['CommentID'];?>>
                        <div class="container" id="comment-container">
                            <div class="row">
                                <div class="col-1"><i class="bi bi-person-circle" style="font-size: 400%;" ></i></div>
                                <div class="col-2">
                                    <?php
                                            echo "<p><b>" . htmlspecialchars_decode($comments['Username']); echo " | " . htmlspecialchars_decode($comments['CommentDate'])  . "</b></p>";
                                            echo "<p>" . htmlspecialchars_decode($comments['CommentBody']) . "</p>";
                                            echo "</div>";
                                        }
                                        
                                    }
                                    ?>
                                </div>
                            <a href='#' type='button' data-bs-toggle='modal' data-bs-target='#reportModal'><i class='bi bi-flag-fill'></i>Report</a>
                        </div>
                    </div>
        </div>
    </div>
</body>
</html>