<?php
$directory = gonTemplateURL;
if (is_dir($directory))
{
    $scanned_directory = array_diff(scandir($directory), array('..', '.'));
}
else
{
    echo "No such directory";
}

$options = '<option value="0">Select One</option>';

$selected = null;
foreach ($scanned_directory as $key => $value)
{
    if ($value==get_option('gon-classifieds-template'))
    {
        $selected = 'selected="selected"';
    }

    $options .= '<option value="'.$value.'" '.$selected.'>'.$value.'<option>';
}


$args = array(
    'show_option_all' => 'Select One', // string
    'show_option_none' => null, // string
    'hide_if_only_one_author' => null, // string
    'orderby' => 'display_name',
    'order' => 'ASC',
    'include' => null, // string
    'exclude' => null, // string
    'multi' => false,
    'show' => 'display_name',
    'echo' => true,
    'selected' => false,
    'include_selected' => false,
    'name' => 'user', // string
    'id' => null, // integer
    'class' => null, // string
    'blog_id' => $GLOBALS['blog_id'],
    'who' => null // string
);

$userArgs = array(
    'meta_key' => 'gon-status',
    'meta_value' => 'banned',
    'meta_compare' => '=',
);


$bannedUsers = get_users($userArgs);

$rows = null;
foreach ($bannedUsers AS $user)
{
    $rows .= '<tr><td>'
        .$user->data->display_name
        .'</td><td>'.$user->data->user_email
        .'</td><td>'.$user->data->ID
        .'<td><form method="post" action="#tabs-2"><input type="hidden" name="user_id" value="'
        .$user->data->ID.'"/><input type="submit" name="remove-ban-submit" value="Remove"></form></td>'
        .'</td></tr>';
}

if (empty($rows))
{
    $rows = '<tr><td colspan="4">There are no banned users at this time.</td></tr>';
}

?>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script>
    jQuery(function () {
        jQuery("#tabs").tabs();
    });
</script>
<div id="wpbody-content" aria-label="Main content" tabindex="0">

    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Basic Settings</a></li>
            <li><a href="#tabs-2">User Settings</a></li>
            <!--            <li><a href="#tabs-3">Aenean lacinia</a></li>-->
        </ul>
        <div id="tabs-1">
            <div class="form-wrap">
                <h2>GON Classifieds Options</h2>

                <form id="addtag" method="post" action="#tabs-1" class="validate">
                    <?php wp_nonce_field('gon_options') ?>
                    <div class="form-field term-description-wrap">
                        <label for="tag-description">Number of Ads:</label>
                        <input type="text" name="ad_limit" id="ad_limit" value="<?php echo get_option('gon-classifieds-ad-limit') ?>" style="width:100px;"/>

                        <p>Number of ads allowed per person.</p>
                    </div>
                    <div class="form-field term-description-wrap">
                        <label for="tag-description">Ads per page:</label>
                        <input type="text" name="ads_per_page" id="ads_per_page" value="<?php echo get_option('gon-classifieds-ads-per-page') ?>" style="width:100px;"/>

                        <p>Number of ads per page.</p>
                    </div>
                    <div class="form-field term-description-wrap">
                        <label for="tag-description">Image Limit:</label>
                        <input type="text" name="image_limit" id="image_limit" value="<?php echo get_option('gon-classifieds-sub-image-limit') ?>" style="width:100px;"/>

                        <p>Number images allowed for a non-subscriber.</p>
                    </div>
                    <div class="form-field term-description-wrap">
                        <label for="tag-description">Image Limit:</label>
                        <input type="text" name="image_limit2" id="image_limit2" value="<?php echo get_option('gon-classifieds-sub-image-limit2') ?>" style="width:100px;"/>

                        <p>Number images allowed for a subscriber. (0 is unlimited</p>
                    </div>
                    <div class="form-field term-description-wrap">
                        <label for="tag-description">Number of columns:</label>
                        <select name="column_count">
                            <?php
                            for ($i = 1;$i<=3;$i++)
                            {
                                $selected = null;
                                if (get_option('gon-classifieds-column-count')==$i)
                                {
                                    $selected = 'selected="selected"';
                                }
                                echo '<option value ="'.$i.'" '.$selected.'>'.$i.'</option>';
                            }
                            ?>

                        </select>

                        <p>Number of columns shown.</p>
                    </div>
                    <div class="form-field term-description-wrap">
                        <label for="tag-description">Ads expire after:</label>
                        <input type="text" name="expires" id="expires" value="<?php echo get_option('gon-classifieds-expires') ?>" style="width:100px;"/> days
                    </div>

                    <div class="form-field term-parent-wrap">
                        <label for="parent">Default Template:</label>
                        <select name="template" id="template" class="postform">
                            <?php echo $options; ?>
                        </select>
                    </div>
                    <div class="form-field term-description-wrap">
                        <label for="tag-description">ReplyTo Email:</label>
                        <input type="text" name="reply_to" id="reply_to" value="<?php echo get_option('gon-classifieds-reply-to') ?>" style="width:100px;"/>
                    </div>
                    <p class="submit">
                        <input type="submit" name="gon-settings-submit" id="gon-settings-submit" class="button button-primary" value="Submit">
                    </p>
                </form>
            </div>
        </div>
        <div id="tabs-2">
            <div class="form-wrap">
                <h2>User Options</h2>

                <form id="addtag" method="post" action="#tabs-2" class="validate">

                    <div class="form-field term-description-wrap">
                        <label for="options">Ad user state: (ie...banned)</label>
                        <input type="text" name="user_option" id="user_option" value="" style="width:100px;"/>
                    </div>
                    <input type="submit" name="user-options-submit" id="submit" class="button button-primary" value="Submit">
                </form>
                <h2>GON Classifieds Options</h2>

                <form id="addtag" method="post" action="#tabs-2" class="validate">
                    <?php wp_nonce_field('gon_options') ?>
                    <div class="form-field term-description-wrap">
                        <label for="tag-description">User:</label>
                        <?php wp_dropdown_users($args); ?>
                        <?php get_options_dropdown('gon-user-option'); ?>
                        <input type="submit" name="gon-status-submit" id="submit" class="button button-primary" value="Change Status">
                </form>
                <h2>Banned Users</h2>
                <table>
                    <thead>
                    <th>User</th>
                    <th>Email</th>
                    <th>ID</th>
                    <th></th>
                    </thead>
                    <tbody>
                    <?php echo $rows ?>
                    </tbody>

            </div>
        </div>
        <!--        <div id="tabs-3">-->
        <!--            <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>-->
        <!---->
        <!--            <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>-->
        <!--        </div>-->
    </div>

    <div class="clear"></div>
</div>
