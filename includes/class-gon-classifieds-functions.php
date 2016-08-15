<?php

function get_category_name($categoryId)
{

}

/**
 * @param $key
 *
 * @since      1.0.0
 *
 */
function get_options_dropdown($key)
{

    $options = get_option($key);

    $select = '<select name='.$key.'><option value="0">Select One</option>';

    foreach ($options AS $key => $value)
    {
        $select .= '<option value="'.$value.'">'.$value.'</option>';
    }

    $select .= '<select>';

    echo $select;
}

/**
 * This function will return the list of classifieds or it will
 * return a message stating that there are no classified found.
 *
 * @return string
 *
 * @since    1.0.0
 *
 */

function get_user_post_count($userid)
{

    global $wpdb;

    $where = get_posts_by_author_sql('classifieds', true, $userid);

    $sql
        = 'SELECT COUNT(*) FROM '.$wpdb->prefix.'posts '.$where.' AND DATE(post_date) >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ';

    $count = $wpdb->get_var($sql);

    return apply_filters('get_usernumposts', $count, $userid);
}


/**
 * @param $key
 * @param null $default
 * @return null
 *
 * @since      1.0.0
 *
 */
function gon_request($key, $default = null)
{

    if (isset($_POST[$key]))
    {
        return stripslashes_deep($_POST[$key]);
    }
    elseif (isset($_GET[$key]))
    {
        return stripslashes_deep($_GET[$key]);
    }
    else
    {
        return $default;
    }
}

/**
 * @param $data
 * @since      1.0.0
 *
 */
function gon_message($data)
{

    ?>

    <?php if (isset($data['error'])&&is_array($data)&&!empty($data)): ?>
    <div class="gon-flash-error">
        <?php foreach ($data as $key => $error): ?>
            <span><?php echo $error ?></span>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

    <?php if (isset($data['info'])&&is_array($data)&&!empty($data)):
    ?>
    <div class="gon-flash-info">
        <?php foreach ($data as $key => $info): ?>
            <span><?php echo $info ?></span>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

    <?php
}


/**
 * Returns path to the provided $term
 *
 * The path consists of parent/child term text names only.
 *
 * @param stdClass $term WP Term object
 * @param string $taxonomy Taxonomy name
 * @since 1.0.5
 * @return array Term path
 * @since      1.0.0
 *
 */
function gon_ads_term_path($term, $taxonomy = null)
{

    $cpath = array();

    if ($taxonomy===null)
    {
        $taxonomy = $term->taxonomy;
    }

    do
    {
        $cpath[$term->term_id] = $term->name;
        $term = get_term($term->parent, $taxonomy);
    } while (!$term instanceof WP_Error);

    return array_reverse($cpath, true);
}

/**
 * @param $array
 * @param bool|false $return
 * @param bool|false $die
 * @param bool|false $text
 * @return null|string
 * @since      1.0.0
 *
 */
function pr($array, $return = false, $die = false, $text = false)
{

    $temp = null;
    if (!$return)
    {
        if (!$text)
        {
            echo '<pre style="border: 1px solid #D0D0D0;background-color:#F9F9F9;margin:14px 0 14px 0;padding:12px;display: block;">'."\n";
        }
        print_r($array, $return);
        if (!$text)
        {
            echo '</pre>';
        }
    }
    else
    {
        if (!$text)
        {
            $temp .= '<pre style="border: 1px solid #D0D0D0;background-color:#F9F9F9;margin:14px 0 14px 0;padding:12px;display: block;">'."\n";
        }
        $temp .= print_r($array, $return);
        if (!$text)
        {
            $temp .= '</pre>';
        }
    }
    if ($die)
    {
        if (!$text)
        {
            die("<br />\n<br />\n\n!!! ## !Dying on command! ## !!!");
        }
        else
        {
            die("\n\n\n!!! ## !Dying on command! ## !!!");
        }
    }
    return $temp;
}

/**
 * @param $array
 * @param bool|false $return
 * @param bool|false $text
 * @since      1.0.0
 *
 */
function prd($array, $return = false, $text = false)
{

    pr($array, $return, true, $text);
}

function getStateAbbreviation($state)
{

    $states = array(
        'Alabama' => 'AL',
        'Alaska' => 'AK',
        'Arizona' => 'AZ',
        'Arkansas' => 'AR',
        'California' => 'CA',
        'Colorado' => 'CO',
        'Connecticut' => 'CT',
        'Delaware' => 'DE',
        'Florida' => 'FL',
        'Georgia' => 'GA',
        'Hawaii' => 'HI',
        'Idaho' => 'ID',
        'Illinois' => 'IL',
        'Indiana' => 'IN',
        'Iowa' => 'IA',
        'Kansas' => 'KS',
        'Kentucky' => 'KY',
        'Louisiana' => 'LA',
        'Maine' => 'ME',
        'Maryland' => 'MD',
        'Massachusetts' => 'MA',
        'Michigan' => 'MI',
        'Minnesota' => 'MN',
        'Mississippi' => 'MS',
        'Missouri' => 'MO',
        'Montana' => 'MT',
        'Nebraska' => 'NE',
        'Nevada' => 'NV',
        'New Hampshire' => 'NH',
        'New Jersey' => 'NJ',
        'New Mexico' => 'NM',
        'New York' => 'NY',
        'North Carolina' => 'NC',
        'North Dakota' => 'ND',
        'Ohio' => 'OH',
        'Oklahoma' => 'OK',
        'Oregon' => 'OR',
        'Pennsylvania' => 'PA',
        'Rhode Island' => 'RI',
        'South Carolina' => 'SC',
        'South Dakota' => 'SD',
        'Tennessee' => 'TN',
        'Texas' => 'TX',
        'Utah' => 'UT',
        'Vermont' => 'VT',
        'Virginia' => 'VA',
        'Washington' => 'WA',
        'West Virginia' => 'WV',
        'Wisconsin' => 'WI',
        'Wyoming' => 'WY'
    );

    return $states[$state];
}