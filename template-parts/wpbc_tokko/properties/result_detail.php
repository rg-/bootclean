<?php

$search = $args['search'];
$use_query_vars = $args['use_query_vars'];

?>

<div data-ajax="results" class="text-center">
	<p class="small">Pagina <?php echo $search->get_current_page();?> de <?php echo $search->get_result_page_count(); ?> de un total de <?php echo $search->get_result_count();?> RESULTADOS </p>
</div>