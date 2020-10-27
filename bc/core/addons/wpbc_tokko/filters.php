<?php

function WPBC_tokko_query_vars( $vars ) {
    //$vars[] = 'something';  
    return $vars;
} 
add_filter( 'query_vars', 'WPBC_tokko_query_vars' );