<?php if ($search_bar=="enabled"): ?>

            <h2>GON Classifieds Options</h2>
            <div class="gon-options" style="padding-bottom:10px">
                <form action="edit.php?post_type=classifieds&page=search" method="post" class="validate">

                    <div class="gon-search">
                        <div class="advert-input advert-input-type-half">
                            <input type="text" name="query" id="query" placeholder="search keywords or user...">
                            <input type="submit" name="submit" id="submit" class="button button-primary" value="Submit">
                        </div>

                </form>
            </div>
        </div>

<?php endif;