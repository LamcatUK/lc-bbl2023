<?php

// cf7 no autop
add_filter('wpcf7_autop_or_not', '__return_false');


function custom_postcode_validation_filter($result, $tag)
{
    $name = $tag->name;
    if($name == 'pickup' || $name == 'dropoff') {
        $postcode = $_POST[$name];
        if($postcode != '') {
            $regex = '/^[A-Z]{1,2}\d[A-Z\d]? ?\d[A-Z]{2}$/i';
            if(!preg_match($regex, $postcode)) {
                $result->invalidate($tag, "Please enter a valid postcode.");
            }
        }
    }
    return $result;
}

add_filter('wpcf7_validate_text*', 'custom_postcode_validation_filter', 10, 2);
add_filter('wpcf7_validate_text', 'custom_postcode_validation_filter', 10, 2);
